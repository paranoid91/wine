<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class testController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'test';


    /**
     * NewsController constructor.
     */
    public function __construct(){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]); // add news permissions
    }
    public function index()
    {
        return view('admin.component.test.index');
    }
}
