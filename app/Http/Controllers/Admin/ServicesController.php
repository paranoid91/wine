<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use App\Service;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\Cache;

class ServicesController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName= 'services';


    /**
     * CastsController constructor.
     */
    public function __construct(){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add services permissions
    }

    /**
     * Display a listing of the resource.
     *
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Service $service)
    {
        $services = $service->latest()->paginate(10);
        return view('admin.component.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.component.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ServiceRequest $request,Service $service)
    {
        $service->create($request->all());
        Cache::flush();
        flash()->success(trans('admin.service_item_added'));
        return redirect(action('Admin\ServicesController@index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('admin.component.services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ServiceRequest $request,Service $service)
    {
        $service->update($request->all());
        flash()->success(trans('admin.service_item_updated'));
        return redirect(action('Admin\ServicesController@index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Service $service
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     * @throws \Exception
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return trans('admin.service_item_removed');
    }

    /**
     * Translate specific resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function translate(Service $service){
        $count = Service::where('lang_id',$service->lang_id)->count(); // count data by language data id
        if($count < count(Config::get('global.languages'))): //check if language data number is < site languages
            $new_service = Service::create(array_except($service->toArray(),['id','created_at','is_publish','lang']) + ['is_publish'=>0,'lang'=>'']); //clone current data
            flash()->success(trans('admin.trans_item_created')); // flash message
            return redirect(action('Admin\ServicesController@edit',$new_service->id)); //redirect to cloned data
        else:
            flash()->error(trans('admin.you_already_create_items_to_translate'));
            return redirect(action('Admin\ServicesController@edit',$service->id)); // redirect to current data
        endif;
    }
}
