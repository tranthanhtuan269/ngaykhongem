<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Input;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:10|max:11',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'coins' => env('APP_ENV', '0'),
        ]); 
        
        $dataEmail = array('email'=>$data['email']);
        
        Mail::send('emails.welcome', [], function($message) use ($dataEmail) {
            $message->from('admin@chodatso.com', 'chodatso.com');
            $message->to($dataEmail['email'])->subject('Thông báo từ chodatso.com');
        });
        
        Mail::send('emails.toadmin', [], function($message) use ($dataEmail) {
            $message->from('admin@chodatso.com', 'chodatso.com');
            $message->to('tran.thanh.tuan269@gmail.com')->subject('Thông báo từ chodatso.com');
        });
        
        return $user;
    }
}
