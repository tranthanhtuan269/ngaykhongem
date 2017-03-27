<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Tour;
use App\Dattour;
use Mail;

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

    public function xemtour($id){
        $tour = DB::table('tour')->where('id', '=', $id)->first();
        if(Auth::user()){
        $tourdats = DB::table('dattour')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();
        $arr = [];
        foreach($tourdats as $tourdat){
            $arr[] = $tourdat->tour_id;
        }
        }else{
           $arr = [];
        }
        return view('phuothanoi.xemtour')->withtour($tour)->withtourdats($arr);
    }
    
    public function xemtatcatour(){
        $tours = DB::table('tour')->orderBy('ngay_khoi_hanh', 'desc')->paginate(12);
        $tourdats = DB::table('dattour')
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();
        $arr = [];
        foreach($tourdats as $tour){
            $arr[] = $tour->tour_id;
        }
        //var_dump($tours);die;
        return view('phuothanoi.xemtatcatour')->withtours($tours)->withtourdats($arr);
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
    
    public function dattour($id){
        $tour = Tour::findOrFail($id);
//        var_dump($tour);die;
        if (is_null($tour))
        {
            $returnArr['code'] = 0;
            $returnArr['message'] = "Notfound";
            return json_encode($returnArr);
        }
        
        // add user to follow table
        if(Auth::user()){
            
            $checkdattour = DB::table('dattour')
                    ->where('user_id', Auth::user()->id)
                    ->where('tour_id', $id)
                    ->get();
            if($checkdattour){
                $returnArr['code'] = 1;
                $returnArr['message'] = "Success";
                return json_encode($returnArr);
            }
            
            $user_id = Auth::user()->id;
            $today = date("Y-m-d H:i:s"); 
            $datTour = new Dattour();

            $datTour->user_id = $user_id;
            $datTour->tour_id = $id;
            $datTour->created_at = $today;

            $datTour->save();
            $returnArr['code'] = 1;
            $returnArr['message'] = "Success";
            // send email to Quan
            $user = \Auth::user();
            
            Mail::send('emails.dattour', [], function($message) use ($user) {
                $message->from('admin@chodatso.com', env('SITE', 'chodatso.com'));
                $message->to(env('MAIL_ADMIN', 'tran.thanh.tuan269@gmail.com'))->subject('Thông báo từ '.env('SITE', 'chodatso.com'));
            });
            
            return json_encode($returnArr);
            // show alert to user
        }else{
            $returnArr['code'] = 3;
            $returnArr['message'] = "Unsuccess";
            return json_encode($returnArr);
        }
        
        $returnArr['code'] = 2;
        $returnArr['message'] = "Unsuccess";
        return json_encode($returnArr);
    }
}