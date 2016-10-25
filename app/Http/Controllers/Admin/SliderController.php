<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;

class SliderController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName= 'slider';


    /**
     * CastsController constructor.
     */
    public function __construct(){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add slider permissions
    }

    /**
     * Display a listing of the resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Slider $slider)
    {
        $sliders = $slider->latest()->paginate(10);
        return view('admin.component.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.component.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SliderRequest $request,Slider $slider)
    {
        $slider->create($request->all());
        flash()->success(trans('admin.slider_item_added'));
        return redirect(action('Admin\SliderController@index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Slider $slider)
    {
        return view('admin.component.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SliderRequest $request,Slider $slider)
    {
        $slider->update($request->all());
        flash()->success(trans('admin.slider_item_updated'));
        return redirect(action('Admin\SliderController@index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Slider $slider
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return trans('admin.slider_item_removed');
    }
}
