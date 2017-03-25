<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
        ]);
        
//        Mail::send('emails.welcome', [], function ($message) {
//
//            $message->from('admin@chodatso.com', 'chodatso.com');
//
//            $message->to('tran.thanh.tuan269@gmail.com')->subject('Cám ơn Quý khách đã đồng ý sử dụng dịch vụ của chúng tôi!');
//        });
        
        $data_email = array( 'email' => $data['email'] );
        
        Mail::send('emails.welcome', [], function($message) use ($data_email) {
            $message->to($data_email['email'])->subject('Cám ơn Quý khách đã đồng ý sử dụng dịch vụ của chúng tôi!');
        });
        
        return $user;
    }
}
