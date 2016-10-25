<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InspectionRequest;
use App\Inspection;
use App\Models\Admin\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class InspectionController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'inspection';


    /**
     * InspectionController constructor.
     */
    public function __construct(){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]);
    }

    /**
     * @param Inspection $inspection
     * @return mixed
     */
    public function index(Inspection $inspection){
        $inspections = $inspection->bycat('cars')->paginate(25);
        return view('admin.component.inspection.index',compact('inspections'));
    }

    /**
     * @return mixed
     */
    public function create(){
        $categories = Cache::get('car_mark');
        $insurer = Cache::get('insurer');
        return view('admin.component.inspection.create',compact('categories','insurer'));
    }


    /**
     * Store a newly created resource in storage.
     * @param InspectionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(InspectionRequest $request)
    {
        $created = Auth::user()->inspection()->create($request->all());
        if($created->id > 0){
            $created->uploadImages($request->file('images'),$created->extra);
            $created->addCategories($request->input('cat'));
        }

        flash()->success(trans('admin.data_added'));
        if($request->ajax()):
            return ['url'=>action('Admin\InspectionController@index')];
        else:
            return redirect(action('Admin\InspectionController@index'));
        endif;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Inspection $inspection
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Inspection $inspection)
    {
        $categories = Cache::get('car_mark');
        $insurer = Cache::get('insurer');
        return view('admin.component.inspection.edit',compact('categories','inspection','insurer'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $inspection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Inspection $inspection)
    {
        $inspection->update($request->all());
        $inspection->uploadImages($request->file('images'),$inspection->extra);
        $inspection->updateCategories($request->input('cat'));
        flash()->success(trans('admin.data_updated'));
        return redirect(action('Admin\InspectionController@index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Inspection $inspection
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     * @throws \Exception
     */
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
        return trans('admin.data_removed');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function ajax(Request $request){
        switch($request->input('action')):
            //getting car models
            case 'model':
                $cat = new Cat();
                $result = $cat->select('id','name')->where('parent',$request->input('id'))->get();
                break;
        endswitch;

        return $result->toJson();
    }
}
