<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CatRequest;
use App\Models\Admin\Cat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WinesController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'wines';

    protected $mainCat = 2065;

    /**
     * @var
     */
    protected $categories;

    /**
     * CatController constructor.
     * @param Cat $cat
     */
    public function __construct(Cat $cat){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add categories roles
        $this->categories = $cat->select('id','name','parent')->where('parent',$this->mainCat)->paginate(20); // get categories
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $categories = $this->categories;
        $cat = $this->mainCat;
        return view('admin.component.categories.wines.index',compact('categories','cat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $categories = $this->categories;
        return view('admin.component.categories.wines.create',compact('categories'));
    }

    /**
     * @param Cat $cat
     * @param CatRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Cat $cat, CatRequest $request){
        $cat->create($request->all());
        flash()->success(trans('admin.cat_added'));
        return redirect(action('Admin\CatController@index'));
    }

    /**
     * @param Cat $cat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Cat $cat){
        $categories = $this->categories;
        return view('admin.component.categories.wines.edit',compact('cat','categories'));
    }

    /**
     * @param CatRequest $request
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CatRequest $request, Cat $cat){
        $cat->update($request->all());
        flash()->success(trans('admin.cat_edited'));
        return redirect(action('Admin\CatController@index'));
    }


    /**
     * @param Cat $category
     * @param $cat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Cat $category,$cat){
        $categories = $category->select('id','name','parent')->where('parent',$cat)->paginate(20);
        return view('admin.component.categories.show',compact('categories','cat'));
    }

    /**
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Cat $cat){
        $cat->delete();
        //flash()->success(trans('admin.cat_removed'));
        return trans('admin.cat_removed');
    }
}
