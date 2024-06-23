<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Alert;
use Mail;
use Illuminate\Support\Str;
use App\Models\UserVerify;


class AffilateController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
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
          'email' => ['required', 'string', 'email', 'max:255'],
          'user_name' => ['required', 'string', 'string', 'max:255', 'unique:users','unique:users','regex:/^\S*$/u'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function userAdd(Request $request)
  {

    //$sponsor =  User::where('id',Auth::id())->first();
  //  dd($sponsor->id);
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random = substr(str_shuffle($chars), 0, 7);
      $data= User::create([
          'name' => $request['name'],
          'user_name' => $request['user_name'],
          'email' => $request['email'],
          'sponsor' => Auth::id(),

          'country' => $request['country'],
          'address' => $request['address'],
          'city' => $request['city'],



          'package_id' => $request['postal_code'],


          'password' => Hash::make($request['password']),
        'key_id' => $random,
      ]);
      $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $data->id, 
              'token' => $token
            ]);
  
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($data){
              $message->to($data->email);
              $message->subject('Email Verification Mail');
          });
      $notification = array(
            'message' => 'Affilate has been Successfully Registered!!!! !!!',
            'alert-type' => 'success'
        );
        // Alert::success('Success', 'Affilate has been Successfully Registered!!!! !!!');
        // return Redirect()->back()->with($notification);

      return back()->with('add_affilate', 'Affilate has been Successfully Registered!!!!');
  }
  public function index($id)
  {
    $users= User::where('sponsor',Auth::id())->get();

    return view('user.pages.affilates',compact('users'));
  }
  public function add_affilate($id)
  {

    $users= User::where('sponsor',Auth::id())->get();

    return view('user.pages.add_affilates',compact('users'));
  }
}
