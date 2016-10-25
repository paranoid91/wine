<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin\Data;

class FrontNewsController extends Controller
{
    public function index()
    {
        $news = Data::select('lang_id', 'title')
                    ->where('lang', \App::getLocale())
                    ->orderBy('lang_id','desc')
                    ->paginate(20);

        return view("Front/news/index", compact("news"));
    }

    public function show($id)
    {
        //$news = Data::findOrFail($id)->select('id', 'title', 'text')->where('lang', \App::getLocale())->get();
        $news = Data::select('id', 'title', 'text')
                    ->where('lang_id', $id)
                    ->where('lang', \App::getLocale())
                    ->first();

        return view("Front/news/show", compact("news"));
    }
    
}
