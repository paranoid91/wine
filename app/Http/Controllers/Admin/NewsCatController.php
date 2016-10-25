<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CatRequest;
use App\Models\Admin\Cat;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsCatController extends Controller
{
    protected $moduleName = 'news';

    protected $mainCat = 2;

    protected $categories;

    public function __construct(Cat $cat)
    {
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add categories roles
        $this->categories = $cat->select('id','name','parent')->where('parent',$this->mainCat)->paginate(20); // get categories
    }

    public function index()
    {
        $categories = $this->categories;
        $cat = $this->mainCat;
        return view('admin.component.categories.newsCat.index',compact('categories','cat'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('admin.component.categories.newsCat.create',compact('categories'));
    }

    public function store(Cat $cat, CatRequest $request)
    {
        $cat->create($request->all());
        flash()->success(trans('admin.cat_added'));
        return redirect(action('Admin\NewsCatController@index'));
    }

    public function edit(Cat $cat)
    {
        $categories = $this->categories;
        return view('admin.component.categories.newsCat.edit',compact('cat','categories'));
    }

    public function update(CatRequest $request, Cat $cat)
    {
        $cat->update($request->all());
        flash()->success(trans('admin.cat_edited'));
        return redirect(action('Admin\NewsCatController@index'));
    }

    public function show(Cat $category,$cat)
    {
        $categories = $category->select('id','name','parent')->where('parent',$cat)->paginate(20);
        return view('admin.component.categories.show',compact('categories','cat'));
    }

    public function destroy(Cat $cat)
    {
        $cat->delete();
        //flash()->success(trans('admin.cat_removed'));
        return trans('admin.cat_removed');
    }
}
