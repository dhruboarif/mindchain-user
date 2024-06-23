<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\AddMoney;
use App\Models\UsdWallet;
use App\Models\TokenWallet;
use App\Models\BonusWallet;
use App\Models\AmbassadorWallet;
use App\Models\WithdrawCommission;
use App\Models\Withdraw;
use App\Models\NowPayment;
use App\Models\WithdrawBonus;
use App\Models\EliteSetting;
use App\Models\usdStaking; 
use Carbon\Carbon;
use Mail;
use Shakurov\Coinbase\Coinbase;
use App\Models\UsdtWithdrawInfo;


class AddMoneyController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index($id)
  {
    $user= User::where('id',Auth::id())->first();
    $deposit= AddMoney::where('method','Deposit')->where('user_id',Auth::id())->get();
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');

      return view('user.pages.add_money',compact('user','deposit','data'));
  }
  public function Store(Request $request)
  {
    //  dd($request);
      // $request->validate([
      //     'amount' => 'required',
      //     'method' => 'required',
      //
      // ]);
      $client = new \GuzzleHttp\Client();
      $token= '9S3WW3P-JRB43DN-PBCJ23E-P9W96H3';
      //$token= 'F2QJSJ9-B5YME5J-MW4WBJJ-2M4NSET';

      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      $headers = [
          // 'Authorization' => 'Bearer ' . $api_key,
          //'x-api-key'        => 'F2QJSJ9-B5YME5J-MW4WBJJ-2M4NSET',
          'x-api-key'        => '9S3WW3P-JRB43DN-PBCJ23E-P9W96H3',
          'Content-Type' => 'application/json',



      ];


      //Duplicate these three lines for calling other api

      $payment = $client->request('POST','https://api.nowpayments.io/v1/invoice', [
              'headers' => $headers,
              'json' => [

                "price_amount"=> $request['amount'],
                "price_currency"=> "usd",
                //"pay_currency"=> "usdtbsc",
                  "pay_currency"=> $request['pay_currency'],
                "ipn_callback_url"=> "https://defi.mindchain.info/home/",
                "success_url"=> "https://defi.mindchain.info/home/approve_fund/".$request['amount'].'/'. $description,
                "cancel_url"=> "https://defi.mindchain.info/home",
                "order_id"=> $description,
                "order_description"=> "Deposit",

            ]

         ]);


    $payment=$payment->getBody()->getContents();




    $data = json_decode($payment, true);


    return redirect($data['invoice_url']);

      return back()->with('Money_added', 'Successfully Added Funds. Waiting for the Confirmation!!');
  }
  public function StoreManual(Request $request)
  {
    if(Auth::user()->status == 0)
    {
          return back()->with('Money_added', 'You are not eligible!!');
    };
    $deposit = new AddMoney();

    $deposit->user_id = Auth::id();
    $deposit->amount = $request->amount;
    //$deposit->method=$method;
    $deposit->wallet_id= $request->payment_wallet_id;

    $deposit->method = 'Deposit';
    $deposit->type = 'Credit';
    $deposit->status = 'pending';
    $deposit->description= 'Deposit Manually';
    $deposit->txn_id = $request->txn_id;
    $deposit->save();

      return back()->with('Money_added', 'Successfully Added Funds. Waiting for the Confirmation!!');
  }
  public function approveFund($amount,$description)
  {

    $deposit = new AddMoney();

    $deposit->user_id = Auth::id();
    $deposit->amount = $amount;
    //$deposit->method=$method;

    $deposit->method = 'Deposit';
    $deposit->type = 'Credit';
    $deposit->status = 'approve';
    $deposit->description= 'Deposit by Now Payments';
    $deposit->txn_id = $description;
    $deposit->save();
    return redirect()->route('home')->with('Money_added', 'Successfully Added Funds!!');

  }

public function StoreUSD(Request $request)
    {
       $rules = [
       'txn_id' => 'required|unique:usd_wallets,txn_id',
    ];
    
    $messages = [
        'txn_id.unique' => 'The provided transaction ID has already been used.',
    ];
       
      
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return back()->with('token_sell_error', 'Transaction hash should not be duplicate!!');
    }
    
    if($request->amount < 10)
    {
        return back()->with('token_sell_error', 'Minimum Deposit Amount 10 USDT');
    };
    if($request->amount > 5000)
    {
        return back()->with('token_sell_error', 'Maximum Deposit Amount 5000 USDT');
    };
    if(Auth::user()->status == 0)
    {
          return back()->with('token_sell_error', 'You are not eligible!!');
    };
    
      $deposit = new UsdWallet();

    $deposit->user_id = Auth::id();
    $deposit->amount = $request->amount;
    //$deposit->method=$method;
    $deposit->wallet_id= $request->payment_wallet_id;

    $deposit->method = 'Deposit';
    $deposit->type = 'Credit';
    $deposit->status = 'pending';
    $deposit->description= 'Deposit Manually for Elite Club';
    $deposit->txn_id = $request->txn_id;
    $deposit->save();

      return back()->with('Money_added', 'Successfully Request sent. Waiting for the Confirmation!!');

    }

public function joinElite(Request $request)
    {

 //dd('Maintance running');
 if(Auth::user()->status == 0)
    {
          return back()->with('join_error', 'You are not eligible!!');
    };


    $Membershipfee = EliteSetting::first(); 
    $mem_fee = $Membershipfee->mem_fee;
    $Balance_usdwallet = UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    
//    dd($mem_fee, $Balance_usdwallet); 

    
    if($Balance_usdwallet < $mem_fee)
        {
            return back()->with('join_error', 'Insufficent Balance');
        }
    
    
    $deduct = new UsdWallet();
    $deduct->user_id = Auth::id();
    $deduct->amount = -($mem_fee);
    //$deposit->method=$method;

    $deduct->method = 'Buy Elite Membership';
    $deduct->type = 'Debit';
    $deduct->status = 'approve';
    $deduct->description= $request->mem_fee . ' is deducted for buying Elite Membership';
    $deduct->save();
    
//Add Staking Wallet
    $EliteSetting = EliteSetting::first(); 


    $stakingUsd = new usdStaking(); 
    $stakingUsd->user_id = Auth::id();
    $stakingUsd->amount = $mem_fee;  
    $stakingUsd->daily_bonus = $EliteSetting->daily_bonus;  
    $stakingUsd->method = 'Purchased Elite Membership ';
    $stakingUsd->type = 'Debit';
    $stakingUsd->description = 'Purchased Elite Membership with ' .  $mem_fee . ' USD';
    $stakingUsd->status = 'Approve';
    $stakingUsd->save();


// //user status update to elite member
    $userId= Auth::id();
    $user = User::find($userId);
//     //dd($user);
    $user->elite_club = 1;
    // Save the record
    $user->save();

// //Sponsor Bonus
    $userSponsor = User::where('id',$user->sponsor)->first(); 
    $sponsor_bonus = $EliteSetting->sponsor_bonus / 100; 
    $lv1_1_bonus = $EliteSetting->lvl1 / 100; 
    $bonusPercentage = $sponsor_bonus + $lv1_1_bonus; 
    
    $Total_bonusAmount = $EliteSetting->mem_fee * $bonusPercentage ;
    
//     //dd($Total_bonusAmount);

    
    $deposit = new UsdWallet();
    $deposit->user_id = $userSponsor->id;
    $deposit->amount = $Total_bonusAmount;
    //$deposit->method=$method;

    $deposit->method = 'Bonus';
    $deposit->type = 'Credit';
    $deposit->status = 'approve';
    $deposit->description= 'Level one and Sponsor Bonus for Sponsoring Elite Member';
    $deposit->save();

//Level 2 Sponsor Bonus
    $lvl2Sponsor = User::where('id',$userSponsor->sponsor)->first(); 
    //dd($lvl2Sponsor);
    
    $bonus_pc_lv2 = $EliteSetting->lvl2 / 100; 
    $lv2_bonusAmount = $EliteSetting->mem_fee * $bonus_pc_lv2;
    
    //dd($lv2_bonusAmount);

    $deposit = new UsdWallet();
    $deposit->user_id = $lvl2Sponsor->id;
    $deposit->amount = $lv2_bonusAmount;
    //$deposit->method=$method;

    $deposit->method = 'Level 2 Bonus';
    $deposit->type = 'Credit';
    $deposit->status = 'approve';
    $deposit->description= $lv2_bonusAmount . 'USD Level 2 bonus Credited for Elite Member ';
    $deposit->save();


      return back()->with('join_success', 'Successfully purchased ELite Membership!!');

    }

  public function withdraw_manage($id)
  {
    $user= User::where('id',Auth::id())->first();
    $deposit= AddMoney::where('method','Deposit')->where('user_id',Auth::id())->get();
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();
     

    $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    $data['withdraws']= Withdraw::where('user_id',Auth::id())->orderBy('created_at', 'desc')->get();

      return view('user.pages.withdraw_money',compact('user','deposit','data'));
  }
  public function withdrawbonus_manage($id)
  {
    $user= User::where('id',Auth::id())->first();
    $deposit= BonusWallet::where('method','Deposit')->where('user_id',Auth::id())->get();
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=BonusWallet::where('user_id',Auth::id())->where('status','approved')->sum('amount');
    $data['withdrawbonus']= WithdrawBonus::where('user_id',Auth::id())->orderBy('id','desc')->get();

      return view('user.pages.withdrawbonus_money',compact('user','deposit','data'));
  }
  
  
  public function withdraw_store(Request $request)
  {
    //dd($request->all());
    $rules = [
        'amount' => 'required|numeric|min:' . 1,
    ];
    
    $messages = [
      'amount.required' => 'The amount field is required.',
      'amount.numeric' => 'The amount must be a numeric value.',
      'amount.min' => 'The amount must be at least ' . 1,
  ];
   if(Auth::user()->status == 0)
    {
          return back()->with('withdraw_error', 'You are not eligible!!');
    };
    

    // Validate the input
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return back()
            ->withErrors($validator)  // Pass validation errors to the view
            ->withInput();           // Keep the user's input data
    }
    
    
    
    $withdraw_settings=WithdrawCommission::first();
    //dd($settings->withdraw_charge);
    $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    $data['withdraw']=Withdraw::where('user_id',Auth::id())->where('status','awaiting')->count();

    //dd($sum_deposit < $calculated_amount,$sum_deposit,$calculated_amount);

     if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('withdraw_error', 'Insufficent Balance');
    }
    elseif($data['withdraw'] > 0)
    {
         return back()->with('withdraw_error', 'You already have a pending withdraw request!');
    }
    
    
    else{
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $code = substr(str_shuffle($chars), 0, 8);
      $withdraw = new Withdraw();
      $withdraw->user_id = $request->user_id;
      $withdraw->amount = $request->amount;

      $withdraw->payment_method_id = $request->payment_method_id;
      $withdraw->wallet_id=$request->wallet_id;
      $withdraw->payable= ($request->amount)- (($request->amount)*(($withdraw_settings->withdraw_commission) / 100));
      $withdraw->status = 'awaiting';
      $withdraw->confirmation_code= $code;


      $withdraw->save();
      $data= User::where('id',$request->user_id)->first();
      Mail::send('emails.transferconfirmation', ['code' => $withdraw->confirmation_code], function($message) use($data){
        $message->to($data->email);
        $message->subject('Withdraw Confirmation Code');
        
    });

      return back()->with('withdraw_added', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm withdraw button to complete the withdraw!!');
    }

  }
 public function withdrawbonus_store(Request $request)
  {
      if(Auth::user()->status == 0)
    {
          return back()->with('withdraw_error', 'You are not eligible!!');
    };
    $withdraw_settings=WithdrawCommission::first();
    //dd($settings->withdraw_charge);
    $data['sum_deposit']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
     $data['withdraw']=WithdrawBonus::where('user_id',Auth::id())->where('status','awaiting')->count();
     $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $data['sum_withdraw'] = WithdrawBonus::where('user_id', Auth::id())
    ->where('status', '!=', 'rejected')
    ->whereMonth('created_at', $currentMonth)
    ->whereYear('created_at', $currentYear)
    ->sum('amount');
    
     //dd($data['sum_withdraw']);
     
    if($data['sum_withdraw']+$request->amount > $withdraw_settings->monthly_withdraw_coin_limit)
    {
        return back()->with('withdraw_error', 'Your monthly withdraw limit exceeded.');
    };

   // dd($data['sum_deposit']);
    if($request->amount < $withdraw_settings->min_token_withdraw)
    {
        return back()->with('withdraw_error', 'Minimum Withdraw Amount ' .$withdraw_settings->min_token_withdraw .' MIND');
    };
    if($request->amount > $withdraw_settings->max_token_withdraw)
    {
        return back()->with('withdraw_error', 'Maximum Withdraw Amount ' .$withdraw_settings->max_token_withdraw .' MIND');
    };


    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('withdraw_error', 'Insufficent Balance');
    }
    elseif($data['withdraw'] > 0)
    {
         return back()->with('withdraw_error', 'You already have a pending withdraw request!');
    }
    
    
    else{
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $code = substr(str_shuffle($chars), 0, 8);
      $withdraw = new WithdrawBonus();
      $withdraw->user_id = $request->user_id;
      $withdraw->amount = $request->amount;

      $withdraw->wallet_method_id = $request->wallet_method_id;
      $withdraw->wallet_no=$request->wallet_no;
      $withdraw->payable= ($request->amount)- (($request->amount)*(($withdraw_settings->withdraw_commission) / 100));
      $withdraw->status = 'awaiting';
      $withdraw->confirmation_code= $code;


      $withdraw->save();
      $data= User::where('id',$request->user_id)->first();
      Mail::send('emails.transferconfirmation', ['code' => $withdraw->confirmation_code], function($message) use($data){
        $message->to($data->email);
        $message->subject('Withdraw Confirmation Code');
        
    });

      // $deduct = new BonusWallet;
      // $deduct->user_id = Auth::id();
      // $deduct->amount = -($request->amount);
      // $deduct->method = 'Withdraw';
      // $deduct->type = 'Debit';
      // $deduct->status = 'approved';
      // $deduct->description = 'MIND' . ($request->amount) . ' Withdraw from Bonus Wallet';

      
      // $deduct->save();
      
      //return back()->with('withdraw_added', 'Your request is Accepted. Wait for Confirmation!!');
      return back()->with('withdraw_added', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm withdraw button to complete the withdraw!!');
    }

  }

  public function withdrawconfirmation(Request $request)
  {
     $withdraw= WithdrawBonus::find($request->id);
     $data['sum_deposit']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
     if($data['sum_deposit'] < $withdraw->amount)
    {
        return back()->with('withdraw_error', 'Insufficent Balance');
    }
     if ($request->confirmation_code == $withdraw->confirmation_code) {
       $withdraw->status = 'pending';
       $withdraw->save();
        
        $deduct = new BonusWallet;
      $deduct->user_id = Auth::id();
      $deduct->amount = -($withdraw->amount);
      $deduct->method = 'Withdraw';
      $deduct->type = 'Debit';
      $deduct->status = 'approved';
      $deduct->description = 'MIND' . ($withdraw->amount) . ' Withdraw from Bonus Wallet';

      $deduct->save();
      
      return back()->with('withdraw_added', 'Your request is Accepted. Wait for Confirmation!!');
     }else
     {
       return back()->with('withdraw_error', 'You entered wrong code');
     }
  }
  
  public function withdrawMindCancel(Request $request)
  {
     
     //dd($request->all()); 
     $withdraw= WithdrawBonus::find($request->id);
     if($withdraw->status == 'approve'){
        return back()->with('withdraw_error', 'Already Approved by admin. you cannot cancel !! ');
     }
     
     WithdrawBonus::findOrFail($request->id)->update([
          'status'=>'canceled'
      ]);
    
      $withdrawRefund = new BonusWallet;
      $withdrawRefund->user_id = Auth::id();
      $withdrawRefund->amount = $withdraw->amount;
      $withdrawRefund->method = 'Withdraw Refund';
      $withdrawRefund->type = 'credit';
      $withdrawRefund->status = 'approved';
      $withdrawRefund->description = 'MIND' . ($withdraw->amount) . ' Withdraw refund to Bonus Wallet';
      $withdrawRefund->save();
      
    return back()->with('withdraw_added', 'Your Cancel request is Accepted. And your balance is refunded !! ');

  }
  public function fundwithdrawconfirmation(Request $request)
  {
     $withdraw= Withdraw::find($request->id);
      $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    
     if($data['sum_deposit'] < $withdraw->amount)
    {
        return back()->with('withdraw_error', 'Insufficent Balance');
    }
     if ($request->confirmation_code == $withdraw->confirmation_code) {
       $withdraw->status = 'pending';
       $withdraw->save();
        
          $deduct = new AddMOney;
      $deduct->user_id = Auth::id();
      $deduct->amount = -($withdraw->amount);
      $deduct->method = 'Withdraw';
      $deduct->type = 'Debit';
      $deduct->status = 'approve';
      $deduct->description = '$' . ($withdraw->amount) . ' Withdraw from Cash Wallet';

      
      $deduct->save();
      
      return back()->with('withdraw_added', 'Your request is Accepted. Wait for Confirmation!!');
     }else
     {
       return back()->with('withdraw_error', 'You entered wrong code');
     }
  }
  
  public function musdWithdrawCancel(Request $request)
  {
     //dd($request->all());
     $withdraw= Withdraw::find($request->id);
     if($withdraw->status == 'approve'){
        return back()->with('withdraw_error', 'Already Approved by admin. you cannot cancel !! ');
     }
       $withdraw->status = 'canceled';
       $withdraw->save();
        
      $refund = new AddMOney;
      $refund->user_id = $request->user_id;
      $refund->amount = $withdraw->amount;
      $refund->method = 'Withdraw Refund';
      $refund->type = 'Credit';
      $refund->status = 'approve';
      $refund->description = '$' . ($withdraw->amount) . ' Withdraw refunded to Cash Wallet';
      $refund->save();
      
      return back()->with('withdraw_added', 'Your Cancel request is Accepted. Balance Refunded to Cash Wallet!!');
  }
  
  public function withdrawUSD($id)
  {
    $user= User::where('id',Auth::id())->first();
    $deposit= UsdWallet::where('method','Deposit')->where('user_id',Auth::id())->get();
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit'] = UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve'])
                               ->sum('amount');

    $data['withdraw_usd']= UsdWallet::where('user_id',Auth::id())->where('method','Withdraw')->orderBy('id','desc')->get();
//dd($data['withdraw_usd']);
      return view('user.pages.withdrawusd',compact('user','deposit','data'));
  }
  
  public function withdrawUsdStore(Request $request)
  {
      if(Auth::user()->status == 0)
    {
          return back()->with('withdraw_error', 'You are not eligible!!');
    };
    //dd($request->all());
    $withdraw_settings=UsdtWithdrawInfo::first();
    //dd($settings->withdraw_charge);
    $data['sum_deposit']=UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
     $data['withdraw']=UsdWallet::where('user_id',Auth::id())->whereIn('status', ['awaiting','pending'])->count();
     
     $currentMonth = Carbon::now()->month;

   
  
    //  $data['sum_withdraw']=WithdrawBonus::where('user_id',Auth::id())->where('status','!=','rejected') ->whereMonth('created_at', $currentMonth)->sum('amount');
    // // dd($data['sum_withdraw']);
    // if($data['sum_withdraw']+$request->amount > $withdraw_settings->monthly_withdraw_coin_limit)
    // {
    //     return back()->with('withdraw_error', 'Your monthly withdraw limit exceeded.');
    // };

   // dd($data['sum_deposit']);
    // if($request->amount < $withdraw_settings->min_token_withdraw)
    // {
    //     return back()->with('withdraw_error', 'Minimum Withdraw Amount ' .$withdraw_settings->min_token_withdraw .' MIND');
    // };
    // if($request->amount > $withdraw_settings->max_token_withdraw)
    // {
    //     return back()->with('withdraw_error', 'Maximum Withdraw Amount ' .$withdraw_settings->max_token_withdraw .' MIND');
    // };
    $validator = Validator::make($request->all(), [
    'amount' => "required|numeric|min:15|max:250",
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('withdraw_error', 'Insufficent Balance');
    }
    elseif($data['withdraw'] > 0)
    {
         return back()->with('withdraw_error', 'You already have a pending withdraw request!');
    }
    
    
    else{
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $code = substr(str_shuffle($chars), 0, 8);
      $withdraw = new UsdWallet();
      $withdraw->user_id = $request->user_id;
      $withdraw->amount = -($request->amount);
      $withdraw->payable= ($request->amount)- (($request->amount)*(($withdraw_settings->withdraw_commission) / 100));
      $withdraw->method = 'Withdraw';
      $withdraw->type = 'Debit';
      $withdraw->description = '$' . $request->amount . ' Withdraw from USD Wallet';
      
      $withdraw->wallet_id = $request->wallet_method_id;
      $withdraw->wallet_no=$request->wallet_no;
      $withdraw->status = 'awaiting';
      $withdraw->confirmation_code= $code;


      $withdraw->save();
      $data= User::where('id',$request->user_id)->first();
      Mail::send('emails.transferconfirmation', ['code' => $withdraw->confirmation_code], function($message) use($data){
        $message->to($data->email);
        $message->subject('Withdraw Confirmation Code');
        
    });

      // $deduct = new BonusWallet;
      // $deduct->user_id = Auth::id();
      // $deduct->amount = -($request->amount);
      // $deduct->method = 'Withdraw';
      // $deduct->type = 'Debit';
      // $deduct->status = 'approved';
      // $deduct->description = 'MIND' . ($request->amount) . ' Withdraw from Bonus Wallet';

      
      // $deduct->save();
      
      //return back()->with('withdraw_added', 'Your request is Accepted. Wait for Confirmation!!');
      return back()->with('withdraw_added', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm withdraw button to complete the withdraw!!');
    }
    
  }
  
  public function withdrawUsdconfirmation(Request $request)
  {
     $withdraw= UsdWallet::find($request->id);
     if ($request->confirmation_code == $withdraw->confirmation_code) {
       $withdraw->status = 'pending';
       $withdraw->save();
      
      return back()->with('withdraw_added', 'Your request is Accepted. Wait for Confirmation!!');
     }else
     {
       return back()->with('withdraw_error', 'You entered wrong code');
     }
  }
  
  public function withdrawUsdcancel(Request $request)
  {
     $withdraw= UsdWallet::find($request->id);
     if($withdraw->status == 'approve'){
        return back()->with('withdraw_error', 'Already Approved by admin. you cannot cancel !! ');
     }
       $withdraw->status = 'cancel';
       $withdraw->save();
      
       return back()->with('withdraw_added', 'Your withdraw request cancel successful!!');
  }
  
    public function AdminAddMoney(Request $request)
    {
      $receiver_id= User::where('user_name',$request->user_id)->pluck('id')->first();
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      $deposit = new AddMoney();

      $deposit->user_id =  $receiver_id;
      $deposit->amount = $request->amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Deposit';
      $deposit->type = 'Credit';
      $deposit->status = 'approve';
      $deposit->description= 'Deposit by Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      return back()->with('Money_added', 'Successfully Added Funds!!');
    }
    public function AdminAmbassadorAddMoney(Request $request)
    {
        //dd($request);
      $receiver= User::where('ambassador','1')->get();
        $user_count=User::where('ambassador','1')->count();
         $bonus_amount=($request->amount)/$user_count;
      //dd($receiver);
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      foreach($receiver as $row)
      {
        $deposit = new AddMoney();

      $deposit->user_id =  $row->id;
      $deposit->amount = $bonus_amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Ambassador Bonus';
      $deposit->type = 'Credit';
      $deposit->status = 'approve';
      $deposit->description= $bonus_amount.'$ Ambassador Bonus from Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      }
      
      return back()->with('Money_added', 'Successfully Added Funds!!');
    }
    public function AdminAmbassadorAddToken(Request $request)
    {
        //dd($request);
      $receiver= User::where('ambassador','1')->get();
        $user_count=User::where('ambassador','1')->count();
         $bonus_amount=($request->amount)/$user_count;
      //dd($receiver);
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      foreach($receiver as $row)
      {
        $deposit = new AmbassadorWallet();

      $deposit->user_id =  $row->id;
      $deposit->amount = $bonus_amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Ambassador Bonus';
      $deposit->type = 'Credit';
     
      $deposit->description= $bonus_amount.' MIND Ambassador Bonus from Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      }
      
      return back()->with('token_added', 'Successfully Added Funds!!');
    }
    public function AdminAddMoneyToken(Request $request)
    {
      $receiver_id= User::where('user_name',$request->user_id)->pluck('id')->first();
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      $deposit = new TokenWallet();

      $deposit->user_id =  $receiver_id;
      $deposit->amount = $request->amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Deposit';
      $deposit->type = 'Credit';

      $deposit->description= $request->amount .' MIND amount'.' Deposit by Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      return back()->with('Money_added', 'Successfully Added Funds!!');
    }
    public function AdminAddMoneyBonus(Request $request)
    {
      $receiver_id= User::where('user_name',$request->user_id)->pluck('id')->first();
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      $deposit = new BonusWallet();

      $deposit->user_id =  $receiver_id;
      $deposit->amount = $request->amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Deposit';
      $deposit->type = 'Credit';
      $deposit->status = 'approved';

      $deposit->description= $request->amount .' Bonus amount'.' Deposit by Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      return back()->with('Money_added', 'Successfully Added Funds!!');
    }
    
    public function AdminAddUsdt(Request $request)
    {
      $receiver_id= User::where('user_name',$request->user_id)->pluck('id')->first();
      $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $description = substr(str_shuffle($chars), 0, 10);
      $deposit = new UsdWallet();

      $deposit->user_id =  $receiver_id;
      $deposit->amount = $request->amount;
      $deposit->received_from=Auth::id();

      $deposit->method = 'Deposit';
      $deposit->type = 'Credit';
      $deposit->status = 'approve';
      $deposit->description= 'Deposit by Admin';
      $deposit->txn_id = $description;
      $deposit->save();
      return back()->with('Money_added', 'Successfully Added USDT!!');
    }
    public function mind_index($id)
  {
    $user= User::where('id',Auth::id())->first();
    $deposit= BonusWallet::where('method','Deposit')->where('user_id',Auth::id())->get();
    $data['deposit']=BonusWallet::where('user_id',Auth::id())->first();

    $data['sum_deposit_bonus']=BonusWallet::where('user_id',Auth::id())->where('status','approved')->sum('amount');

      return view('user.pages.add_token',compact('user','deposit','data'));
  }
  public function StoreMindManual(Request $request)
  {
      if(Auth::user()->status == 0)
    {
          return back()->with('Money_added', 'You are not eligible!!');
    };

    $deposit = new BonusWallet();

    $deposit->user_id = Auth::id();
    $deposit->amount = $request->amount;
    //$deposit->method=$method;
    $deposit->wallet_id= $request->payment_wallet_id;

    $deposit->method = 'Deposit';
    $deposit->type = 'Credit';
    $deposit->status = 'pending';
    $deposit->description= 'Deposit Manually';
    $deposit->txn_id = $request->txn_id;
    $deposit->save();

      return back()->with('Money_added', 'Successfully Added Funds. Waiting for the Confirmation!!');
  }
}
