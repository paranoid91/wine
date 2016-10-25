<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CatRequest;
use App\Models\Admin\Cat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'mark-model';


    /**
     * CarController constructor.
     * @param Cat $category
     */
    public function __construct(Cat $category){
        Cache::rememberForever('car_mark',function() use ($category){
            return $category->select('id','name')->where('parent',3)->get();
        });
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add car roles
    }

    /**
     * @param Cat $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Cat $category){
        $categories = $category->select('id','name','parent')->where('parent',3)->paginate(20);
        $cat = 3;
        return view('admin.component.categories.car.index',compact('categories','cat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $categories =Cache::get('car_mark');
        return view('admin.component.categories.car.create',compact('categories'));
    }

    /**
     * @param Cat $cat
     * @param CatRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Cat $cat, CatRequest $request){
        $cat->create($request->all());
        Cache::forget('car_mark');
        flash()->success(trans('admin.cat_added'));
        return redirect(action('Admin\CatController@index'));
    }

    /**
     * @param Cat $cat
     * @return mixed
     */
    public function edit(Cat $cat){
        $categories = Cache::get('car_mark');
        return view('admin.component.categories.car.edit',compact('cat','categories'));
    }

    /**
     * @param CatRequest $request
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CatRequest $request, Cat $cat){
        $cat->update($request->all());
        Cache::forget('car_mark');
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
        return view('admin.component.categories.car.show',compact('categories','cat'));
    }

    /**
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Cat $cat){
        Cache::forget('car_mark');
        $cat->delete();
        //flash()->success(trans('admin.cat_removed'));
        return trans('admin.cat_removed');
    }
}
