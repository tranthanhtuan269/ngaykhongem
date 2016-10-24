<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Requests\CreateYeucaunhaRequest;
use App\Yeucaunha;
use App\Quantamnha;
use App\Loaibds;
use App\User;
use App\Tinh;
use App\Huong;
use DB;
use Response;
use Input;
use Session;
use Auth;

class YeucaunhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('loaibds') &&
            session()->has('tinh') &&
            session()->has('huyen') &&
            session()->has('phuong') &&
            session()->has('huong_nha') &&
            session()->has('tam_tien') &&
            session()->has('dien_tich')) {
            
                $loaibds = session('loaibds');
                $tinh = session('tinh');
                $huyen = session('huyen');
                $phuong = session('phuong');
                $huong_nha = session('huong_nha');
                $tam_tien = session('tam_tien');
                $dien_tich = session('dien_tich');
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
                    //'phos.name as ten_pho', 
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
                if(isset($phuong) && $phuong != null && $phuong != 0)
                    $tinbds = $tinbds->where('tinbdss.phuong', '=', $phuong);
                if(isset($huong_nha) && $huong_nha != null && $huong_nha != 0 && $huong_nha != 1)
                    $tinbds = $tinbds->where('tinbdss.huong_nha', '=', $huong_nha);
                if(isset($tam_tien) && $tam_tien != null && $tam_tien != 0){
                    $tinbds = $tinbds->where('tinbdss.gia', '<=', $tam_tien);
                }
                if(isset($dien_tich) && $dien_tich != null && $dien_tich != 0)
                {
                    $tinbds = $tinbds->where('tinbdss.dien_tich', '>=', $dien_tich);
                }
                $tinbds = $tinbds->paginate(10);
            }else{
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
                    //'phos.name as ten_pho', 
                    'huyens.name as ten_huyen', 
                    'tinhs.name as ten_tinh',
                    'tinbdss.id as tin_id'
                    );
                $tinbds = $tinbds->paginate(10);
            }
        return view('yeucaunhas.index')->withTinbdss($tinbds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loaibdss = Loaibds::pluck('name', 'id');
        $tinhs = Tinh::pluck('name', 'id');
        $huyens = DB::table('huyens')->where('tinh_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $phuongs = DB::table('phos')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duongs = DB::table('duongs')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duans = DB::table('duans')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $huongs = Huong::pluck('name', 'id');

        $loaibdss = Loaibds::pluck('name', 'id');

        return view('yeucaunhas.create', compact(['tinhs', 'huyens', 'phuongs', 'duongs', 'duans', 'loaibdss', 'huongs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateYeucaunhaRequest $request)
    {
        $input = $request->all();
        $input['nguoi_dang'] = \Auth::user()->id;
        $yeucau_id = yeucaunha::create($input)->id;

        // khi nguoi dung luu xong, thi tim kiem cac nha theo yeu cau cua khach de gui lai
        // ta se them 1 view danh sach nha de tra ve cho nguoi dung
        // Store a piece of data in the session...
        session(['loaibds' => $request->input('loaibds')]);
        session(['tinh' => $request->input('tinh')]);
        session(['huyen' => $request->input('huyen')]);
        session(['phuong' => $request->input('phuong')]);
        session(['huong_nha' => $request->input('huong_nha')]);
        session(['tam_tien' => $request->input('tam_tien')]);
        session(['dien_tich' => $request->input('dien_tich')]);
        
        // send email
        $id = \Auth::user()->id;
        $user = User::find($id);

        Mail::send('emails.yeucaunha', ['user' => $user, 'yeucau_id' => $yeucau_id], function ($message) {

            $message->from('admin@chodatso.com', 'chodatso.com');

            $message->to('tran.thanh.tuan269@gmail.com')->subject('Thông báo từ chodatso.com');
        });

        return Redirect::to('yeucaunha/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yeucaunha = DB::table('yeucaunha')
                    ->leftjoin('duongs', 'duongs.id', '=', 'yeucaunha.duong')
                    ->leftjoin('phos', 'phos.id', '=', 'yeucaunha.phuong')
                    ->leftjoin('tinhs', 'tinhs.id', '=', 'yeucaunha.tinh')
                    ->leftjoin('huyens', 'huyens.id', '=', 'yeucaunha.huyen')
                    ->leftjoin('huongs', 'huongs.id', '=', 'yeucaunha.huong_nha')
                    ->join('users', 'users.id', '=', 'yeucaunha.nguoi_dang')
                    ->select('yeucaunha.*', 'yeucaunha.id as tin_id', 'users.*', 'duongs.name as ten_duong', 'phos.name as ten_pho', 'huyens.name as ten_huyen', 'tinhs.name as ten_tinh', 'huongs.name as ten_huong', 'yeucaunha.created_at as create_at')
                    ->where('yeucaunha.id', '=', $id)
                    ->first();
        //dd($yeucaunha);
        return view('yeucaunhas.show')->withYeucaunha($yeucaunha);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $yeucaunha = yeucaunha::find($id);

        if (is_null($yeucaunha))
        {
            return Redirect::route('yeucaunha/');
        }

        $loaibdss = Loaibds::pluck('name', 'id');
        $tinhs = Tinh::pluck('name', 'id');
        $huyens = DB::table('huyens')->where('tinh_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $phuongs = DB::table('phos')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duongs = DB::table('duongs')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duans = DB::table('duans')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $huongs = Huong::pluck('name', 'id');

        return \View::make('yeucaunhas.edit', compact(['tinbds','tinhs', 'huyens', 'phuongs', 'duongs', 'duans', 'loaibdss', 'huongs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $yeucaunha = yeucaunha::find($id);

        $yeucaunha->update($input);

        \Session::flash('flash_message', 'Yêu cầu đã được sửa thành công!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yeucaunha = yeucaunha::find($id);

        if (is_null($yeucaunha))
        {
            Session::flash('flash_message', 'Không tìm thấy yêu cầu bạn muốn xóa!');
            return Redirect::route('yeucaunhas.index');
        }

        $yeucaunha->delete();

        Session::flash('flash_message', 'Yêu cầu đã được xóa thành công!');

        return redirect()->route('yeucaunhas.index');
    }

    public function addfollowproduct(){
        $user = Auth::user();
        $quantamnha = new Quantamnha;
        $quantamnha->user_id = $user->id;
        $quantamnha->nha_id = $_POST['id'];
        if($quantamnha->save()){
            return Response::json(array(
                    'success' => true
                )); 
        }
        return Response::json(array(
                    'success' => false
                )); 
        
    }

    public function removefollowproduct(){
        $user = Auth::user();
        $quantamnha = DB::table('quantamnha')
                ->where('user_id', '=', $user->id)
                ->where('nha_id', '=', $_POST['id']);
        if($quantamnha->delete()){
            return Response::json(array(
                    'success' => true
                )); 
        }
        return Response::json(array(
                    'success' => false
                )); 
    }
}
