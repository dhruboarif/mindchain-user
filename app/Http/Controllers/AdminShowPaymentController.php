<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddMoney;
use App\Models\Withdraw;
use App\Models\WithdrawBonus;
use App\Models\BonusWallet;
use App\Models\User;
use App\Models\UsdWallet;
use App\Models\EliteSetting; 
use Auth;
use Illuminate\Support\Facades\Mail;

class AdminShowPaymentController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  public function depositUSD()
  {
    $deposit = UsdWallet::where('method', 'Deposit')->orderBy('created_at', 'desc')->get();

    return view('admin.pages.deposit_request_usd',compact('deposit'));
  }
  
 public function rejectUSD($id)
  {
//dd('test');
    //Transection approve
      UsdWallet::findOrFail($id)->update([
          'status'=>'rejected'
      ]);
      return back()->with('Money_approved', 'Deposit Request is Rejected. !!');
  }
  
   public function approveUSD($id)
  {
    
//dd('test');
    //Transection approve
      UsdWallet::findOrFail($id)->update([
          'status'=>'approve'
      ]);


      return back()->with('Money_approved', 'Deposit Request is Approved. !!');
  }
  
  public function Manage()
  {
    $deposit = AddMoney::where('method', 'Deposit')->orderBy('created_at', 'desc')->get();

    return view('admin.pages.deposit_request_manage',compact('deposit'));

  }
  public function approve($id)
  {

      AddMoney::findOrFail($id)->update([
          'status'=>'approve'
      ]);

      return back()->with('Money_approved', 'Deposit Request is Approved. !!');
  }
  public function rejectedDeposit($id)
  {

      AddMoney::findOrFail($id)->update([
          'status'=>'rejected'
      ]);

      return back()->with('Money_approved', 'Deposit Request is Rejected. !!');
  }
  public function ManageWithdraw()
  {
    $withdraw = Withdraw::orderBy('created_at', 'desc')->get();

//dd($withdraw);

    return view('admin.pages.withdraw_request_manage',compact('withdraw'));

  }
    public function ManageUsdWithdraw()
  {
    $withdraw= UsdWallet::where('method', 'Withdraw')->orderBy('created_at', 'desc')->get();
//dd($withdraw);

    return view('admin.pages.withdraw_usd_request_manage',compact('withdraw'));

  }
  public function ManageWithdrawBonus()
  {
    $withdraw = WithdrawBonus::orderBy('created_at', 'desc')->get();

    return view('admin.pages.withdrawbonus_request_manage',compact('withdraw'));

  }
  public function withdrawapprove(request $request)
  {
        
        $data= Withdraw::find($request->id);
        $user= User::where('id',$data->user_id)->first();
//dd($user);
      Withdraw::findOrFail($request->id)->update([
          'status'=>'approve',
          'transaction_hash'=> $request->transaction_hash
      ]);
      
      Mail::send('emails.withdrawApproved', ['data' => $data, 'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('Withdraw request approved');
          });

      return back()->with('Money_approved', 'Withdraw request is Approved. !!');
  }
  
  public function withdrawUsdApprove(Request $request)
  {
        //dd($request->all()); 
        //dd($request->transaction_hash); 
        $data= UsdWallet::find($request->id);
        $user= User::where('id',$data->user_id)->first();
//dd($user);
      UsdWallet::findOrFail($request->id)->update([
          'status'=>'approve',
          'transaction_hash'=>$request->transaction_hash
      ]);
      
      Mail::send('emails.withdraw_usd_approved', ['data' => $data, 'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('Withdraw request approved');
          });

      return back()->with('Money_approved', 'Withdraw request is Approved. !!');
  }
  
   public function withdrawUsdRejected($id)
  {
        //dd($id);
        $data= UsdWallet::find($id);
        $user= User::where('id',$data->user_id)->first();
//dd($user);
      UsdWallet::findOrFail($id)->update([
          'status'=>'rejected'
      ]);
      
      Mail::send('emails.withdraw_usd_reject', ['data' => $data, 'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('Withdraw request Rejected');
          });

      return back()->with('Money_approved', 'Withdraw request is Rejected. !!');
  }
  
  public function withdrawbonusapprove(Request $request)
  {
        //dd($request->all()); 
        
      WithdrawBonus::findOrFail($request->id)->update([
          'status'=>'approve',
          'transaction_hash'=> $request->transaction_hash
      ]);

      return back()->with('Money_rejected', 'Withdraw request is Approved. !!');
  }
  public function withdrawrejected($id,$user_id,$amount)
  {


      Withdraw::findOrFail($id)->update([
          'status'=>'rejected'
      ]);
      $withdraw_reject = new AddMoney;
      $withdraw_reject->user_id = $user_id;
      $withdraw_reject->amount = $amount;
      $withdraw_reject->method = 'Withdraw Refund';
      $withdraw_reject->type = 'Credit';
      $withdraw_reject->description = '$' . ($amount) . ' Withdraw Refund to Cash Wallet';

      $withdraw_reject->status = 'approve';
      $withdraw_reject->save();
      
      
              //dd($id);
        $data= Withdraw::find($id);
        $user= User::where('id',$data->user_id)->first();
//dd($user);

      
      Mail::send('emails.withdrawRejected', ['data' => $data, 'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('Withdraw request Rejected');
          });
      

      return back()->with('Money_rejected', 'Withdraw request is Rejected !!');
  }
   public function withdrawbonusrejected($id,$user_id,$amount)
  {


      WithdrawBonus::findOrFail($id)->update([
          'status'=>'rejected'
      ]);
      $withdraw_reject = new BonusWallet;
      $withdraw_reject->user_id = $user_id;
      $withdraw_reject->amount = $amount;
      $withdraw_reject->method = 'Withdraw Refund';
      $withdraw_reject->type = 'Credit';
      $withdraw_reject->status = 'approved';
      $withdraw_reject->description = 'MIND' . ($amount) . ' Withdraw Refund to Your Wallet';

      
      $withdraw_reject->save();

      return back()->with('Money_rejected', 'Withdraw request is Rejected !!');
  }
  
   public function ManageToken()
  {
    $deposit = BonusWallet::where('method', 'Deposit')->orderBy('created_at', 'desc')->get();

    return view('admin.pages.token_request_manage',compact('deposit'));

  }
  public function approveToken($id)
  {

      BonusWallet::findOrFail($id)->update([
          'status'=>'approved'
      ]);

      return back()->with('Money_approved', 'Deposit Request is Approved. !!');
  }
  public function rejectedDepositToken($id)
  {

      BonusWallet::findOrFail($id)->update([
          'status'=>'rejected'
      ]);

      return back()->with('Money_approved', 'Deposit Request is Rejected. !!');
  }

}


