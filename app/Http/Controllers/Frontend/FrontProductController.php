<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontProductController extends Controller
{

    public function index()
    {
        $products = Product::select("id","lang_id","title","price","rate")
                            ->where("lang", \App::getLocale())
                            ->orderBy('id', 'desc')
                            ->paginate(24);

        return view("Front/products/index", compact("products"));
    }

    public function show($id)
    {
        $product = Product::where('lang_id', $id)->where('lang', \App::getLocale())->first();
        return view("Front/products/show", compact("product"));
    }
    
}