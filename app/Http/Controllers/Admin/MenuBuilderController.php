<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Cat;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Admin\SettingRequest;

class MenuBuilderController extends Controller
{
    protected $moduleName = 'menu';
    /**
     * @var
     */
    protected $settings;

    /**
     * MenuBuilderController constructor.
     * @param Cat $cat
     * @param Setting $setting
     */
    public function __construct(Cat $cat,Setting $setting){
        $this->middleware('roles',['except'=>get_role_permissions('menu')]); // add menu roles
        $this->settings = $setting->select('name','id','lang')->where('type','menu')->paginate(10);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $items = $this->settings;
        return view('admin.component.menu.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $custom_urls = Setting::select('name','value')->where('type','menu_url')->get();
        return view('admin.component.menu.create',compact('custom_urls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Setting $setting)
    {
        $setting->create($request->all());
        flash()->success(trans('all.successfully_added'));
        return action('Admin\MenuBuilderController@index');
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Setting::findOrFail($id);
        $custom_urls = Setting::select('name','value','id')->where('type','menu_url')->get();
        return view('admin.component.menu.edit',compact('item','custom_urls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->update($request->all());
        Cache::forget('settings_'.\App::getLocale());
        flash()->success(trans('all.successfully_updated'));
        return action('Admin\MenuBuilderController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::findOrFail($id)->delete();
        return trans('all.removed');
    }

    /**
     * Adding Custom URL for Menu Builder
     * @param SettingRequest $request
     * @param $id
     * @return mixed
     */
    public function custom(SettingRequest $request,$id){
        Setting::create($request->all());
        flash()->success(trans('all.added'));
        Cache::forget('settings_'.\App::getLocale());
        return redirect(action('Admin\MenuBuilderController@edit',$id));
    }
}
