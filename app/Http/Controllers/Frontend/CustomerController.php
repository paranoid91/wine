<?php

namespace App\Http\Controllers\Frontend;

use App\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CustomerRequest;

class CustomerController extends Controller
{
    //registration form
    public function regForm()
    {
        return view("Front/customers/registration");
    }

    //login form
    public function loginForm()
    {
        return view("Front/customers/login");
    }

    //register new customer
    public function signUp(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        if(isset($customer->subscribe))
        {
            $customer->subscribe = 1;
            $customer->save();
        }
        
        return 1;
    }

    // customer login
    public function login()
    {

    }
}