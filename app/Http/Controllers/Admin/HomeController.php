<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'home';


    /**
     * HomeController constructor.
     */
    public function __construct(){
      $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        Cache::flush();
        return view('admin.component.home.index');
    }
}
