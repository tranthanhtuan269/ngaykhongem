<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateDiadanhRequest;
use App\Diadanh;
use App\User;
use DB;
use Session;
use App\Followdiadanh;
use Auth;

class DiadanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diadanhs = DB::table('diadanh')
                    ->paginate(8);
        
        return view('diadanh.index')->withdiadanhs($diadanhs);
    }
    
    public function xemtatcadiadanh()
    {
        $diadanhs = DB::table('diadanh')
                    ->paginate(8);
        
        return view('diadanh.xemtatca')->withdiadanhs($diadanhs);
    }
    
    public function followdiadanh($id){
        $diadanh = Diadanh::findOrFail($id);
        
        if($diadanh === null){
            return view('errors.404');
        }
        
        // add user to follow table
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $today = date("Y-m-d H:i:s"); 
            $followDiaDanh = new Followdiadanh();

            $followDiaDanh->user_id = $user_id;
            $followDiaDanh->diadanh_id = $id;
            $followDiaDanh->created_at = $today;
            $followDiaDanh->updated_at = $today;

            $followDiaDanh->save();
        }
        // send email to Quan
        // show alert to user
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diadanh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiadanhRequest $request)
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
        unset($input['images1']);
        $input['images'] = $allPic;
        $diadanh = Diadanh::create($input);
        
        \Session::flash('flash_message', 'Địa danh đã được tạo thành công!');

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
        $diadanh = Diadanh::findOrFail($id);
        
        if($diadanh === null){
            return view('errors.404');
        }        

        return view('diadanh.show')->withdiadanh($diadanh);
    }
    
    public function xemdiadanh($id)
    {
        $diadanh = Diadanh::findOrFail($id);
        
        if($diadanh === null){
            return view('errors.404');
        }        

        return view('diadanh.nshow')->withdiadanh($diadanh);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diadanh = Diadanh::find($id);

        if (is_null($diadanh))
        {
            return Redirect::route('diadanh.index');
        }

        return \View::make('diadanh.edit', compact(['diadanh']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDiadanhRequest $request, $id)
    {
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

        $diadanh = Diadanh::find($id);
        
        if($diadanh === null){
            return view('errors.404');
        }

        $diadanh->update($input);

        \Session::flash('flash_message', 'Địa danh đã được sửa thành công!');

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
        $diadanh = Diadanh::find($id);

        if (is_null($diadanh))
        {
            Session::flash('flash_message', 'Không tìm thấy địa danh bạn muốn xóa!');
            return Redirect::route('diadanh.index');
        }

        $diadanh->delete();

        Session::flash('flash_message', 'Địa danh đã được xóa thành công!');

        return redirect()->route('diadanh.index');
    }
}
