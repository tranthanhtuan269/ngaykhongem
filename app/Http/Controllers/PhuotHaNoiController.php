<?php

namespace App\Http\Controllers;

use DB;
use Auth;

class PhuotHaNoiController extends Controller
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

    public function xemtour(){
        $tours = DB::table('tour')->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        //var_dump($tours);die;
        return view('phuothanoi.xemtour')->withtours($tours);
    }
    
    public function xemtourthang(){
        $tours = DB::table('tour')->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        return view('phuothanoi.xemtourthang')->withtours($tours);
    }
    
    public function tourthamhiem(){
        $tours = DB::table('tour')->where('type','=',1)->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        //var_dump($tours);die;
        return view('phuothanoi.xemtour')->withtours($tours);
    }
    
    public function tourmaohiem(){
        $tours = DB::table('tour')->where('type','=',2)->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        //var_dump($tours);die;
        return view('phuothanoi.xemtour')->withtours($tours);
    }
    
    public function tourchuphinh(){
        $tours = DB::table('tour')->where('type','=',3)->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        //var_dump($tours);die;
        return view('phuothanoi.xemtour')->withtours($tours);
    }
    
    public function huongdanvien(){
        $users = DB::table('users')->where('type', '1')->paginate(12);
        return view('phuothanoi.huongdanvien')->withusers($users);
    }
    
    public function gioithieu(){
        $gioi_thieu = DB::table('textout')->where('name', '=', 'gioi_thieu')->get();
        $xu_menh = DB::table('textout')->where('name', '=', 'xu_menh')->get();
        $arr = array();
        $arr['gioi_thieu'] = $gioi_thieu[0]->textout;
        $arr['xu_menh'] = $xu_menh[0]->textout;
        return view('phuothanoi.gioithieu')->withabc($arr);
    }
    
    public function setuppage(){
        $gioi_thieu = DB::table('textout')->where('name', '=', 'gioi_thieu')->get();
        $xu_menh = DB::table('textout')->where('name', '=', 'xu_menh')->get();

        $arr = array();
        $arr['gioi_thieu'] = $gioi_thieu[0]->textout;
        $arr['xu_menh'] = $xu_menh[0]->textout;
        return view('phuothanoi.setup')->withabc($arr);
    }
    
    public function setuppost(Request $request)
    {
        
    }
}