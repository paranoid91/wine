<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CatRequest;
use App\Models\Admin\Cat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class InsurerController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'insurance';

    /**
     * @var int
     */
    protected $mainCat = 2062;

    /**
     * InsurerController constructor.
     * @param Cat $category
     */
    public function __construct(Cat $category){
        Cache::rememberForever('insurer',function() use ($category){
            return $category->select('id','name')->where('parent',$this->mainCat)->get();
        });
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add car roles
    }

    /**
     * @param Cat $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Cat $category){
        $categories = $category->select('id','name','parent')->where('parent',$this->mainCat)->paginate(20);
        $cat = $this->mainCat;
        return view('admin.component.categories.insurer.index',compact('categories','cat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $categories = Cache::get('insurer');
        return view('admin.component.categories.insurer.create',compact('categories'));
    }

    /**
     * @param Cat $cat
     * @param CatRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Cat $cat, CatRequest $request){
        $cat->create($request->all());
        Cache::forget('insurer');
        flash()->success(trans('admin.cat_added'));
        return redirect(action('Admin\InsurerController@index'));
    }

    /**
     * @param Cat $cat
     * @return mixed
     */
    public function edit(Cat $cat){
        $categories = Cache::get('insurer');
        return view('admin.component.categories.insurer.edit',compact('cat','categories'));
    }

    /**
     * @param CatRequest $request
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CatRequest $request, Cat $cat){
        $cat->update($request->all());
        Cache::forget('insurer');
        flash()->success(trans('admin.cat_edited'));
        return redirect(action('Admin\InsurerController@index'));
    }


    /**
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Cat $cat){
        Cache::forget('insurer');
        $cat->delete();
        //flash()->success(trans('admin.cat_removed'));
        return trans('admin.cat_removed');
    }
}
