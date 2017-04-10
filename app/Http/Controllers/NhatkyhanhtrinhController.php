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
use Mail;

class NhatkyhanhtrinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diadanhs = DB::table('diadanh')->where('type','=',2)
                    ->paginate(8);
        
        return view('nhatkyhanhtrinh.index')->withdiadanhs($diadanhs);
    }
    
    public function xemtatcadiadanh()
    {
        if(Auth::user()){
            $diadanhs = DB::table('diadanh')->where('type','=',2)
                        ->paginate(8);
            $follows = DB::table('followdiadanh')
                        ->where('user_id', '=', Auth::user()->id)
                        ->get();
            $arr = [];
            foreach($follows as $follow){
                $arr[] = $follow->diadanh_id;
            }
        }else{
           $diadanhs = DB::table('diadanh')->where('type','=',2)->paginate(8);
           $arr = [];
        }
        return view('nhatkyhanhtrinh.xemtatca')->withdiadanhs($diadanhs)->witharrayfollow($arr);
    }
    
    public function followdiadanh($id){
        $diadanh = Diadanh::findOrFail($id);
        
        if (is_null($diadanh))
        {
            $returnArr['code'] = 0;
            $returnArr['message'] = "Notfound";
            return json_encode($returnArr);
        }
        
        // add user to follow table
        if(Auth::user()){
            
            $checkfollow = DB::table('followdiadanh')
                    ->where('user_id', Auth::user()->id)
                    ->where('diadanh_id', $id)
                    ->get();
            if($checkfollow){
                $returnArr['code'] = 1;
                $returnArr['message'] = "Success";
                return json_encode($returnArr);
            }
            
            $user_id = Auth::user()->id;
            $today = date("Y-m-d H:i:s"); 
            $followDiaDanh = new Followdiadanh();

            $followDiaDanh->user_id = $user_id;
            $followDiaDanh->diadanh_id = $id;
            $followDiaDanh->created_at = $today;
            $followDiaDanh->updated_at = $today;

            $followDiaDanh->save();
            $returnArr['code'] = 1;
            $returnArr['message'] = "Success";
            // send email to Quan
            $user = \Auth::user();
            
            Mail::send('emails.followTour', [], function($message) use ($user) {
                $message->from('admin@chodatso.com', 'chodatso.com');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()){
            return view('nhatkyhanhtrinh.create');
        }else{
            return view('errors.404');
        }
    }
    
    public function postImage(\Illuminate\Support\Facades\Request $request){
        $file = $request::file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $picture = date('His').$filename;
        $destinationPath = base_path() . '/public/images';
        $file->move($destinationPath, $picture);
        echo url('/').'/images/'.$picture;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiadanhRequest $request)
    {
        if(Auth::user()){
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
            $input['type'] = 2;
            $input['created_by'] = Auth::user()->id;
            $diadanh = Diadanh::create($input);

            \Session::flash('flash_message', 'Nhật ký hành trình đã được tạo thành công!');

            return redirect()->back();
        }else{
            return view('errors.404');
        }
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
        
        if($diadanh === null || $diadanh->type == 1){
            return view('errors.404');
        }        

        return view('nhatkyhanhtrinh.show')->withdiadanh($diadanh);
    }
    
    public function xemdiadanh($id)
    {
        $diadanh = Diadanh::findOrFail($id);
        
        if($diadanh === null || $diadanh->type == 1){
            return view('errors.404');
        }        

        return view('nhatkyhanhtrinh.nshow')->withdiadanh($diadanh);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()){
            $diadanh = Diadanh::find($id);
            if (is_null($diadanh))
            {
                return Redirect::route('nhatkyhanhtrinh.index');
            }
            return \View::make('nhatkyhanhtrinh.edit', compact(['diadanh']));
        }else{
            return view('errors.404');
        }
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
        if(Auth::user()){
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

            if($diadanh === null || $diadanh->type == 1){
                return view('errors.404');
            }

            $diadanh->update($input);

            \Session::flash('flash_message', 'Nhật ký hành trình đã được sửa thành công!');

            return redirect()->back();
        }else{
            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkAccess()){
            $diadanh = Diadanh::find($id);

            if (is_null($diadanh) || $diadanh->type == 1)
            {
                Session::flash('flash_message', 'Không tìm thấy nhật ký hành trình bạn muốn xóa!');
                return Redirect::route('nhatkyhanhtrinh.index');
            }

            $diadanh->delete();

            Session::flash('flash_message', 'Nhật ký hành trình đã được xóa thành công!');

            return redirect()->route('nhatkyhanhtrinh.index');
        }else{
            return view('errors.404');
        }
    }
    
    public function checkAccess(){
        if(Auth::user()->id == 11262 || Auth::user()->id == 11264 || Auth::user()->id == 11265 || Auth::user()->id == 1) return true;
        return false;
    }
}
