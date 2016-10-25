<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin\Data;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //main page
    public function index()
    {
        $cur_lang = \App::getLocale();
        $slider = \App\Slider::select("title", "poster", "link", "sub_title")->orderBy("created_at", "asc")->get();
        $new_products = \App\Product::select("id","title","price","rate")->where("lang", $cur_lang)->orderBy('id', 'desc')->take(16)->get();
        $news = Data::select('id','title','desc')->where("lang", $cur_lang)->orderBy('id', 'desc')->take(16)->get();
        return view("Front/index", compact("slider", "new_products", "news"));
    }

    //contact page
    public function contact()
    {
        return view("Front/contact");
    }

    //about us page
    public function aboutUs()
    {
        return view("Front/about");
    }

    //profile page
    public function bag()
    {
        return view("Front/bag");
    }

    public function stories()
    {
        return view("Front/stories");
    }

}
