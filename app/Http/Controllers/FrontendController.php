<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddMoney;
use App\Models\BonusWallet;
use App\Models\TokenWallet;
use Auth;
use App\Models\PackageSettings;
use App\Models\TokenRate;
use App\Models\Purchase;
use Carbon\Carbon;
use App\Models\SellToken;
use App\Models\BuyToken;
use App\Models\Contactus;
use App\Mail\ContactMail;
use App\Models\TransferInfo;
use Illuminate\Support\Facades\Mail;
use App\Models\LevelSetting;
use App\Models\Kyc;
use Illuminate\Support\Facades\Storage;
use App\Models\StakingSetting;
use App\Models\PurchaseStake;
use App\Models\StakingWallet;
use App\Models\BannerSetting;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Models\AmbassadorWallet;
use App\Models\MusdStakingSetting;
use App\Models\MusdWallet;
use App\Models\UsdWallet;
use App\Models\usdStaking; 
use App\Models\PurchaseMusd;
use App\Models\TopbarInfo;
use App\Models\CouponWallet;
use App\Models\Coupon;
use App\Models\CommunityToken; 
use App\Models\BaseMind; 
use App\Models\PurcahseCommunityToken; 
use App\Models\BmindWallet; 
use App\Models\BmindTarget; 

use App\Models\CommunityTokenPackageSettings; 
use App\Models\bmind_staking_wallets; 
use App\Notifications\PurchaseStakingNotification;
use App\Notifications\MusdStakingNotification;
use App\Models\EliteSetting;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FrontendController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  
 
  public function index()
  {
    $data['user']=User::where('id',Auth::id())->first();;
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    $data['sum_deposit_bonus']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved'])
                               ->sum('amount');
    $data['sum_deposit_token']=TokenWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_staking']=StakingWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_mstaking']=MusdWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_usdwallet']= UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve'])
                               ->sum('amount');
    $data['sum_usd_staking']=usdStaking::where('user_id',Auth::id())->where('status', 'approve')->sum('amount');
    $data['sum_bmindwallet'] = BmindWallet::where('user_id',Auth::id())->where('status', 'approved')->sum('amount');
    $data['sum_bmind_staking'] = bmind_staking_wallets::where('user_id',Auth::id())->where('status', 'Approved')->sum('amount');


    $data['sum_deposit_ambassador']=AmbassadorWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_coupon']=CouponWallet::where('user_id',Auth::id())->sum('amount');
    //dd($data['sum_deposit']);
    
    $data['bmindTarget'] = BmindTarget::where('user_id', Auth::id())->first();
    $data['enddate'] = $data['bmindTarget'] ? Carbon::parse($data['bmindTarget']->end_date)->format('Y-m-d') : null;
    
    $data['settings']= TokenRate::first();
    $banner= BannerSetting::first();
    $data['topbar_info']= TopbarInfo::first();

    // try {
    // // Api data
    // $client = new Client();
    // // Make a GET request to the API endpoint
    // $response = $client->get('https://mainnet.mindscan.info/api/v2/main-page/transactions');
    
    // // Get the JSON response body as an associative array
    // $block = json_decode($response->getBody(), true);

    // // Initialize a variable to store the sum of the 'block' field
    // $data['block'] = 0;

    // // Loop through the data and calculate the sum of the 'block' field
    // foreach ($block as $item) {
    //     // Ensure the 'block' field exists in the current item before adding it to the sum
    //     if (isset($item['block'])) {
    //         $data['block'] += $item['block'];
    //     }
    // }
    // } catch (RequestException $e) {
    //     // Handle request exception (API server down, request failure, etc.)
    //     // Set $data['block'] to 0 or handle the error in a way that makes sense for your application
    //     $data['block'] = 0;
    // }
    $data['block'] = 0;
    
      return view('user.pages.index',compact('data','banner'));
  }
  
  public function elite_club()
  {
    $Membershipfee = EliteSetting::first(); 
    $data['mem_fee'] = $Membershipfee->mem_fee; 
    //dd($mem_fee); 
     $data['sum_usdwallet']=UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');

      return view('user.pages.elite_club', compact('data'));
  }
  
  public function buy_community_token()

      {
        $packages= CommunityToken::all();
        return view('user.pages.community_tokenlist',compact('packages'));
      }
  
  public function coupon($id)
  {
      $data['sum_deposit_coupon']=CouponWallet::where('user_id',Auth::id())->sum('amount');
      $data['coupons']= Coupon::where('created_by',Auth::id())->get();
      return view('user.pages.coupon',compact('data'));
  
      
  }
  public function coupon_store(Request $request)
  {
      if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };

      $data['sum_deposit_coupon']=CouponWallet::where('user_id',Auth::id())->sum('amount');
    //dd($data['sum_deposit_token']);
    if($data['sum_deposit_coupon'] < $request->coupon_value)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    };
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $code = substr(str_shuffle($chars), 0, 8);
    $coupon= new Coupon();
    $coupon->coupon_code = $code;
    $coupon->coupon_value = $request->coupon_value;
    $coupon->created_by= $request->created_by;
    $coupon->save();
    
    $deduct_money= new CouponWallet();
    $deduct_money->user_id = $request->created_by;
    $deduct_money->amount = - ($request->coupon_value);
    
    $deduct_money->method = 'Coupon Creation ';
    $deduct_money->type = 'Debit';

    $deduct_money->description =  '$' . $request->coupon_value. ' deducted for creating Coupon '.$coupon->coupon_code;
    $deduct_money->save();
    
    
     return back()->with('coupon_added', 'Coupon created Successfully');
    
    
  
      
  }
 public function validateCoupon(Request $request)
{
    $couponCode = $request->input('couponCode');

    // Perform the necessary validation against your database
    $coupon = Coupon::where('coupon_code', $couponCode)->where('validity', 0)->first();

    // Check if the coupon is valid and retrieve the coupon value
    $isValidCoupon = $coupon !== null;
    $couponValue = $isValidCoupon ? $coupon->coupon_value : 0;
    $couponCode= $isValidCoupon ? $coupon->coupon_code : 0;

    // Return the validation result and coupon value as a JSON response
    return response()->json([
        'valid' => $isValidCoupon,
        'coupon_value' => $couponValue,
        'coupon_code' => $couponCode
    ]);
}
  public function buy_package($id)
  {
    $data['user']=User::where('id',Auth::id())->first();;
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');

    $data['packages']=PackageSettings::all();

    return view('user.pages.buy_package',compact('data'));
  }
   public function become_merchant($id)
  {
    $data['user']=User::where('id',Auth::id())->first();;
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');

    $data['packages']=PackageSettings::all();

    return view('user.pages.become_merchant',compact('data'));
  }
  
  public function become_merchant_save(Request $request)
  {
    
    if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };
     // dd($request);
      $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');
    //dd($data['sum_deposit_token']);
    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    };
       $user= User::where('id',$request->user_id)->first();
   // $sponsor= User::where('id',$user->sponsor)->first();
    $deduct= new AddMoney();
    $deduct->user_id = $request->user_id;
    $deduct->amount = -($request->amount);


    $deduct->method = 'Merchant Membership ';
    $deduct->type = 'Debit';
    $deduct->status= 'approve';

    $deduct->description = 'Merchant membership charge deducted ' . ' $ ' . $request->amount;
    $deduct->save();
    $add_money= new CouponWallet();
    $add_money->user_id = $request->user_id;
    $add_money->amount = ($request->bonus_amount);
    
    $add_money->method = 'Coupon wallet deposit ';
    $add_money->type = 'Debit';

    $add_money->description = 'Added' . '$' . $request->bonus_amount. ' to Coupon Wallet by purchasing membership';
    $add_money->save();
    $member = User::where('id',$request->user_id)->first();
    $membership= User::find($member->id);
    $membership->merchant_status = 1;
    $membership->save();
     return back()->with('package_purchase', 'Merchant status updated successfully!!');
  }
  public function store_staking(Request $request)
  {
       if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };
    $rules = [
       'duration' => 'required',
       'amount' => 'required',
        ];
    
    $messages = [
        'txn_id.unique' => 'The provided transaction ID has already been used.',
        ];
       
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return back()->with('purchase_error', 'Please fill all field!!');
    }
    
    
    // $staking_wallets = StakingWallet::where('method', 'Purchased Staking Package')->get();
   
    // foreach($staking_wallets as $row){
    //   $user = User::find($row->user_id);
    //   //dd($user); 
    //   $user->user_purchase_status = 1;
    //   $user->save();
    // }
    //  $users= User::where('user_purchase_status',1)->get();
    // dd($users); 
    
    $staking= StakingSetting::first();
    //dd($staking);
    $data['sum_deposit_token']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
    //dd($data['sum_deposit_token']);
    if($data['sum_deposit_token'] < $request->amount)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    };
    if ($request->amount < $staking->min_staking) {
      return back()->with('purchase_error', 'Minimun amount to Buy '. $staking->min_staking .' MIND');
    };
    if ($request->amount > $staking->max_staking) {
      return back()->with('purchase_error', 'Maximum amount to Buy '. $staking->max_staking .' MIND');
    };
    
    $user= User::where('id',$request->user_id)->first();
    $sponsor= User::where('id',$user->sponsor)->first();
    $deduct= new BonusWallet();
    $deduct->user_id = $request->user_id;
    $deduct->amount = -($request->amount);


    $deduct->method = 'Purchased Staking Package ';
    $deduct->type = 'Debit';
    $deduct->status= 'approved';

    $deduct->description = 'Purchased Staking Package ' . ' for MIND ' . $request->amount;
    $deduct->save();
    $add_staking= new StakingWallet();
    $add_staking->user_id = $request->user_id;
    $add_staking->amount = ($request->amount);
    $add_staking->method = 'Purchased Staking Package ';
    $add_staking->type = 'Debit';

    $add_staking->description = 'Purchased Staking Package ' . ' for MIND ' . $request->amount;
    $add_staking->save();
    $purchase= new PurchaseStake();
    $purchase->user_id= $request->user_id;
    $purchase->amount= $request->amount;
    $purchase->duration= $request->duration;
    $purchase->total_value= $request->total_value;
    $purchase->days= $request->days;
    $purchase->apy_value= $request->apy_value;
    $purchase->daily= $request->daily;
    $purchase->save();
   
    if($request->days == 90)
    {
        $bonus_amount = new BonusWallet();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_90_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_90_af/100).' MIND'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->type = 'Credit';
        $bonus_amount->status = 'approved';
        $bonus_amount->save();
    }
    elseif($request->days == 180)
    {
        $bonus_amount = new BonusWallet();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_180_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_180_af/100).' MIND'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->type = 'Credit';
        $bonus_amount->status = 'approved';
        $bonus_amount->save();
    }
    elseif($request->days == 365)
    {
        $bonus_amount = new BonusWallet();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_365_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_365_af/100).' MIND'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approved';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
    elseif($request->days == 730)
    {
        $bonus_amount = new BonusWallet();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_730_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_730_af/100).' MIND'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approved';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
      else
    {
        $bonus_amount = new BonusWallet();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_1825_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_1825_af/100).' MIND'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approved';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
    $g_set = LevelSetting::first();
         if($g_set->status == 1)
         {
             $received_user= User::where('id',$request->user_id)->first();
                $lvl_1=User::where('id',$request->user_id)->first();
                //dd($lvl_1->placement_id);
                $lvl_1_placement= User::where('id',$lvl_1->sponsor)->first();


                //dd($lvl_1_placement);
                if($lvl_1_placement->ambassador == 1)
                {

                                $bonus_amount_l = new BonusWallet();
                                $bonus_amount_l->user_id = $lvl_1_placement->id;
                                $bonus_amount_l->received_from = $lvl_1->id;
                                $bonus_amount_l->amount = $request->amount * ($g_set->lvl_1/100);
                                $bonus_amount_l->method = 'Level Bonus';
                                $bonus_amount_l->type = 'Credit';
                                $bonus_amount_l->status = 'approved';

                                $bonus_amount_l->description= ($request->amount  * ($g_set->lvl_1/100)).' MIND'. ' Level 1 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount_l->save();
                }
                $lvl_2= User::where('id',$lvl_1_placement->sponsor)->first();
                //dd($lvl_2);
                 if($lvl_2 && $lvl_2->ambassador == 1)
                {

                                $bonus_amount_l = new BonusWallet();
                                $bonus_amount_l->user_id = $lvl_2->id;
                                $bonus_amount_l->received_from = $request->user_id;
                                $bonus_amount_l->amount = $request->amount * ($g_set->lvl_2/100);
                                $bonus_amount_l->method = 'Level Bonus';
                                $bonus_amount_l->type = 'Credit';
                                $bonus_amount_l->status = 'approved';

                                $bonus_amount_l->description= ($request->amount  * ($g_set->lvl_2/100)).' MIND'. ' Level 2 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount_l->save();
                
                $lvl_3= User::where('id',$lvl_2->id)->first();
                $lvl_3_placement= User::where('id',$lvl_3->sponsor)->first();
                
                    if($lvl_3_placement && $lvl_3_placement->ambassador == 1)
                    {
    
                         $bonus_amount_l = new BonusWallet();
                                    $bonus_amount_l->user_id = $lvl_3_placement->id;
                                    $bonus_amount_l->received_from = $request->user_id;
                                    $bonus_amount_l->amount = $request->amount * ($g_set->lvl_3/100);
                                    $bonus_amount_l->method = 'Level Bonus';
                                    $bonus_amount_l->type = 'Credit';
                                    $bonus_amount_l->status = 'approved';
                                    $bonus_amount_l->description= ($request->amount  * ($g_set->lvl_3/100)).' MIND'. ' Level 3 Bonus Credited from '. $received_user->user_name;
                                    $bonus_amount_l->save();
                                    
                    $lvl_4= User::where('id',$lvl_3_placement->id)->first();
                     $lvl_4_placement= User::where('id',$lvl_4->sponsor)->first();
                     
                     if($lvl_4_placement && $lvl_4_placement->ambassador == 1)
                        {
        
                             $bonus_amount_l = new BonusWallet();
                                        $bonus_amount_l->user_id = $lvl_4_placement->id;
                                        $bonus_amount_l->received_from = $request->user_id;
                                        $bonus_amount_l->amount = $request->amount * ($g_set->lvl_4/100);
                                        $bonus_amount_l->method = 'Level Bonus';
                                        $bonus_amount_l->type = 'Credit';
                                        $bonus_amount_l->status = 'approved';
        
                                        $bonus_amount_l->description= ($request->amount  * ($g_set->lvl_4/100)).' MIND'. ' Level 4 Bonus Credited from '. $received_user->user_name;
                                        $bonus_amount_l->save();
                                        
                            $lvl_5= User::where('id',$lvl_4_placement->id)->first();
                            $lvl_5_placement= User::where('id',$lvl_5->sponsor)->first();
                            
                             if($lvl_5_placement && $lvl_5_placement->ambassador == 1)
                            {
            
                                    $bonus_amount_l = new BonusWallet();
                                    $bonus_amount_l->user_id = $lvl_5_placement->id;
                                    $bonus_amount_l->received_from = $request->user_id;
                                    $bonus_amount_l->amount = $request->amount * ($g_set->lvl_5/100);
                                    $bonus_amount_l->method = 'Level Bonus';
                                    $bonus_amount_l->status = 'approved';
                                    $bonus_amount_l->type = 'Credit';
                                    $bonus_amount_l->description= ($request->amount  * ($g_set->lvl_5/100)).' MIND'. ' Level 5 Bonus Credited from '. $received_user->user_name;
                                    $bonus_amount_l->save();
                            }
                        }
                    }
                    
                }
                     
         }
    
    $data = [
        'name' => Auth::user()->name,
        'staking' => $purchase,
      ];
      
      //update user purchase status
      $user = User::find($request->user_id);
        $user->user_purchase_status = 1;
        $user->save();

      //dd($data);
      Auth::user()->notify(new PurchaseStakingNotification($data));
    return back()->with('package_purchase', 'Staking successful. Congratulations!!!');

  }

  public function buy_staking($id)
  {
    $data['user']=User::where('id',Auth::id())->first();
    
    $data['sum_deposit_bonus']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');


    $data['staking']=StakingSetting::first();

    return view('user.pages.buy_staking',compact('data'));
  }
   public function buy_mstaking($id)
  {
    $data['user']=User::where('id',Auth::id())->first();
    
    $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');


    $data['mstaking']=MusdStakingSetting::first();

    return view('user.pages.buy_mstaking',compact('data'));
  }
  public function store_mstaking(Request $request)
  {
    //dd($request->all());
    
    //$musd_wallets = MusdWallet::where('method', 'Purchased MUSD Staking ')->get();
    //   dd($musd_wallets); 

    // foreach($musd_wallets as $row){
    //   $user = User::find($row->user_id);
    //   //dd($user); 
    //   $user->user_purchase_status = 1;
    //   $user->save();
    // }
    // $users= User::where('user_purchase_status',1)->get();
    // dd($users); 
    
     if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };
    
    $staking= MusdStakingSetting::first();
    //dd($staking);
    if($request->coupon_code == null)
    {
         $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    //dd($data['sum_deposit_token']);
    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    };
    
        
    }
    if($request->coupon_code != null)
    {
        $check_coupon = Coupon::where('coupon_code',$request->coupon_code)->where('validity',0)->first();
        if($check_coupon == null)
        {
            return back()->with('purchase_error', 'Coupon is not valid!!!');
        };
       // $request->amount = $request->coupon_value ;
       $coupon_update= Coupon::where('coupon_code',$request->coupon_code)->first();
       $coup_up= Coupon::find($coupon_update->id);
       $coup_up->owned_by= Auth::id();
       $coup_up->validity = 1;
       $coup_up->save();
    }
   
    if ($request->amount < $staking->min_staking) {
      return back()->with('purchase_error', 'Minimun amount to Buy '. $staking->min_staking .' MIND');
    };
    if ($request->amount > $staking->max_staking) {
      return back()->with('purchase_error', 'Maximum amount to Buy '. $staking->max_staking .' MIND');
    };
    
    $user= User::where('id',$request->user_id)->first();
    $sponsor= User::where('id',$user->sponsor)->first();
   
      $deduct= new AddMoney();
    $deduct->user_id = $request->user_id;
     if($request->coupon_code == null)
    {
    $deduct->amount = -($request->amount);
    }else 
    {
         $deduct->amount = 0;
    }


    $deduct->method = 'Purchased Musd ';
    $deduct->type = 'Debit';
    $deduct->status= 'approve';
     if($request->coupon_code == null)
     {
          $deduct->description = 'Purchased Staking Package ' . ' for $ ' . $request->amount;
     }else 
     {
         $deduct->description = 'Purchased Staking Package ' . ' by Coupon Code ' . $request->coupon_code;
     }
         
     
    
    $deduct->save();   
    
    
   
    $add_staking= new MusdWallet();
    $add_staking->user_id = $request->user_id;
    $add_staking->amount = ($request->amount);
    


    $add_staking->method = 'Purchased MUSD Staking ';
    $add_staking->type = 'Debit';
    if($request->coupon_code == null)
    {
         $add_staking->description = 'Purchased Musd Package ' . ' for $ ' . $request->amount;
    }else 
    {
         $add_staking->description = 'Purchased Musd Package ' . ' by Coupon Code ' . $request->coupon_code;
    }
   
    $add_staking->save();
    $purchase= new PurchaseMusd();
    $purchase->user_id= $request->user_id;
    $purchase->amount= $request->amount;
    $purchase->duration= $request->duration;
    $purchase->total_value= $request->total_value;
    $purchase->days= $request->days;
    $purchase->apy_value= $request->apy_value;
    $purchase->daily= $request->daily;
    $purchase->save();
   
    if($request->days == 90)
    {
        $bonus_amount = new AddMoney();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_90_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_90_af/100).' $'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->type = 'Credit';
        $bonus_amount->status = 'approve';
        $bonus_amount->save();
    }
    elseif($request->days == 180)
    {
        $bonus_amount = new AddMoney();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_180_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_180_af/100).' $'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->type = 'Credit';
        $bonus_amount->status = 'approve';
        $bonus_amount->save();
    }
    elseif($request->days == 365)
    {
        $bonus_amount = new AddMoney();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_365_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_365_af/100).' $'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approve';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
    elseif($request->days == 730)
    {
        $bonus_amount = new AddMoney();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_730_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_730_af/100).' $'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approve';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
      else
    {
        $bonus_amount = new AddMoney();
        $bonus_amount->user_id = $sponsor->id;
        $bonus_amount->amount = $request->amount * ($staking->days_1825_af/100);
        $bonus_amount->description= $request->amount * ($staking->days_1825_af/100).' $'. ' Credited from '. $user->user_name;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->method = 'Affiliate Bonus';
        $bonus_amount->status = 'approve';
        $bonus_amount->type = 'Credit';
        $bonus_amount->save();
    }
    
    
        $data = [
        'name' => Auth::user()->name,
        'staking' => $purchase,
      ];

//Update purchase status
    $user = User::find($request->user_id);
    $user->user_purchase_status = 1;
    $user->save();
    

      //dd($data);
      Auth::user()->notify(new MusdStakingNotification($data));
    
    return back()->with('package_purchase', 'Staking successful. Congratulations!!!');

  }
  public function store_package(Request $request)
  {
       if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };
      $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->sum('amount');
      $package_id= PackageSettings::where('id',$request->package_id)->first();
      $sponsor=User::where('id',$request->user_id)->first();

    if($data['sum_deposit'] < $package_id->package_price)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    }else{


      //dd($sponsor->sponsor);
      //dd($package_id->package_price);
      $purchase= new Purchase();
      $purchase->user_id= $request->user_id;
      $purchase->package_id= $request->package_id;
      $purchase->date= Carbon::now();
      $purchase->save();

      $deduct= new AddMoney();
      $deduct->user_id = $request->user_id;
      $deduct->amount = -($package_id->package_price);
      //$deduct->method=$method;

      $deduct->method = 'Purchased Package ' . $package_id->package_name;
      $deduct->type = 'Debit';
      $deduct->status = 'approve';
      $deduct->description = 'Purchased Package ' . $package_id->package_name . ' for $' . $package_id->package_price;
      $deduct->save();
      $token_bonus = new TokenWallet();
      $token_bonus->user_id= $request->user_id;

      $token_bonus->amount= $package_id->amount;
      $token_bonus->method= 'Purchased Package';
      $token_bonus->type= 'Credit';
      $token_bonus->description= 'For Purchasing'. ' '. $package_id->package_name;
      $token_bonus->save();

      $bonus = new BonusWallet();
      $bonus->user_id= $sponsor->sponsor;
      $bonus->received_from= $request->user_id;
      $bonus->amount= ($package_id->amount)*(($package_id->affilate_token)/100);
      $bonus->method= 'Affiliate Bonus';
      $bonus->type= 'Credit';
      $bonus->status = 'approved';
      $bonus->description= ($package_id->amount)*(($package_id->affilate_token)/100). ' MIND Token ' . 'Affiliate Bonus from'. ' ' . Auth::user()->user_name;
      $bonus->save();
         $g_set = LevelSetting::first();
         if($g_set->status == 1)
         {
             $received_user= User::where('id',$request->user_id)->first();
                $lvl_1=User::where('id',$request->user_id)->first();
                //dd($lvl_1->placement_id);
                $lvl_1_placement= User::where('id',$lvl_1->sponsor)->first();


                //dd($lvl_1_placement);
                if($lvl_1_placement->ambassador == 1)
                {

                     $bonus_amount = new BonusWallet();
                                $bonus_amount->user_id = $lvl_1_placement->id;
                                $bonus_amount->received_from = $lvl_1->id;
                                $bonus_amount->amount = $package_id->amount * ($g_set->lvl_1/100);
                                $bonus_amount->method = 'Level Bonus';
                                $bonus_amount->type = 'Credit';
                                $bonus_amount->status = 'approved';

                                $bonus_amount->description= ($package_id->amount  * ($g_set->lvl_1/100)).' MIND'. ' Level 1 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount->save();
                }
                $lvl_2= User::where('id',$lvl_1_placement->sponsor)->first();
                //dd($lvl_2);
                 if($lvl_2->ambassador == 1)
                {

                     $bonus_amount = new BonusWallet();
                                $bonus_amount->user_id = $lvl_2->id;
                                $bonus_amount->received_from = $request->user_id;
                                $bonus_amount->amount = $package_id->amount * ($g_set->lvl_2/100);
                                $bonus_amount->method = 'Level Bonus';
                                $bonus_amount->type = 'Credit';
                                $bonus_amount->status = 'approved';

                                $bonus_amount->description= ($package_id->amount  * ($g_set->lvl_2/100)).' MIND'. ' Level 2 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount->save();
                }

                $lvl_3= User::where('id',$lvl_2->id)->first();

                $lvl_3_placement= User::where('id',$lvl_3->sponsor)->first();
               // dd($lvl_3_placement);
                if($lvl_3_placement->ambassador == 1)
                {

                     $bonus_amount = new BonusWallet();
                                $bonus_amount->user_id = $lvl_3_placement->id;
                                $bonus_amount->received_from = $request->user_id;
                                $bonus_amount->amount = $package_id->amount * ($g_set->lvl_3/100);
                                $bonus_amount->method = 'Level Bonus';
                                $bonus_amount->type = 'Credit';
                                $bonus_amount->status = 'approved';

                                $bonus_amount->description= ($package_id->amount  * ($g_set->lvl_3/100)).' MIND'. ' Level 3 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount->save();
                }


                $lvl_4= User::where('id',$lvl_3_placement->id)->first();
                 $lvl_4_placement= User::where('id',$lvl_4->sponsor)->first();
                  if($lvl_4_placement->ambassador == 1)
                {

                     $bonus_amount = new BonusWallet();
                                $bonus_amount->user_id = $lvl_4_placement->id;
                                $bonus_amount->received_from = $request->user_id;
                                $bonus_amount->amount = $package_id->amount * ($g_set->lvl_4/100);
                                $bonus_amount->method = 'Level Bonus';
                                $bonus_amount->type = 'Credit';
                                $bonus_amount->status = 'approved';

                                $bonus_amount->description= ($package_id->amount  * ($g_set->lvl_4/100)).' MIND'. ' Level 4 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount->save();
                }

                 $lvl_5= User::where('id',$lvl_4_placement->id)->first();
                 $lvl_5_placement= User::where('id',$lvl_5->sponsor)->first();
                  if($lvl_5_placement->ambassador == 1)
                {

                                $bonus_amount = new BonusWallet();
                                $bonus_amount->user_id = $lvl_5_placement->id;
                                $bonus_amount->received_from = $request->user_id;
                                $bonus_amount->amount = $package_id->amount * ($g_set->lvl_5/100);
                                $bonus_amount->method = 'Level Bonus';
                                $bonus_amount->status = 'approved';
                                $bonus_amount->type = 'Credit';

                                $bonus_amount->description= ($package_id->amount  * ($g_set->lvl_5/100)).' MIND'. ' Level 5 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount->save();
                }
         }


      return back()->with('package_purchase', 'Package Successfully Purchased!!');
    }


  }
  public function my_asset($id)
  {
    $purchase= Purchase::where('user_id',Auth::id())->get();
    //dd($purchase);
    return view('user.pages.my_asset',compact('purchase'));
  }
  public function my_asset_staking($id)
  {
    $purchase= PurchaseStake::where('user_id',Auth::id())->get();
    //dd($purchase);
    return view('user.pages.my_asset_staking',compact('purchase'));
  }
   public function my_asset_mstaking($id)
  {
    $purchase= PurchaseMusd::where('user_id',Auth::id())->get();
    //dd($purchase);
    return view('user.pages.my_assset_mstaking',compact('purchase'));
  }
  public function fund_transfer($id)
  {
    $user= User::where('id',Auth::id())->get();
    $data['deposit']=AddMoney::where('user_id',Auth::id())->first();

    $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');
    $transfer= AddMoney::where('user_id',Auth::id())->where('method','Transfer Money')->orderBy('id','desc')->where('type','Debit')->get();
    //dd($transfer);
    return view('user.pages.fund_transfer',compact('data','transfer'));
  }
  
  public function send_bonus($id)
  {
    $user= User::where('id',Auth::id())->get();
    $data['deposit']=BonusWallet::where('user_id',Auth::id())->first();

    $data['sum_deposit']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
     $transfer= BonusWallet::where('user_id',Auth::id())->where('method','Transfer Money')->orderBy('id','desc')->get();

    //dd($transfer); 

    return view('user.pages.send_bonus',compact('data','transfer'));
  }
  
   public function send_usdt($id)
  {
    $user= User::where('id',Auth::id())->get();
    $data['deposit']=UsdWallet::where('user_id',Auth::id())->first();

    $data['sum_deposit']=UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
     $transfer= UsdWallet::where('user_id',Auth::id())->where('method','Transfer Money')->orderBy('id','desc')->get();

    //dd($transfer); 

    return view('user.pages.send_usdt',compact('data','transfer'));
  }
  public function fund_transfer_store(Request $request)
  {
       if(Auth::user()->status == 0)
    {
          return back()->with('transfer_error', 'You are not eligible!!');
    };
    $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');
    
    $settings = TransferInfo::first();
    // Define validation rules
    $rules = [
        'amount' => 'required|numeric|min:' . $settings->transfer_limit_min . '|max:' . $settings->transfer_limit_max,
    ];
    
    $messages = [
      'amount.required' => 'The amount field is required.',
      'amount.numeric' => 'The amount must be a numeric value.',
      'amount.min' => 'The amount must be at least ' . $settings->transfer_limit_min,
      'amount.max' => 'The amount must not exceed ' . $settings->transfer_limit_max,
  ];
    

    // Validate the input
    $validator = Validator::make($request->all(), $rules, $messages);

    // Check if validation fails
    if ($validator->fails()) {
        return back()
            ->withErrors($validator)  // Pass validation errors to the view
            ->withInput();           // Keep the user's input data
    }
    

    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('transfer_error', 'Insufficent Balance');
    }else{
            
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code = substr(str_shuffle($chars), 0, 8);
            
            $receiver_id= User::where('user_name',$request->receiver_id)->pluck('id')->first();
            $receiver_name= User::where('id',$receiver_id)->first();


            $transfer_deduct= new AddMoney();
            $transfer_deduct->user_id= $request->user_id;
            $transfer_deduct->receiver_id= $receiver_id;
            $transfer_deduct->amount= -($request->amount);
            $transfer_deduct->method= 'Transfer Money';
            $transfer_deduct->type= 'Debit';
            $transfer_deduct->description= '$'.$request->amount .' Transfer to '. $receiver_name->user_name;
            //$transfer_deduct->status= 'approve';
            $transfer_deduct->status= 'pending';
            $transfer_deduct->confirmation_code= $code;
            $transfer_deduct->save();

          //  $sender_name= User::where('id',$request->user_id)->first();
        //    $transfer= new AddMoney();
          //  $transfer->user_id= $receiver_id;
           // $transfer->received_from= $request->user_id;
        //    $transfer->amount= $request->amount;
          //  $transfer->method= 'Transfer Money';
           // $transfer->type= 'Credit';
        //    $transfer->description= $request->amount .' Transfer amount from '. $sender_name->user_name;
          //  $transfer->status= 'approve';
           // $transfer->save();

             $data= User::where('id',$request->user_id)->first();
            Mail::send('emails.transferconfirmation', ['code' => $transfer_deduct->confirmation_code], function($message) use($data){
              $message->to($data->email);
              $message->subject('Transfer Confirmation Code');
          });

            return back()->with('transfer_fund', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm transfer button to complete the transfer');

    }


  }
  public function send_bonus_store(Request $request)
  {
     if(Auth::user()->status == 0)
    {
          return back()->with('transfer_error', 'You are not eligible!!');
    };
    $data['sum_deposit_bonus'] = BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
    $data['transfer'] = BonusWallet::where('user_id', Auth::id())->where('status', 'pending')->where('method', 'Transfer Money')->count();


    $validator = Validator::make($request->all(), [
        'amount' => "required|numeric|min:1|max:5001|lte:{$data['sum_deposit_bonus']}",
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    if ($data['transfer'] > 0) {
        return back()->with('transfer_error', 'You already have a pending transfer request.');
    }
    
    
    //dd($data['transfer']);

    if($data['sum_deposit_bonus'] < $request->amount)
    {
        return back()->with('transfer_error', 'Insufficent Balance');
    }elseif($data['transfer'] > 0)
    {
        return back()->with('transfer_error', 'You have already a pending transfer request');
        
    }
    
    else{
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code = substr(str_shuffle($chars), 0, 8);
            $receiver_id= User::where('user_name',$request->receiver_id)->pluck('id')->first();
            $receiver_name= User::where('id',$receiver_id)->first();


            $transfer_deduct= new BonusWallet();
            $transfer_deduct->user_id= $request->user_id;
            $transfer_deduct->receiver_id= $receiver_id;
            $transfer_deduct->amount= -($request->amount);
            $transfer_deduct->method= 'Transfer Money';
            $transfer_deduct->type= 'Debit';
            $transfer_deduct->description= 'MIND'.$request->amount .' Transfer to '. $receiver_name->user_name;
            $transfer_deduct->status= 'pending';
            $transfer_deduct->confirmation_code= $code;
            $transfer_deduct->save();
            // $sender_name= User::where('id',$request->user_id)->first();
            // $transfer= new BonusWallet();
            // $transfer->user_id= $receiver_id;
            // $transfer->received_from= $request->user_id;
            // $transfer->amount= $request->amount;
            // $transfer->method= 'Transfer Money';
            // $transfer->type= 'Credit';
            // $transfer->description= $request->amount .' Transfer amount from '. $sender_name->user_name;
            // $transfer->status= 'approved';
            // $transfer->save();

            $data= User::where('id',$request->user_id)->first();
            Mail::send('emails.transferconfirmation', ['code' => $transfer_deduct->confirmation_code], function($message) use($data){
              $message->to($data->email);
              $message->subject('Transfer Confirmation Code');
          });

            return back()->with('transfer_fund', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm transfer button to complete the transfer');

    }
  }
  
  public function send_usdt_store(Request $request)
  {
       if(Auth::user()->status == 0)
      {
            return back()->with('transfer_error', 'You are not eligible!!');
      };
    
    $data['sum_usdt'] = UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve','pending'])
                               ->sum('amount');

    $data['transfer'] = UsdWallet::where('user_id', Auth::id())->where('status', 'pending')->where('method', 'Transfer Money')->count();

    $validator = Validator::make($request->all(), [
        'amount' => "required|numeric|min:10|max:5001|lte:{$data['sum_usdt']}",
    ]);
   

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

   

    if ($data['transfer'] > 0) {
        return back()->with('transfer_error', 'You already have a pending transfer request.');
    }
    
    
    //dd($data['transfer']);

    if($data['sum_usdt'] < $request->amount)
    {
        return back()->with('transfer_error', 'Insufficent Balance');
    }
    else{
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code = substr(str_shuffle($chars), 0, 8);
            $receiver_id= User::where('user_name',$request->receiver_id)->pluck('id')->first();
            $receiver_name= User::where('id',$receiver_id)->first();

            $transfer_deduct= new UsdWallet();
            $transfer_deduct->user_id= $request->user_id;
            $transfer_deduct->receiver_id= $receiver_id;
            $transfer_deduct->amount= -($request->amount);
            $transfer_deduct->method= 'Transfer Money';
            $transfer_deduct->type= 'Debit';
            $transfer_deduct->description= 'USDT'.$request->amount .' Transfer to '. $receiver_name->user_name;
            $transfer_deduct->status= 'awaiting';
            $transfer_deduct->confirmation_code= $code;
            $transfer_deduct->save();
            
            // $sender_name= User::where('id',$request->user_id)->first();
            // $transfer= new BonusWallet();
            // $transfer->user_id= $receiver_id;
            // $transfer->received_from= $request->user_id;
            // $transfer->amount= $request->amount;
            // $transfer->method= 'Transfer Money';
            // $transfer->type= 'Credit';
            // $transfer->description= $request->amount .' Transfer amount from '. $sender_name->user_name;
            // $transfer->status= 'approved';
            // $transfer->save();

            $data= User::where('id',$request->user_id)->first();
            Mail::send('emails.transferconfirmation', ['code' => $transfer_deduct->confirmation_code], function($message) use($data){
              $message->to($data->email);
              $message->subject('Transfer Confirmation Code');
          });

return redirect()->route('send-usdt')
    ->with('transfer_fund', 'A confirmation code has been sent to your email. Please enter the confirmation code by clicking the confirm transfer button to complete the transfer');

            // return back()->with('transfer_fund', 'A confirmation code has been sent to you email. Please enter the confimration code by clicking confirm transfer button to complete the transfer');

    }


  }
  public function store_buy_token(Request $request)
  {
    //dd($request->all()); 
     if(Auth::user()->status == 0)
    {
          return back()->with('balance_error', 'You are not eligible!!');
    };
    
    $refer= User::where('id',Auth::id())->first();
    $token= TokenRate::first();
    //dd($token->refer_purchase_commission);
    if($request->wallet_type == 'musd'){
            $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');
    }else{
            $data['sum_deposit']=UsdWallet::where('user_id',Auth::id())->where('status', 'approve')->sum('amount');

    }

    if($data['sum_deposit'] < $request->payable)
    {
        return back()->with('balance_error', 'Insufficent Balance');
    }else {
      $buy_token= new BuyToken;
      $buy_token->user_id=$request->user_id;
      $buy_token->quantity=$request->quantity;
      $buy_token->total_value=$request->total_value;
      $buy_token->payable=$request->payable;
      $buy_token->save();

      $buy = new BonusWallet();
      $buy->user_id= $request->user_id;
    //  $buy->received_from= $request->user_id;
      $buy->amount= $request->quantity;
      $buy->method= 'Token Buy';
      $buy->type= 'Credit';
      $buy->status = 'approved';
      $buy->description= 'Purchase '. $request->qauntity . ' at $'. $request->payable;
      $buy->save();

      $buy_refer = new BonusWallet();
      $buy_refer->user_id= $refer->sponsor;
    //  $buy_refer->received_from= $request->user_id;
      $buy_refer->amount= ($request->quantity)*(($token->refer_purchase_commission)/100);
      $buy_refer->method= 'Referrer Bonus';
      $buy_refer->type= 'Credit';
      $buy_refer->status = 'approved';
      $buy_refer->description= ($request->quantity)*(($token->refer_purchase_commission)/100) .' Refer Bonus from '. $request->user_id . ' for purchasing Token';
      $buy_refer->save();

    if($request->wallet_type == 'musd'){ 
          $buy_deduct= new AddMoney();
          $buy_deduct->user_id= $request->user_id;
          $buy_deduct->amount= -($request->payable);
          $buy_deduct->method= 'Buy Token';
          $buy_deduct->type= 'Debit';
          $buy_deduct->description= '$'.$request->payable .' is deducted For purchasing '. $request->quantity. ' Token';
          $buy_deduct->status= 'approve';
          $buy_deduct->save();
    }else{
        $deduct= new UsdWallet();
      $deduct->user_id = $request->user_id;
      $deduct->amount = -($request->payable);
      //$deduct->method=$method;
      $deduct->method = 'Buy Token';
      $deduct->type = 'Debit';
      $deduct->status = 'approve';
      $deduct->description = '$'.$request->payable .' is deducted For purchasing '. $request->quantity. ' Token';
      $deduct->save();
    }
     
      
      

        return back()->with('token_buy', 'Token Buy Successfully');
    }

  }
  public function store_sell_token(Request $request)
  {
       if(Auth::user()->status == 0)
    {
          return back()->with('token_sell_error', 'You are not eligible!!');
    };
     //dd($request->all());
      //$data['sum_deposit_bonus']=BonusWallet::where('user_id',Auth::id())->sum('amount');
      $data['check_available_mind']=BonusWallet::where('user_id',Auth::id())->where('status','approved')->sum('amount');;

      if($request->quantity < 0){
          return back()->with('token_sell_error', 'Wrong input');
      }

    if($data['check_available_mind'] < $request->quantity){
        return back()->with('token_sell_error', 'Insufficient Mind');
    }else {
      $sell_token= new SellToken;
      $sell_token->user_id=$request->user_id;
      $sell_token->quantity=$request->quantity;
      $sell_token->total_value=$request->total_value;
      $sell_token->payable=$request->payable;
      $sell_token->save();

      $sell_deduct = new BonusWallet();
      $sell_deduct->user_id= $request->user_id;
    //  $sell_deduct->received_from= $request->user_id;
      $sell_deduct->amount= -($request->quantity);
      $sell_deduct->method= 'Token Sell';
      $sell_deduct->type= 'Debit';
      $sell_deduct->status = 'approved';
      $sell_deduct->description= 'Received Cash Amount '. $request->payable . ' for selling '. $request->qauntity;
      $sell_deduct->save();


      $sell= new AddMoney();
      $sell->user_id= $request->user_id;

      $sell->amount= $request->payable;
      $sell->method= 'Sell Token';
      $sell->type= 'Credit';
      $sell->description= $request->payable .' By selling Token ';
      $sell->status= 'approve';
      $sell->save();

        return back()->with('token_sell', 'Token Sell Successfully');
    }

  }
  public function manage_transaction($id)
  {
    $users= User::where('id',Auth::id())->first();
    $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_token']=TokenWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_bonus']=BonusWallet::where('user_id',Auth::id())->where('status','approved')->sum('amount');
    $data['sum_deposit_staking']=StakingWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_deposit_ambassador']=AmbassadorWallet::where('user_id',Auth::id())->where('status','approved')->sum('amount');
    $data['sum_deposit_coupon']=CouponWallet::where('user_id',Auth::id())->sum('amount');
    $data['sum_usd_wallet']=UsdWallet::where('user_id',Auth::id())->sum('amount');

    $cashwallet_history= AddMoney::where('user_id',Auth::id())->orderBy('id','desc')->get();
    $tokenwallet_history= TokenWallet::where('user_id',Auth::id())->orderBy('id','desc')->get();
    $StakingWallet_history= StakingWallet::where('user_id',Auth::id())->orderBy('id','desc')->get();
    $UsdWallet_history = UsdWallet::where('user_id',Auth::id())->orderBy('id','desc')->get();
    $bonuswallet_history= BonusWallet::where('user_id',Auth::id())->where('status','approved')->orderBy('id','desc')->get()->take(600);
    $AmbassadorWallet_history= AmbassadorWallet::where('user_id',Auth::id())->where('status','approved')->orderBy('id','desc')->get();
    $CouponWallet_history= CouponWallet::where('user_id',Auth::id())->orderBy('id','desc')->get();
    return view('user.pages.transactions',compact('users','data','cashwallet_history','tokenwallet_history','bonuswallet_history','CouponWallet_history','StakingWallet_history','AmbassadorWallet_history', 'UsdWallet_history'));
  }
  public function ContactUs($id)
  {
      return view('user.pages.contact_us');
  }
  public function storeContact(Request $request)
   {
      $data=Contactus::insert([
        'name'=>$request->name,
        'email'=>$request->email,
        'user_name'=>$request->user_name,
        'phone'=>$request->phone,
        'message'=>$request->message,
        'created_at'=>Carbon::now(),
      ]);
      Mail::send('email',
      [
        'data'=>$request->message,
        'user_name'=>$request->user_name,
        'email'=>$request->email,
        'name'=>$request->name,
        'phone'=>$request->phone,
      ],function($message)use($request)
      {
        $message->to('support@mindchain.info');
        $message->subject('Contact Us');
      });
      return response()->json($data);
   }
   public function Kyc($id)
   {
     return view('user.pages.kyc_verification');
   }
   public function KycStore(Request $request)
   {
     //dd($request->all());
     
      $validator = Validator::make($request->all(), [
        'file' => ['required', 'max:1024'],
         'file2' => ['required', 'max:1024'],
          'file3' => ['required', 'max:1024'],
    ]);
    if($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }

     if ($request->file('file2') != null) {
       $image2 = $request->file('file2');
       $filename = null;
       if ($image2) {
           $filename2 = time() . $image2->getClientOriginalName();

           Storage::disk('public')->putFileAs(
               'documents/',
               $image2,
               $filename2
           );
       }
     }
     if ($request->file('file3') != null) {
       $image3 = $request->file('file3');
       $filename3 = null;
       if ($image3) {
           $filename3 = time() . $image3->getClientOriginalName();

           Storage::disk('public')->putFileAs(
               'documents/',
               $image3,
               $filename3
           );
       }
     }
     if ($request->file('file') != null) {
       $image = $request->file('file');
       $filename = null;
       if ($image) {
           $filename = time() . $image->getClientOriginalName();

           Storage::disk('public')->putFileAs(
               'documents/',
               $image,
               $filename
           );
       }
     }
      $kyc = new Kyc();
      $kyc->user_id= $request->id;
      if($request->file('file') != null)
      {
        $kyc->image= $filename;
      }
      if($request->file('file2') != null)
      {
          $kyc->image2= $filename2;
      }
      if($request->file('file3') != null)
      {
        $kyc->image3= $filename3;
      }
      $kyc->save();
      return back()->with('document_added', 'Documents Successfully Submitted!!');




   }
   public function KycApprove(Request $request)
   {
        

     $kyc_update= Kyc::find($request->id);
     $kyc_update->status= 'approved';
     $kyc_update->save();
     $user= User::find($kyc_update->user_id);
     $user->kyc=1;
     $user->save();
     //dd($user);
     Mail::send('emails.kycApproved', ['user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('KYC Approved');
             });
             
             
       return back()->with('kyc_approved', 'Documents Successfully Approved!!');
   }
   public function KycVerification()
   {
     //$kycs = Kyc::all();
       return view('admin.pages.kyc_lists');
   }
   public function KycReject($id)
   {

     $kyc_update= Kyc::find($id);
     $kyc_update->status= 'rejected';
     $user= User::find($kyc_update->user_id);
     //dd($user);
     $kyc_update->save();
      Mail::send('emails.kycRejected', ['user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('KYC Rejected');
             });
      return back()->with('kyc_approved', 'Documents Rejected!!');
   }
   
   public function Coin_bonus_transfer_Confirm(Request $request)
   {
         if(Auth::user()->status == 0)
    {
          return back()->with('transfer_error', 'You are not eligible!!');
    };
       $data['sum_deposit']=BonusWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approved', 'pending'])
                               ->sum('amount');
       //dd($request->all());
      $transfer= BonusWallet::find($request->id);
      
      if($data['sum_deposit'] < $transfer->amount)
        {
            return back()->with('transfer_error', 'Insufficent Balance');
        }
        
      if ($request->confirmation_code == $transfer->confirmation_code) {
        $transfer->status = 'approved';
        $transfer->save();
         $sender_name= User::where('id',$request->user_id)->first();
            $transfer_up= new BonusWallet();
            $transfer_up->user_id= $transfer->receiver_id;
            $transfer_up->received_from= $request->user_id;
            $transfer_up->amount= -($transfer->amount);
            $transfer_up->method= 'Transfer Money';
            $transfer_up->type= 'Debit';
            $transfer_up->description= -($transfer->amount) .' Transfer amount from '. $sender_name->user_name;
            $transfer_up->status= 'approved';
            $transfer_up->save();
            
            // return response()->json([
            //   'status' => 'success',
            //   'message' => 'Transfer successful'
            // ]);

            return back()->with('transfer_fund', 'Coin Transfer Successful');
      }else
      {
        //   return response()->json([
        //               'status' => '401',
        //               'error' => 'Failed, You entered wrong code'
        //           ]);
        return back()->with('transfer_error', 'You entered wrong code');
      }
   }
   
   public function usdt_transfer_Confirm(Request $request)
   {
       
       //dd($request->all());
      $transfer= UsdWallet::find($request->id);
      if ($request->confirmation_code == $transfer->confirmation_code) {
        $transfer->status = 'approve';
        $transfer->save();
         $sender_name= User::where('id',$request->user_id)->first();
            $transfer_up= new UsdWallet();
            $transfer_up->user_id= $transfer->receiver_id;
            $transfer_up->received_from= $request->user_id;
            $transfer_up->amount= -($transfer->amount);
            $transfer_up->method= 'Transfer Money';
            $transfer_up->type= 'Debit';
            $transfer_up->description= -($transfer->amount) .' Transfer amount from '. $sender_name->user_name;
            $transfer_up->status= 'approve';
            $transfer_up->save();
            
            // return response()->json([
            //   'status' => 'success',
            //   'message' => 'Transfer successful'
            // ]);

            return back()->with('transfer_fund', 'Usd Transfer Successful');
      }else
      {
        //   return response()->json([
        //               'status' => '401',
        //               'error' => 'Failed, You entered wrong code'
        //           ]);
        return back()->with('transfer_error', 'You entered wrong code');
      }
   }
    
    public function TransferFundConfirm(Request $request)
   {
    
    $transfer= AddMoney::find($request->id);
     $data['sum_deposit']=AddMoney::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');

    if($data['sum_deposit'] < $request->amount)
    {
        return back()->with('transfer_error', 'Insufficent Balance');
    }
    
    //dd($transfer);
      if ($request->confirmation_code == $transfer->confirmation_code) {
        $transfer->status = 'approve';
        $transfer->save();

         $sender_name= User::where('id',$request->user_id)->first();
            $transfer_up= new AddMoney();
            $transfer_up->user_id= $transfer->receiver_id;
            $transfer_up->received_from= $request->user_id;
            $transfer_up->amount= -($transfer->amount);
            $transfer_up->method= 'Transfer Money';
            $transfer_up->type= 'Credit';
            $transfer_up->description= -($transfer->amount) .' Transfer amount from '. $sender_name->user_name;
            $transfer_up->status= 'approve';
            $transfer_up->save();
            
            $request->session()->put('form_submitted', true);

          //   return response()->json([
          //     'status' => 'success',
          //     'message' => 'Transfer successful'
          // ]);

            return back()->with('transfer_fund', 'Fund Transfer Successfully');
      }else
      {
        return back()->with('transfer_error', 'You entered wrong code');
          return response()->json([
                      'status' => '401',
                      'error' => 'Failed, You entered wrong code'
                  ]);
      }
   }
   
   public function AffiliateBonus($id)
   {
       $bonus= BonusWallet::where('method','Affiliate Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Affiliate Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.affilate_bonus_history',compact('bonus','total_credit'));
   }
   public function ReffererBonus($id)
   {
       $bonus= BonusWallet::where('method','Daily Seller Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Daily Seller Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.refferer_bonus_history',compact('bonus','total_credit'));
   }
    public function DailyBonus($id)
   {
       $bonus= BonusWallet::where('method','Daily Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Daily Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.daily_bonus_history',compact('bonus','total_credit'));
   }
   
     public function UsdStakingBonus($id)
   {
       $bonus= usdWallet::where('method','Daily USD Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
        $total_credit= usdWallet::where('method','Daily USD Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.usd_staking_bonus_history',compact('bonus','total_credit'));
   }
   
    public function eliteSponsorBonus($id)
   {
    
    $bonus= usdWallet::where('method','Daily USD Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();

        $total_credit= usdWallet::where('method','Deposit')->where('user_id',Auth::id())->orderBy('id','desc');
       return view('user.pages.elite_sponsor_bonus_history',compact('bonus','total_credit'));
   }
   
   public function eliteDepositHistory($id)
   {
       $bonus= usdWallet::where('method','deposit')->where('user_id',Auth::id())->orderBy('id','desc')->get();

        $total_credit= usdWallet::where('method','Daily USD Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
        $data['sum_usd_wallet']=UsdWallet::where('user_id',Auth::id())->where('status', 'approve')->sum('amount');

       return view('user.pages.elite_deposit_history',compact('data','bonus','total_credit'));
   }
    
     public function StakingBonus($id)
   {
       $bonus= BonusWallet::where('method','Daily Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
        $total_credit= BonusWallet::where('method','Daily Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.staking_bonus_history',compact('bonus','total_credit'));
   }
   
    public function LevelBonus($id)
   {
       $bonus= BonusWallet::where('method','Level Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Level Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.level_bonus_history',compact('bonus','total_credit'));
   }
   
    public function TokenSettlement($id)
   {
       $bonus= BonusWallet::where('method','Token Settlement')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Token Settlement')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
      // dd($bonus,$total_credit );
       return view('user.pages.token_settlement_bonus_history',compact('bonus','total_credit'));
   }
      public function TransferHistory($id)
   {
       $bonus= BonusWallet::where('method','Transfer Money')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Transfer Money')->where('status','approved')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.transfer_history',compact('bonus','total_credit'));
   }
   
     public function WithdrawHistory($id)
   {
       $bonus= BonusWallet::where('method','Withdraw')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('method','Withdraw')->where('status','approved')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.withdraw_history',compact('bonus','total_credit'));
   }
    public function OtherHistory($id)
   {
       $bonus= BonusWallet::where('method','!=','Withdraw')
       ->where('method','!=','Transfer Money')
       ->where('method','!=','Level Bonus')
       ->where('method','!=','Daily Staking Bonus')
       ->where('method','!=','Daily Bonus')
       ->where('method','!=','Daily Seller Bonus')
       ->where('method','!=','Affiliate Bonus')
       ->where('method','!=','Token Settlement')
       //->where('method','!=','Daily Seller Bonus')
       
       
       ->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= BonusWallet::where('status','approved')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.other_history',compact('bonus','total_credit'));
   }

   public function all_kyc_lists(Request $request)
   {
        if($request->ajax()){
            $data = Kyc::orderBy('id', 'desc')->get();
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('user_name', function($row) {
                return $row->user->user_name;
            })
            ->editColumn('user_email', function($row) {
                return $row->user->email;
            })
            ->addColumn('action',function($row){
                $html = view('admin.modals.kyc', compact('row'))->render();
                return $html;
            })
            ->rawColumns(['action','user_name', 'user_email'])
            ->make(true);
        }
    }
    
     public function bmindStages($id)
      {
    
        $data['user'] = User::where('id', Auth::id())->first();;
        $data['deposit'] = AddMoney::where('user_id', Auth::id())->first();
        $data['sum_usdwallet']=UsdWallet::where('user_id',Auth::id())->where('status', 'approve')->sum('amount');
        $data['bmindstages'] = BaseMind::with('communityTokenPackageSettings')->get();
        $data['bmind_already_sell'] = PurcahseCommunityToken::get()->sum('token_amount');

        return view('user.pages.bmind.bmindStages', compact('data'));
      }
  
    public function bmindDailyBonusUpdate(Request $request)
      {
    //dd($request->all());
        $selectedAmount = $request->input('selectedAmount');
        $stage_name = $request->input('stage_name');
        //dd($stage_name);
        $bmindId = BaseMind::where('title', $stage_name)->first();

        $dailyBonus = CommunityTokenPackageSettings::where('base_mind_id', $bmindId->id)->where('amount', $selectedAmount)->with('basemind')->first();
        // Return the updated daily bonus as a JSON response
        //dd($dailyBonus);
        return response()->json([
            'dailyBonus' => $dailyBonus->daily_bonus
            ]);

      }
  
  public function store_bmind(Request $request)
  {
    
    if(Auth::user()->status == 0)
    {
          return back()->with('purchase_error', 'You are not eligible!!');
    };
      //dd($request->all());
    $data['sum_usdwallet']=UsdWallet::where('user_id', Auth::id())
                               ->whereIn('status', ['awaiting', 'approve', 'pending'])
                               ->sum('amount');

      $user=User::where('id',$request->user_id)->first();
      $stage_package= CommunityTokenPackageSettings::where('base_mind_id', $request->bmind_id)->where('amount', $request->selected_amount)->with('basemind')->first();

        $stageId = basemind::where('id', $stage_package->basemind->id); 
        $stageId->increment('total_token_sell', $request->selected_amount);


    $SelectedTokenprice = $stage_package->basemind->token_base_price * $request->selected_amount; 

     
        //dd($SelectedTokenprice,$data['sum_deposit'] );

    if($data['sum_usdwallet'] < $SelectedTokenprice)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    }else{
            
      //dd($sponsor->sponsor);
      //dd($package_id);
      
      $bmindstake= new bmind_staking_wallets();
      $bmindstake->user_id= $request->user_id;
      $bmindstake->amount = $request->selected_amount;
      $bmindstake->method = 'Bmind staking'; 
      $bmindstake->type = 'Debit';
      $bmindstake->status = 'Approved';
      $bmindstake->description = $request->selected_amount . ' ' . 'Bmind token stake. Package- ' . $stage_package->basemind->title; 
      $bmindstake->save();
      
      $purchase= new PurcahseCommunityToken();
      $purchase->token_name= 'bmind';
      $purchase->stage_id= $request->bmind_id;
      $purchase->user_id= $request->user_id;
      $purchase->token_amount = $request->selected_amount;
      $purchase->token_base_price = $stage_package->basemind->token_base_price; 
      $purchase->bonus_duration = $stage_package->basemind->duration; 
      $purchase->total_price = $SelectedTokenprice; 
      $purchase->daily_bonus = $stage_package->daily_bonus; 
      $purchase->stake_refund_status = 0; 
      $purchase->save();

      $deduct= new UsdWallet();
      $deduct->user_id = $request->user_id;
      $deduct->amount = -($SelectedTokenprice);
      //$deduct->method=$method;
      $deduct->method = 'Purchased Bmind Stage';
      $deduct->type = 'Debit';
      $deduct->status = 'approve';
      $deduct->description = 'Purchased Bmind Stage ' . $stage_package->basemind->title . ' for $' . $SelectedTokenprice;
      $deduct->save();
     
     //dd('done');
      
    
        $user = User::where('id', $request->user_id)->first();

      $bonus = new UsdWallet();
      $bonus->user_id= $user->sponsor;
      $bonus->received_from= $request->user_id;
      $bonus->amount=  ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->sponsor_bonus)/100);
      $bonus->method= 'Bmind Sponsor Bonus';
      $bonus->type= 'Credit';
      $bonus->status = 'approve';
      $bonus->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->sponsor_bonus)/100) . ' USDT ' . 'Affiliate Bonus from'. ' ' . Auth::user()->user_name;
      $bonus->save();
      //dd($bonus);

      //Level-1 Bonus
       $lvl_1= User::where('id',$user->sponsor)->first();
                if($lvl_1->id != 1 && $stage_package->basemind->lvl1_bonus > 0){
                $bonus_amount = new UsdWallet();
                $bonus_amount->user_id = $lvl_1->id;
                $bonus_amount->received_from = $lvl_1->id;
                $bonus_amount->amount = ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl1_bonus)/100);
                $bonus_amount->method = 'Bmind Level Bonus';
                $bonus_amount->type = 'Credit';
                $bonus_amount->status = 'approve';
                $bonus_amount->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl1_bonus)/100) .' USDT'. ' Level 1 Bonus Credited from '. Auth::user()->user_name;
                $bonus_amount->save();
                
                //Level 2 Bonus
          $lvl_2= User::where('id',$lvl_1->sponsor)->first();
         if($lvl_2){
        if($lvl_2->id != 1 && $stage_package->basemind->lvl2_bonus > 0){
            $bonus_amount = new UsdWallet();
            $bonus_amount->user_id = $lvl_2->id;
            $bonus_amount->received_from = $request->user_id;
            $bonus_amount->amount = ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl2_bonus)/100);
            $bonus_amount->method = 'Bmind Level Bonus';
            $bonus_amount->type = 'Credit';
            $bonus_amount->status = 'approve';
            $bonus_amount->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl2_bonus)/100) .' USDT'. ' Level 2 Bonus Credited from '. Auth::user()->user_name;
            $bonus_amount->save();
            
              //Level 3 Bonus
        $lvl_3= User::where('id',$lvl_2->sponsor)->first();
        
        if($lvl_3){                 
        if($lvl_3->id != 1 && $stage_package->basemind->lvl3_bonus > 0){
        $bonus_amount = new UsdWallet();
        $bonus_amount->user_id = $lvl_3->id;
        $bonus_amount->received_from = $request->user_id;
        $bonus_amount->amount = ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl3_bonus)/100);
        $bonus_amount->method = 'Bmind Level Bonus';
        $bonus_amount->type = 'Credit';
        $bonus_amount->status = 'approve';
        $bonus_amount->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl3_bonus)/100) .' USDT'. ' Level 3 Bonus Credited from '. Auth::user()->user_name;
        $bonus_amount->save();
        
          //Level 4 Bonus
        $lvl_4= User::where('id',$lvl_3->sponsor)->first();
        if($lvl_4){
         if($lvl_4->id != 1 && $stage_package->basemind->lvl4_bonus > 0){
            $bonus_amount = new UsdWallet();
            $bonus_amount->user_id = $lvl_4->id;
            $bonus_amount->received_from = $request->user_id;
            $bonus_amount->amount = ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl4_bonus)/100);
            $bonus_amount->method = 'Bmind Level Bonus';
            $bonus_amount->type = 'Credit';
            $bonus_amount->status = 'approve';
            $bonus_amount->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl4_bonus)/100) .' USDT'. ' Level 4 Bonus Credited from '. Auth::user()->user_name;
            $bonus_amount->save();
            
               //Level 5 Bonus
        $lvl_5= User::where('id',$lvl_4->sponsor)->first();
        if($lvl_5){
        if($lvl_5->id != 1 && $stage_package->basemind->lvl5_bonus > 0){
            $bonus_amount = new UsdWallet();
            $bonus_amount->user_id = $lvl_5->id;
            $bonus_amount->received_from = $request->user_id;
            $bonus_amount->amount = ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl5_bonus)/100);
            $bonus_amount->method = 'Bmind Level Bonus';
            $bonus_amount->type = 'Credit';
            $bonus_amount->status = 'approve';
            $bonus_amount->description= ((($request->selected_amount * $stage_package->basemind->token_base_price) * $stage_package->basemind->lvl5_bonus)/100) .' USDT'. ' Level 5 Bonus Credited from '. Auth::user()->user_name;
            $bonus_amount->save();
        }}
         }}
        }}
        }}
                }
          
          
        
        
        
        
        
        
        
         
         

      return back()->with('package_purchase', 'Bmind Stage Successfully Purchased!!');
    }


  }
  
  public function bmind_staking_history($id)
  {
    $purchase= PurcahseCommunityToken::where('user_id',Auth::id())->get();
    //dd($purchase);
    return view('user.pages.bmind.bmind_stake_history',compact('purchase'));
  }
  
   public function bmindSponsorBonus($id)
   {
    
    $bonus= usdWallet::where('method','Bmind Sponsor Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();

        $total_credit= usdWallet::where('method','Deposit')->where('user_id',Auth::id())->orderBy('id','desc');
       return view('user.pages.bmind.bmind_sponsor_bonus_history',compact('bonus','total_credit'));
   }
   
   public function BmindStakingBonus($id)
   {
       $bonus= BmindWallet::where('method','Daily Bmind Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
        $total_credit= BmindWallet::where('method','Daily BMIND Staking Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.bmind.bmind_staking_bonus_history',compact('bonus','total_credit'));
   }
   
   public function bmindLevelBonus($id)
   {
       $bonus= usdWallet::where('method','Bmind Level Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->get();
       $total_credit= usdWallet::where('method','Bmind Level Bonus')->where('user_id',Auth::id())->orderBy('id','desc')->sum('amount');
       return view('user.pages.bmind.bmind_level_bonus_history',compact('bonus','total_credit'));
   }
   
  public function wallet1()
  {
        
    //   return view('user.pages.withdraw', compact('data'));
    return view('user.pages.wallet1');

  }
  
  public function bmindteaminvest(){
      $users = User::all();
        //$users = User::where('id', 138)->get();
 
 
        foreach ($users as $user) {
            $teamInvestment = $this->calculateTeamInvestment($user);
            //dd($teamInvestment); 
            $user->update(['team_invest' => $teamInvestment]);
        }

        return('Team investments updated successfully!');
   
    }
    
     private function calculateTeamInvestment($user, $depth = 0, $maxDepth = 10)
    {
        // Get direct referrals
        $directReferrals = $user->referrals;

        // Initialize total investment for the current user
        $totalInvestment = PurcahseCommunityToken::where('user_id', $user->id)->sum('token_amount');
        //$user->update(['investment' => $totalInvestment]);

        // Recursive calculation for indirect referrals
        if ($depth < $maxDepth && $directReferrals->count() > 0) {
            foreach ($directReferrals as $directReferral) {
                $totalInvestment += $this->calculateTeamInvestment($directReferral, $depth + 1, $maxDepth);
            }
        }

        return $totalInvestment;
    }
}
