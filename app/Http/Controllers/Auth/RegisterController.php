<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\University;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'gender' => ['required','numeric','min:0', 'max:1'],
            'username' => ['required', 'string','min:3', 'max:255', 'unique:users','regex:/^[A-Za-z0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'university' => ['required','min:3'],
            'city' => ['required','min:3'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['university_id'] != null){
            $university = University::find($data['university_id']);

            if (($data['university'] != $university->name)){
                $data['university_id'] = null;
            }
        }

        if (($data['university_id'] == null)){
            $university = University::create(['name'=>$data['university']]);
            $data['university_id'] = $university->id;
        }

        if($data['city_id'] != null){
            $city = City::find($data['city_id']);

            if (($data['city'] != $city->name)){
                $data['city_id'] = null;
            }
        }

        if (($data['city_id'] == null)){
            $city = City::create(['name'=>$data['city']]);
            $data['city_id'] = $city->id;
        }


        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city_id' => $data['city_id'],
            'university_id' => $data['university_id'],
        ]);
    }
}
