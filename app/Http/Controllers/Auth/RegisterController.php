<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;

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
     * Where to redirect users after registration.
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
            'user_id' => 'required|string|min:6|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:32|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dateTime = date("Y-m-d H:i:s");
        $setting = DB::table('governors_settings')->
            where('id', 1)->first();
        return User::create([
            'name' => $data['user_id'],
            'user_id' => $data['user_id'],
            'email' => $data['email'],
            'image' => 'default/dummy.png',
            'now_point' => $setting->basic_income,
            'status' => 1,
            'ip' =>  $_SERVER["REMOTE_ADDR"],
            'host' =>  gethostname(),
            'user_agent' =>  $_SERVER['HTTP_USER_AGENT'],
            'password' => Hash::make($data['password']),
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ]);
    }
}
