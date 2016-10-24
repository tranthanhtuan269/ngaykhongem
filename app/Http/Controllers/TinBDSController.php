<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Requests\CreateTinBDSRequest;
use App\TinBDS;
use App\Loaibds;
use App\User;
use App\Tinh;
use App\Huong;
use DB;
use Input;
use Session;
use Mail;

class TinBDSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tinbdss = DB::table('tinbdss')
                    ->where('tinbdss.nguoi_dang', '=', \Auth::id())
                    ->orderBy('updated_at', 'desc')
                    ->paginate(8);
        return view('tinbdss.index')->withtinbdss($tinbdss);
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

        //dd($tinhs);

        return view('tinbdss.create', compact(['tinhs', 'huyens', 'phuongs', 'duongs', 'duans', 'loaibdss', 'huongs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTinBDSRequest $request)
    {

//        $validator = Validator::make($request->all(), [
//            'tieu_de' => 'required|max:255',
//        ]);

//        if ($validator->fails()) {
//            return redirect('tinbds/create')
//                    ->withErrors($validator)
//                    ->withInput();
//        }



        $picture = '';
        $allPic = '';
        if ($request->hasFile('images1')) {
            $files = $request->file('images1');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').$filename;
                $allPic .= $picture . ';';
                $destinationPath = base_path() . '/public/images';
                $file->move($destinationPath, $picture);
            }
        }
        //$request->images = $allPic;

        $input = $request->all();
        unset($input['images1']);
        $input['images'] = $allPic;
        $input['nguoi_dang'] = \Auth::user()->id;
        
        tinbds::create($input);
        $tindang_id = tinbds::create($input)->id;
        
        // send email
        $id = \Auth::user()->id;
        $user = User::find($id);

        Mail::send('emails.bannha', ['user' => $user, 'tindang_id' => $tindang_id], function ($message) {

            $message->from('admin@chodatso.com', 'chodatso.com');

            $message->to('tran.thanh.tuan269@gmail.com')->subject('Thông báo từ chodatso.com');
        });

        // sending back with error message.
        \Session::flash('error', 'uploaded file is not valid');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tinbds = tinbds::findOrFail($id);

        //dd($tinbds);

        return view('tinbdss.show')->withtinbds($tinbds);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tinbds = tinbds::find($id);

        if (is_null($tinbds))
        {
            return Redirect::route('tinbds.index');
        }

        $loaibdss = Loaibds::pluck('name', 'id');
        $tinhs = Tinh::pluck('name', 'id');
        $huyens = DB::table('huyens')->where('tinh_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $phuongs = DB::table('phos')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duongs = DB::table('duongs')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $duans = DB::table('duans')->where('huyen_id','=','1')->pluck('name', 'id'); //Loaibds::pluck('name', 'id');
        $huongs = Huong::pluck('name', 'id');

        return \View::make('tinbdss.edit', compact(['tinbds','tinhs', 'huyens', 'phuongs', 'duongs', 'duans', 'loaibdss', 'huongs']));
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
        $validator = Validator::make($request->all(), [
            'tieu_de' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }


        $input = $request->all();
        $picture = '';
        $allPic = '';
        if ($request->hasFile('images1')) {
            $files = $request->file('images1');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').$filename;
                $allPic .= $picture . ';';
                $destinationPath = base_path() . '/public/images';
                $file->move($destinationPath, $picture);
            }
            unset($input['images1']);
            $input['images'] = $allPic;
        }

        $tinbds = tinbds::find($id);

        $tinbds->update($input);

        \Session::flash('flash_message', 'tinbds đã được sửa thành công!');

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
        $tinbds = tinbds::find($id);

        if (is_null($tinbds))
        {
            Session::flash('flash_message', 'Không tìm thấy tinbds bạn muốn xóa!');
            return Redirect::route('tinbds.index');
        }

        $tinbds->delete();

        Session::flash('flash_message', 'tinbds đã được xóa thành công!');

        return redirect()->route('tinbds.index');
    }
}
