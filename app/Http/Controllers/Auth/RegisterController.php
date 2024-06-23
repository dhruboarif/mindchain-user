<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Redirect;
use Auth;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Alert;

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
     
     
     public function showRegistrationForm(Request $request)
{
    if ($request->has('ref')) {
        session(['referrer' => $request->query('ref')]);
    }

    return view('auth.register');
}

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
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
    protected function create(array $data)
    {
        
    //dd($data['sponsor']);
    if($data['sponsor']!= null)
    {
        
        $sponsor =  User::where('user_name','like', $data['sponsor'])->select('id','user_name')->first();
     
         $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random = substr(str_shuffle($chars), 0, 7);
        $data2= User::create([
           // 'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
         //   'address' => $data['address'],
          //  'city' => $data['city'],
          //  'postal_code' => $data['postal_code'],
         //   'country' => $data['country'],
            'sponsor' => $sponsor->id,
            'password' => Hash::make($data['password']),
            'key_id' => $random,
        ]);
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $data2->id, 
              'token' => $token
            ]);
  
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($data2){
              $message->to($data2->email);
              $message->subject('Email Verification Mail');
          });
         $email = $data['email'];
        Mail::to($email)->send(new WelcomeMail($data));
       
        //return $data2= Auth::logout();
         //return $data2;
         Alert::success('Success', 'Successfully Registered. Please check your email to verify your account!!');
       return redirect()->route('login');
       
       
       
    }else{
        
        $sponsor =  User::where('id',11223344)->first();
     
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random = substr(str_shuffle($chars), 0, 7);
        $data2= User::create([
          //  'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
          //  'address' => $data['address'],
          //  'city' => $data['city'],
         //   'postal_code' => $data['postal_code'],
         //   'country' => $data['country'],
            'sponsor' => $sponsor->id,
            'password' => Hash::make($data['password']),
            'key_id' => $random,
        ]);
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $data2->id, 
              'token' => $token
            ]);
  
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($data2){
              $message->to($data2->email);
              $message->subject('Email Verification Mail');
          });
         $email = $data['email'];
        Mail::to($email)->send(new WelcomeMail($data));
        
        //return $data2= Auth::logout();
         //return $data2;
         Alert::success('Success', 'Successfully Registered. Please check your email to verify your account!!');
       return redirect()->route('login');
        
        //return $data2;
        
        
    }
    
        
     
    }
    
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'user_name' => ['required', 'string', 'string', 'max:255', 'unique:users', 'unique:users', 'regex:/^\S*$/u'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if($request->sponsor != null)
    {
        $sponsor =  User::where('user_name','like', $request->sponsor)->select('id','user_name')->first();
     
         $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random = substr(str_shuffle($chars), 0, 7);
      
      $user= new User();
      $user->email = $request->email;
      $user->user_name= $request->user_name;
      $user->password= Hash::make($request->password);
      $user->sponsor= $sponsor->id;
      $user->key_id = $random;
      $user->save();
      $token = Str::random(64);
      
      $user_verify = new UserVerify();
      $user_verify->user_id = $user->id;
      $user_verify->token = $token;
      $user_verify->save();
       Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($user){
              $message->to($user->email);
              $message->subject('Email Verification Mail');
          });
         $email = $user->email;
       Mail::to($email)->send(new WelcomeMail($user));
        
        //return $data2= Auth::logout();
         //return $data2;
         Alert::success('Success', 'Successfully Registered. Please check your email to verify your account!!');
       return redirect()->route('login');
        
    }else{
        $sponsor =  User::where('id',1)->first();
     
         $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $random = substr(str_shuffle($chars), 0, 7);
      
      $user= new User();
      $user->email = $request->email;
      $user->user_name= $request->user_name;
      $user->password= Hash::make($request->password);
      $user->sponsor= $sponsor->id;
      $user->key_id = $random;
      $user->save();
      $token = Str::random(64);
      
      $user_verify = new UserVerify();
      $user_verify->user_id = $user->id;
      $user_verify->token = $token;
      $user_verify->save();
       Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($user){
              $message->to($user->email);
              $message->subject('Email Verification Mail');
          });
         $email = $user->email;
       Mail::to($email)->send(new WelcomeMail($user));
        
        //return $data2= Auth::logout();
         //return $data2;
         Alert::success('Success', 'Successfully Registered. Please check your email to verify your account!!');
       return redirect()->route('login');
        
        
    }
    
    
    }
    
    
    public function getSponsor(Request $request)
    {

        $userName = User::where('user_name','like',$request->search)->select('id','user_name')->first();
        if ($userName){
            return response()->json(['success'=>'<span style="color: green;">User found!!</span>','data'=>$userName],200);
        }else{
            return response()->json(['success'=>'<span style="color: red;">User not found!!</span>'],200);
        }

    }
//     protected function registered(Request $request, $user)
// {
//     if ($user->referrer !== null) {
//         Notification::send($user->referrer, new ReferrerBonus($user));
//     }

//     return redirect($this->redirectPath());
// }

public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('error', $message);
    }
    
    public function checkDuplicate(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        //dd($username);
        $usernameTaken = User::where('user_name', $username)->exists();
        $emailTaken = User::where('email', $email)->exists();
    
        return response()->json([
            'username_taken' => $usernameTaken,
            'email_taken' => $emailTaken
        ]);
    }
}
