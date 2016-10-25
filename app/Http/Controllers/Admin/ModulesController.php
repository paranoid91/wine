<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ModuleRequest;
use App\Models\Admin\Module;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ModulesController extends Controller
{

    /**
     * ModulesController constructor.
     */
    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * @param Module $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Module $module)
    {

        $modules = $module->select('id','name','controller','status')->orderBy('sort','asc')->get();

        return view('admin.component.modules.index',compact('modules'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.component.modules.create');
    }

    /**
     * @param ModuleRequest $request
     * @param Module $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ModuleRequest $request,Module $module)
    {
        $module->create($request->all());
        flash()->success(trans('admin.module_added'));
        return redirect(action('Admin\ModulesController@index'));
    }

    /**
     * @param Module $module
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function active(Module $module)
    {
        return trans('Module #'.$module->id.' is '.$module->moduleStatus($module).' now');
    }

    /**
     * @param Module $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Module $module)
    {
        return view('admin.component.modules.edit',compact('module'));
    }

    /**
     * @param ModuleRequest $request
     * @param Module $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ModuleRequest $request,Module $module)
    {
        $module->update($request->all());
        flash()->success(trans('admin.module_edited'));
        return redirect(action('Admin\ModulesController@index'));
    }

    /**
     * @param Module $module
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return trans('admin.module_removed');
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function sort(Request $request,$id){
        for($i=0;$i<count($request->input('items'));$i++){
            $module = Module::findOrFail($request->input('items')[$i]);
            $module->update(['sort'=>$i]);
        }
        return 1;
    }
}
