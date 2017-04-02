<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateHDVRequest;
use App\Http\Requests\UpdateHDVRequest;
use App\User;
use DB;
use Session;

class HdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hdvs = DB::table('users')
                    ->where('type', '=', '1')
                    ->paginate(8);
        return view('hdv.index')->withhdvs($hdvs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hdv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHDVRequest $request)
    {
        // upload images to server
        $picture = '';
        $allPic = '';
        if ($request->hasFile('images1')) {
            $file = $request->file('images1');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').$filename;
            $destinationPath = base_path() . '/public/images';
            $file->move($destinationPath, $picture);
        }
        // add images to database
        $input = $request->all();
        unset($input['images1']);
        $input['avatar'] = $picture;
        $input['type'] = 1;
        $input['password'] = '123456';
        $user = User::create($input);
        
        \Session::flash('flash_message', 'Hướng dẫn viên đã được tạo thành công!');

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
        $hdv = User::findOrFail($id);
        
        if($hdv === null || $hdv->type != 1){
            return view('errors.404');
        }

        return view('hdv.show')->withhdv($hdv);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hdv = User::find($id);

        if (is_null($hdv))
        {
            return Redirect::route('hdv.index');
        }
        
        return \View::make('hdv.edit', compact(['hdv']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHDVRequest $request, $id)
    {
        $input = $request->all();
        
        $picture = '';
        $allPic = '';
        if ($request->hasFile('images1')) {
            $file = $request->file('images1');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').$filename;
            $destinationPath = base_path() . '/public/images';
            $file->move($destinationPath, $picture);
            unset($input['images1']);
            $input['avatar'] = $picture;
        }

        $hdv = User::find($id);
        
        if($hdv === null){
            return view('errors.404');
        }

        $hdv->update($input);

        \Session::flash('flash_message', 'Hướng dẫn viên đã được sửa thành công!');

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
        $hdv = User::find($id);

        if (is_null($hdv) || $hdv->type != 1)
        {
            Session::flash('flash_message', 'Không tìm thấy hướng dẫn viên bạn muốn xóa!');
            return Redirect::route('hdv.index');
        }

        $hdv->delete();

        Session::flash('flash_message', 'Hướng dẫn viên đã được xóa thành công!');

        return redirect()->route('hdv.index');
    }
}
