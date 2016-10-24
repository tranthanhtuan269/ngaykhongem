<?php

namespace App\Http\Controllers;

class ActionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function thanhtoanbaokim(){
        return view('actions.thanhtoanbaokim');
    }

    public function tienhanhthanhtoan(){
        return view('actions.request');
    }

    public function thanhtoannganluong(){
        return view('actions.thanhtoannganluong');
    }
    
    public function success(){
        return view('actions.success');
    }
}
