<?php

namespace App\Http\Controllers\Admin;

use App\Product;
//use ClassPreloader\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Data;
use Config;



class ProductController extends Controller
{

    protected $moduleName= 'product';

    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add page permissions
    }

    public function index()
    {
        $items = Product::select("id", "title", 'lang','created_at','updated_at')->orderBy("id","desc")->paginate(15);
        return view('admin.component.product.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = selectProdCat("brand");
        $types = selectProdCat("type");
        return view('admin.component.product.create', compact("brands", "types"));
    }

    /**
     * @param ProductRequest $request
     * @param File $file
     * @return mixed
     */
    public function store(ProductRequest $request,File $file)
    {
        $created = Auth::user()->product()->create($request->all());
        $created->addCategories($request->input('cat'));
        $files = $file->uploadImages($request->input('image'),$created->id,false);
        $created->addFiles($files);
        $created->addLanguageId($created->id);
        Cache::flush();
        flash()->success(trans('admin.data_added'));
        return redirect(action('Admin\ProductController@index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $brands = selectProdCat("brand");
        $types = selectProdCat("type");
        return view('admin.component.product.edit',compact('product',"brands","types"));
    }

    public function update(ProductRequest $request,File $file, Product $data)
    {
        $data->update($request->all()); //update data fields
        $data->updateCategories($request->input('cat'));
        $files = $file->uploadImages($request->input('image'),$data->id,false); //upload images
        $data->updateFiles($files); // update data files
        Cache::flush();
        flash()->success(trans('admin.data_updated'));
        return redirect(action('Admin\ProductController@index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return trans('admin.data_removed');
    }

    public function translate(Product $product)
    {
        $count = Product::where('lang_id',$product->lang_id)->count(); // count data by language data id
        if($count < count(Config::get('global.languages'))): //check if language data number is < site languages
            $new_data = Product::create(array_except($product->toArray(),['id','created_at','status','lang','slug']) + ['status'=>0,'lang'=>'']); //clone current data
            $new_data->addCategories($product->getCategories()); // add categories to cloned data
            $new_data->addFiles($product->getFiles()); // add files to cloned data
            flash()->success(trans('admin.trans_item_created')); // flash message
            return redirect(action('Admin\ProductController@edit',$new_data->id)); //redirect to cloned data
        else:
            flash()->error(trans('admin.you_already_create_items_to_translate'));
            return redirect(action('Admin\ProductController@edit',$product->id)); // redirect to current data
        endif;
    }
}
