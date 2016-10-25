<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsFormRequest;
use App\Models\Admin\Data;
use App\Models\Admin\File;
use Illuminate\Support\Facades\Auth;
use Config;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'news';

    /**
     * @var
     */
    protected $categories;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add news permissions
    }

    /**
     * @param Data $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Data $data)
    {
        $news = $data->bycat($this->moduleName)->latest()->paginate(20);
        return view('admin.component.news.index',compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $cats = selectProdCat("news");
        return view('admin.component.news.create', compact("cats"));
    }

    /**
     * @param NewsFormRequest $request
     * @param File $file
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(NewsFormRequest $request,File $file)
    {
        $created = Auth::user()->data()->create($request->all());
        $created->addCategories($request->input('cat'));
        $files = $file->uploadImages($request->input('image'),$created->id,false);
        $created->addFiles($files);
        $created->addLanguageId($created->id);
        Cache::flush();
        flash()->success(trans('admin.data_added'));
        return redirect(action('Admin\NewsController@index'));
    }

    /**
     * @param Data $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Data $data)
    {
        $news = $data;
        $cats = selectProdCat("news");
        return view('admin.component.news.edit',compact('news', 'cats'));
    }

    public function update(NewsFormRequest $request,File $file, Data $data)
    {
        $data->update($request->all()); //update data fields
        $data->updateCategories($request->input('cat'));
        $files = $file->uploadImages($request->input('image'),$data->id,false); //upload images
        $data->updateFiles($files); // update data files
        Cache::flush();
        flash()->success(trans('admin.data_updated'));
        return redirect(action('Admin\NewsController@index'));
    }

    public function destroy(Data $data)
    {
        $data->delete();
        return trans('admin.data_removed');
    }

    /**
     * Translate specific resource.
     *
     * @param Data $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function translate(Data $data)
    {
        $count = Data::where('lang_id',$data->lang_id)->count(); // count data by language data id
        if($count < count(Config::get('global.languages'))): //check if language data number is < site languages
            $new_data = Data::create(array_except($data->toArray(),['id','created_at','status','lang','slug']) + ['status'=>0,'lang'=>'']); //clone current data
            $new_data->addCategories($data->getCategories()); // add categories to cloned data
            $new_data->addFiles($data->getFiles()); // add files to cloned data
            flash()->success(trans('admin.trans_item_created')); // flash message
            return redirect(action('Admin\NewsController@edit',$new_data->id)); //redirect to cloned data
        else:
            flash()->error(trans('admin.you_already_create_items_to_translate'));
            return redirect(action('Admin\NewsController@edit',$data->id)); // redirect to current data
        endif;
    }
}
