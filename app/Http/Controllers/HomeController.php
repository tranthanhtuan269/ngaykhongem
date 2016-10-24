<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\TinBDS;
use App\User;
use DB;

class HomeController extends Controller
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
        $tinmns = DB::table('tinbdss')
                    ->join('tinhs', 'tinhs.id', '=', 'tinbdss.tinh')
                    ->join('huyens', 'huyens.id', '=', 'tinbdss.huyen')
                    ->join('users', 'users.id', '=', 'tinbdss.nguoi_dang')
                    ->select('tinbdss.*', 'huyens.name as ten_huyen', 'tinhs.name as ten_tinh', 'users.name as phone')
                    ->where('tinbdss.loaiyeucau', '=', 0)
                    ->orderBy('updated_at', 'desc')
                    ->paginate(12);   

        return view('home')->withtinmns($tinmns);
    }

    public function show($id)
    {
        //DB::enableQueryLog();
        $tinbds = DB::table('tinbdss')
                    ->leftJoin('duongs', 'duongs.id', '=', 'tinbdss.duong')
                    ->leftJoin('phos', 'phos.id', '=', 'tinbdss.phuong')
                    ->leftJoin('tinhs', 'tinhs.id', '=', 'tinbdss.tinh')
                    ->leftJoin('huyens', 'huyens.id', '=', 'tinbdss.huyen')
                    ->leftJoin('huongs', 'huongs.id', '=', 'tinbdss.huong_nha')
                    ->join('users', 'users.id', '=', 'tinbdss.nguoi_dang')
                    ->select('tinbdss.*', 'tinbdss.id as tin_id', 'users.*', 'duongs.name as ten_duong', 'phos.name as ten_pho', 'huyens.name as ten_huyen', 'tinhs.name as ten_tinh', 'huongs.name as ten_huong')
                    ->where('tinbdss.id', '=', $id)
                    ->first();
                    //dd(DB::getQueryLog());
                    //dd($tinbds);


        return view('home.show')->withtinbds($tinbds);
    }

    public function updateCall()
    {
        if(isset($_POST) && $_POST["id"] != null){
            $id = $_POST["id"];
            $tinbds = TinBDS::find($id);
            $tinbds->numcall = $tinbds->numcall + 1;
            $returnArr = array();
            if($tinbds->save()){
               $returnArr['code'] = 1;
               $returnArr['message'] = "Success";
            }else{
                $returnArr['code'] = 0;
               $returnArr['message'] = "Unsuccess";
            }
            return json_encode($returnArr);
        }
    }

    public function timkiemnhaban()
    {
        if(isset($_POST)){

            $loaibds = $_POST['loaibds'];
            $tinh = $_POST['tinh'];
            $huyen = $_POST['huyen'];
            $huong_nha = $_POST['huong_nha'];
            $gia = $_POST['gia'];
            $dien_tich = $_POST['dien_tich'];

            $tinbds = DB::table('tinbdss')
            //->leftjoin('duongs', 'duongs.id', '=', 'tinbdss.duong')
            //->leftjoin('phos', 'phos.id', '=', 'tinbdss.phuong')
            ->leftjoin('tinhs', 'tinhs.id', '=', 'tinbdss.tinh')
            ->leftjoin('huyens', 'huyens.id', '=', 'tinbdss.huyen')
            //->leftjoin('huongs', 'huongs.id', '=', 'tinbdss.huong_nha')
            //->join('users', 'users.id', '=', 'tinbdss.nguoi_dang')
            ->select(
                'tinbdss.tieu_de',
                //'tinbdss.mo_ta',
                'tinbdss.images',
                'tinbdss.gia',
                'tinbdss.dien_tich',
                // 'tinbdss.dia_chi',
                // 'tinbdss.mat_tien',
                // 'tinbdss.duong_vao',
                // 'tinbdss.phong_khach',
                // 'tinbdss.phong_ngu',
                // 'tinbdss.wc',
                // 'users.*', 
                // 'huongs.name as ten_huong',
                // 'duongs.name as ten_duong', 
                // 'phos.name as ten_pho', 
                'huyens.name as ten_huyen', 
                'tinhs.name as ten_tinh',
                'tinbdss.id as tin_id'
                );
            if(isset($loaibds) && $loaibds != null && $loaibds != 0)
                $tinbds = $tinbds->where('tinbdss.loaibds', '=', $loaibds);
            if(isset($tinh) && $tinh != null && $tinh != 0)
                $tinbds = $tinbds->where('tinbdss.tinh', '=', $tinh);
            if(isset($huyen) && $huyen != null && $huyen != 0)
                $tinbds = $tinbds->where('tinbdss.huyen', '=', $huyen);
            if(isset($huong_nha) && $huong_nha != null && $huong_nha != 0 && $huong_nha != 1)
                $tinbds = $tinbds->where('tinbdss.huong_nha', '=', $huong_nha);
            if(isset($gia) && $gia != null && $gia != 0)
                if($gia == 1)
                    $tinbds = $tinbds->where('tinbdss.gia', '<', 1000000000);
                if($gia == 2)
                    $tinbds = $tinbds->where('tinbdss.gia', '>', 1000000000)->where('tinbdss.gia', '<', 3000000000);
                if($gia == 3)
                    $tinbds = $tinbds->where('tinbdss.gia', '>', 3000000000)->where('tinbdss.gia', '<', 5000000000);
                if($gia == 4)
                    $tinbds = $tinbds->where('tinbdss.gia', '>', 5000000000)->where('tinbdss.gia', '<', 10000000000);
                if($gia == 5)
                    $tinbds = $tinbds->where('tinbdss.gia', '>', 10000000000);
            if(isset($dien_tich) && $dien_tich != null && $dien_tich != 0)
                if($dien_tich == 1)
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '<', 30);
                if($dien_tich == 2)
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '>', 30)->where('tinbdss.dien_tich', '<', 50);
                if($dien_tich == 3)
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '>', 50)->where('tinbdss.dien_tich', '<', 100);
                if($dien_tich == 4)
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '>', 100)->where('tinbdss.dien_tich', '<', 300);
                if($dien_tich == 5)
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '>', 300);
            $tinbds = $tinbds->paginate(12);
            return view('home.timkiemnhaban')->withtinbdss($tinbds);
        }
    }

    public function timkiemnguoimua()
    {
        if(isset($_POST)){

            $loaibds = $_POST['loaibds'];
            $tinh = $_POST['tinh'];
            $huyen = $_POST['huyen'];
            $huong_nha = $_POST['huong_nha'];
            $gia = $_POST['gia'];
            $dien_tich = $_POST['dien_tich'];

            $tinbds = DB::table('yeucaunha')
            ->leftJoin('duongs', 'duongs.id', '=', 'yeucaunha.duong')
            ->leftJoin('phos', 'phos.id', '=', 'yeucaunha.phuong')
            ->leftJoin('huyens', 'huyens.id', '=', 'yeucaunha.huyen')
            ->join('tinhs', 'tinhs.id', '=', 'yeucaunha.tinh')
            ->leftjoin('huongs', 'huongs.id', '=', 'yeucaunha.huong_nha')
            ->leftjoin('loaibdss', 'loaibdss.id', '=', 'yeucaunha.loaibds')
            ->join('users', 'users.id', '=', 'yeucaunha.nguoi_dang')
            ->select(
                    'yeucaunha.id as tin_id', 
                    'yeucaunha.loaibds',
                    'yeucaunha.tam_tien',
                    'yeucaunha.mua_gap',
                    'yeucaunha.kinh_doanh',
                    'yeucaunha.dau_tu',
                    'yeucaunha.de_o',
                    'yeucaunha.phong_ngu',
                    'yeucaunha.wc',
                    'yeucaunha.dien_tich',
                    'yeucaunha.mat_tien',
                    'yeucaunha.duong_vao',
                    'yeucaunha.tang',
                    'yeucaunha.phong_khach',
                    'yeucaunha.yeu_cau',
                    'users.name', 
                    'users.phone',
                    'duongs.name as ten_duong', 
                    'phos.name as ten_pho', 
                    'huyens.name as ten_huyen', 
                    'tinhs.name as ten_tinh', 
                    'huongs.name as ten_huong', 
                    'yeucaunha.created_at as create_at', 
                    'loaibdss.name as loai_bds'
                );
            if(isset($loaibds) && $loaibds != null && $loaibds != 0)
                $tinbds = $tinbds->where('yeucaunha.loaibds', '=', $loaibds);
            if(isset($loaibds) && $loaibds != null && $loaibds != 0)
                $tinbds = $tinbds->where('yeucaunha.tinh', '=', $loaibds);
            if(isset($huyen) && $huyen != null && $huyen != 0)
                $tinbds = $tinbds->where('yeucaunha.huyen', '=', $huyen);
            if(isset($huong_nha) && $huong_nha != null && $huong_nha != 0 && $huong_nha != 1)
                $tinbds = $tinbds->where('yeucaunha.huong_nha', '=', $huong_nha);
            if(isset($gia) && $gia != null && $gia != 0){
                if($gia == 1)
                    $tinbds = $tinbds->where('yeucaunha.tam_tien', '<', 1000000000);
                if($gia == 2)
                    $tinbds = $tinbds->where('yeucaunha.tam_tien', '>', 1000000000)->where('yeucaunha.tam_tien', '<', 3000000000);
                if($gia == 3)
                    $tinbds = $tinbds->where('yeucaunha.tam_tien', '>', 3000000000)->where('yeucaunha.tam_tien', '<', 5000000000);
                if($gia == 4)
                    $tinbds = $tinbds->where('yeucaunha.tam_tien', '>', 5000000000)->where('yeucaunha.tam_tien', '<', 10000000000);
                if($gia == 5)
                    $tinbds = $tinbds->where('yeucaunha.gia', '>', 10000000000);
            }
            if(isset($dien_tich) && $dien_tich != null && $dien_tich != 0){
                if($dien_tich == 1)
                    $tinbds = $tinbds->where('yeucaunha.dien_tich', '<', 30);
                if($dien_tich == 2)
                    $tinbds = $tinbds->where('yeucaunha.dien_tich', '>', 30)->where('yeucaunha.dien_tich', '<', 50);
                if($dien_tich == 3)
                    $tinbds = $tinbds->where('yeucaunha.dien_tich', '>', 50)->where('yeucaunha.dien_tich', '<', 100);
                if($dien_tich == 4)
                    $tinbds = $tinbds->where('yeucaunha.dien_tich', '>', 100)->where('yeucaunha.dien_tich', '<', 300);
                if($dien_tich == 5)
                    $tinbds = $tinbds->where('yeucaunha.dien_tich', '>', 300);
            }
            $tinbds = $tinbds->paginate(12);
            //return view('home.timkiemnguoimua')->withyeucaunhas($tinbds);
            return view('home.timkiemnguoimua', ['yeucaunhas' => $tinbds]);
        }
    }

    public function trangcanhan(){
        $user_id = \Auth::user()->id;
        $currentuser = User::find($user_id);
        return view('home.trangcanhan')->withUser($currentuser);
    }

    public function welcome(){
        return view('welcome');
    }

    public function updateUser(Request $request)
    {
        $id = \Auth::user()->id;
        $user = User::find($id);

        $input = $request->all();
        $picture = '';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').$filename;
            $destinationPath = base_path() . '/public/images';
            $file->move($destinationPath, $picture);
            $input['avatar'] = $picture;
            $user->avatar = $picture;
            $user->save();
        }
        
        $user->update($input);

        \Session::flash('flash_message', 'Thông tin đã được sửa thành công!');

        return redirect()->back();
    }

    public function dangBan(){
        return view('home.dangban');
    }

    public function dangNhuCau(){
        return view('home.dangnhucau');
    }

    public function timNguoiMua(){

        $yeucaunhas = DB::table('yeucaunha')
                    ->leftjoin('duongs', 'duongs.id', '=', 'yeucaunha.duong')
                    ->leftjoin('phos', 'phos.id', '=', 'yeucaunha.phuong')
                    ->leftjoin('tinhs', 'tinhs.id', '=', 'yeucaunha.tinh')
                    ->leftjoin('huyens', 'huyens.id', '=', 'yeucaunha.huyen')
                    ->leftjoin('huongs', 'huongs.id', '=', 'yeucaunha.huong_nha')
                    ->join('users', 'users.id', '=', 'yeucaunha.nguoi_dang')
                    ->select('yeucaunha.*', 'yeucaunha.id as tin_id', 'users.*', 'duongs.name as ten_duong', 'phos.name as ten_pho', 'huyens.name as ten_huyen', 'tinhs.name as ten_tinh', 'huongs.name as ten_huong', 'yeucaunha.created_at as create_at')
                    ->orderBy('yeucaunha.created_at', 'desc')
                    ->paginate(12);   

        return view('home.timnguoimua')->withYeucaunhas($yeucaunhas);
    }

    public function timNhaBan(){
        return view('home.timnhaban');
    }
    
    public function xayDung(){
        return view('home.xaydung');
    }
    
    public function kienTruc(){
        return view('home.kientruc');
    }
    
    public function noiThat(){
        return view('home.noithat');
    }
    
    public function ngoaiThat(){
        return view('home.ngoaithat');
    }
    
    public function sendemail(){
        $id = \Auth::user()->id;
        $user = User::find($id);

        Mail::send('emails.welcome', ['user' => $user], function ($message) {

            $message->from('admin@chodatso.com', 'chodatso.com');

            $message->to('tran.thanh.tuan269@gmail.com')->subject('Thông báo từ chodatso.com');
        });
    }

    public function baokim(){
        return view('home.baokim');
    }
}
