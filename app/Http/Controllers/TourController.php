<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateTourRequest;
use App\Tour;
use App\User;
use DB;
use Session;
use Mail;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = DB::table('tour')
                    ->orderBy('ngay_khoi_hanh', 'desc')
                    ->paginate(8);
        return view('tour.index')->withtours($tours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hdvs = DB::table('users')->where('type','=','1')->pluck('name', 'id');
        return view('phuothanoi.create', compact(['hdvs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTourRequest $request)
    {
        // upload images to server
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
        // add images to database
        $input = $request->all();
        $phuongtien = '';
        if(isset($input['xe_dap']) && $input['xe_dap'] == 1){
            $phuongtien .= '1;';
            unset($input['xe_dap']);
        }
        if(isset($input['xe_may']) && $input['xe_may'] == 1){ 
            $phuongtien .= '2;';
            unset($input['xe_may']);
        }
        if(isset($input['o_to']) && $input['o_to'] == 1){
            $phuongtien .= '3;';
            unset($input['o_to']);
        }
        if(isset($input['may_bay']) && $input['may_bay'] == 1){
            $phuongtien .= '4;';
            unset($input['may_bay']);
        }
        unset($input['images1']);
        $input['images'] = $allPic;
        $input['phuong_tien'] = $phuongtien;
        $tour = Tour::create($input);
        
        \Session::flash('flash_message', 'Tour đã được tạo thành công!');

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
        $tour = Tour::findOrFail($id);
        
        if($tour === null){
            return view('errors.404');
        }
        
        $nguoi_dan = User::find($tour->nguoi_dan);
//        dd($nguoi_dan->name);
        

        return view('phuothanoi.show')->withtour($tour)->withhdv($nguoi_dan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = Tour::find($id);

        if (is_null($tour))
        {
            return Redirect::route('tour.index');
        }

        $hdvs = DB::table('users')->where('type','=',1)->pluck('name', 'id'); //Loaibds::pluck('name', 'id');

        return \View::make('phuothanoi.edit', compact(['tour','hdvs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTourRequest $request, $id)
    {
        $input = $request->all();
        
        $phuongtien = '';
        if(isset($input['xe_dap']) && $input['xe_dap'] == 1){
            $phuongtien .= '1;';
            unset($input['xe_dap']);
        }
        if(isset($input['xe_may']) && $input['xe_may'] == 1){ 
            $phuongtien .= '2;';
            unset($input['xe_may']);
        }
        if(isset($input['o_to']) && $input['o_to'] == 1){
            $phuongtien .= '3;';
            unset($input['o_to']);
        }
        if(isset($input['may_bay']) && $input['may_bay'] == 1){
            $phuongtien .= '4;';
            unset($input['may_bay']);
        }
        $input['phuong_tien'] = $phuongtien;
        $day = substr($input['ngay_khoi_hanh'], 0, 2);
        $month = substr($input['ngay_khoi_hanh'], 3, 2);
        $year = substr($input['ngay_khoi_hanh'], 6, 4);
//        dd($year);
        $input['ngay_khoi_hanh'] = $year . '-' . $month . '-' . $day . ' 00:00:00';
        $day1 = substr($input['ngay_ket_thuc'], 0, 2);
        $month1 = substr($input['ngay_ket_thuc'], 3, 2);
        $year1 = substr($input['ngay_ket_thuc'], 6, 4);
        $input['ngay_ket_thuc'] = $year1 . '-' . $month1 . '-' . $day1 . ' 00:00:00';
//        var_dump($input);die;
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

        $tour = Tour::find($id);
        
        if($tour === null){
            return view('errors.404');
        }

        $tour->update($input);

        \Session::flash('flash_message', 'Tour đã được sửa thành công!');

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
        $tour = Tour::find($id);

        if (is_null($tour))
        {
            Session::flash('flash_message', 'Không tìm thấy tour bạn muốn xóa!');
            return Redirect::route('tour.index');
        }

        $tour->delete();

        Session::flash('flash_message', 'Tour đã được xóa thành công!');

        return redirect()->route('tour.index');
    }
}
