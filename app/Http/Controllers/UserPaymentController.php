<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentWay;
use App\Models\UserPayment;
use App\Models\UserWallet;
use Auth;

class UserPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
      $payment_methods= UserPayment::where('user_id',Auth::id())->get();
      $users= User::where('id',Auth::id())->first();
      return view('user.pages.user_payments',compact('users','payment_methods'));
    }
    public function wallet($id)
    {
      $wallet_settings= UserWallet::where('user_id',Auth::id())->get();
      $users= User::where('id',Auth::id())->first();
      return view('user.pages.user_wallets',compact('users','wallet_settings'));
    }
    public function store(Request $request)
    {

      $payment_methods = new UserPayment();
      $payment_methods->user_id= $request->user_id;
      $payment_methods->payment_way_id= $request->payment_way_id;
      $payment_methods->wallet_no= $request->wallet_no;
      $payment_methods->save();

        return back()->with('payment_added', 'Payment Method Added Successfully !!');

    }
    public function update(Request $request)
    {

      $payment_methods = UserPayment::find($request->id);
      $payment_methods->user_id= $request->user_id;
      $payment_methods->payment_way_id= $request->payment_way_id;
      $payment_methods->wallet_no= $request->wallet_no;
      $payment_methods->save();

        return back()->with('payment_updated', 'Payment Method Updated Successfully !!');

    }
     public function storeWallet(Request $request)
    {

      $wallet = new UserWallet();
      $wallet->user_id= $request->user_id;
      $wallet->wallet_name= $request->wallet_name;
      $wallet->wallet_no= $request->wallet_no;
      $wallet->save();

        return back()->with('wallet_added', 'Wallet Added Successfully !!');

    }
    public function updateWallet(Request $request)
    {

      $wallet= UserWallet::find($request->id);
      $wallet->user_id= Auth::id();
      $wallet->wallet_name= $request->wallet_name;
      $wallet->wallet_no= $request->wallet_no;
      $wallet->save();

        return back()->with('wallet_updated', 'Wallet Updated Successfully !!');

    }


}
