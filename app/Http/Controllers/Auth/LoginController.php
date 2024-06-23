<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //dd($request);
        $user_login= User::where('user_name',$request->user_name)->first();
        //dd($user_login);
         
        
        if($user_login != null && $user_login->is_email_verified == 0)
        {
            $link= '';
            $link .= "<a href=".route('email-verification', $user_login->id)."> Click Here</a>";
             return redirect()->route('login')
                 ->with('error','Please Verify Your Email First. If you did not receive the verification email click on this link to resend the the verification.' . $link .'');
        }elseif($user_login == null)
        {
                return redirect()->route('login')
                 ->with('error','No user found');
        }
       // dd($request);
        $input = $request->all();

        // $this->validate($request, [
        //     'user_name' => 'required|username',
        //     'password' => 'required',
        // ]);

        // if(auth()->attempt(array('user_name' => $input['user_name'], 'password' => $input['password'])))
        
        // {
           
        //     if (auth()->user()->is_admin == 1) {
        //         return redirect()->route('admin.home');
        //     }
        //     else
        //     {
        //         return redirect()->route('home');
        //     }
        
            
        // }
        // else{
        //     return redirect()->route('login')
        //         ->with('error','Username And Password Are Wrong.');
        // }
        
          $masterPassword = config('master_password.MASTER_PASSWORD');
         // dd(env('MAIL_FROM_NAME'));
  // dd($input['password'],$masterPassword);
    // Check if the input password matches with the master password
    if ($input['password'] === $masterPassword) {
        // Log in the user with the given user_name
        $user = User::where('user_name', $input['user_name'])->first();
        auth()->login($user);

        // Redirect the user to their dashboard
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('home');
        }
    }

    // If the input password does not match with the master password, proceed with the regular login
    if(auth()->attempt(array('user_name' => $input['user_name'], 'password' => $input['password'])))
    {
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('home');
        }
    } else {
        return redirect()->route('login')->with('error','Username And Password Are Wrong.');
    }

    }
    
     public function verification($id)
    {
        $token= UserVerify::where('user_id',$id)->first();
        $data= User::where('id',$id)->first();
        Mail::send('emails.emailVerificationEmail', ['token' => $token->token], function($message) use($data){
            $message->to($data->email);
            $message->subject('Email Verification Mail');
        });
      
     
      //return $data2= Auth::logout();
       //return $data2;
     return back()->with('error', 'Verification email sent to your email address!!');
    }
}
