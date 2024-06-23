<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TokenRate;
use App\Models\Ambassador;
use App\Models\TransferInfo;
use App\Models\WithdrawCommission;
use App\Models\Company;
use App\Models\TokenS;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\GeneralException;
use App\Models\PackageSettings;
use App\Models\LevelSetting;
use App\Models\StakingSetting;
class SettingsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $token_rate=TokenRate::first();
    $ambassaor= Ambassador::first();
    $transfer_info= TransferInfo::first();
    $withdraw_info= WithdrawCommission::first();
    $company= Company::first();
    $tokens= TokenS::first();
    $level= LevelSetting::first();

    return view('admin.pages.general_settings',compact('token_rate','ambassaor','transfer_info','withdraw_info','company','tokens','level'));
  }
  public function token_rate_update(Request $request)
  {
    $token =TokenRate::find($request->id);
    $token->token_convert_rate=$request->token_convert_rate;
    $token->buying_commission= $request->buying_commission;
    $token->selling_commission= $request->selling_commission;
    $token->buy_limit_max= $request->buy_limit_max;
    $token->buy_limit_min= $request->buy_limit_min;
    $token->sell_limit_max= $request->sell_limit_max;
    $token->sell_limit_min=$request->sell_limit_min;
    $token->refer_purchase_commission=$request->refer_purchase_commission;
    $token->save();
    $packages= PackageSettings::all();
    foreach ($packages as $package)
     {
      $token= TokenRate::first();
      $package_amount= PackageSettings::where('amount',$package->amount)->first();
      //dd($package_amount->amount);
      $new_price= PackageSettings::find($package->id);
      $new_price->package_price= ($package_amount->amount)* ($token->token_convert_rate);
      $new_price->save();

      }
      return back()->with('token_rate_updated', 'Token Rate Successfully Updated!!');
  }
  public function ambassador_update(Request $request)
  {
    $ambassador =Ambassador::find($request->id);
    $ambassador->auser_qty=$request->auser_qty;
    $ambassador->refer_token_value= $request->refer_token_value;
    $ambassador->owner_token_value= $request->owner_token_value;
    $ambassador->token_bonus= $request->token_bonus;
    $ambassador->cash_bonus= $request->cash_bonus;
    $ambassador->duration= $request->duration;
    $ambassador->status=$request->status;
    $ambassador->save();
      return back()->with('ambassador_updated', 'Ambassador Successfully Updated!!');
  }
  public function token_update(Request $request)
  {
    $tokens =TokenS::find($request->id);
    $tokens->token_name=$request->token_name;
    $tokens->token_symbol= $request->token_symbol;
    $tokens->total_supply= $request->total_supply;
    $tokens->blockchain= $request->blockchain;

    $tokens->save();
      return back()->with('tokens_updated', 'Token Settings Successfully Updated!!');
  }
  public function level_update(Request $request)
  {
    $level= LevelSetting::find($request->id);
    $level->lvl_1= $request->lvl_1;
    $level->lvl_2= $request->lvl_2;
    $level->lvl_3= $request->lvl_3;
    $level->lvl_4= $request->lvl_4;
    $level->lvl_5= $request->lvl_5;
    $level->status= $request->status;
    $level->save();
      return back()->with('level_updated', 'Level Settings Successfully Updated!!');
  }
  public function staking_update(Request $request)
  {
    $staking= StakingSetting::find($request->id);
    $staking->min_staking= $request->min_staking;
    $staking->max_staking= $request->max_staking;
    $staking->days_90= $request->days_90;
    $staking->days_180= $request->days_180;
    $staking->days_365= $request->days_365;
    $staking->days_730= $request->days_730;
    $staking->days_90_af= $request->days_90_af;
    $staking->days_180_af= $request->days_180_af;
    $staking->days_365_af= $request->days_365_af;
    $staking->days_730_af= $request->days_730_af;
    $staking->seller_bonus= $request->seller_bonus;
    $staking->status= $request->status;
    $staking->save();
      return back()->with('level_updated', 'Staking Settings Successfully Updated!!');
  }
  public function transfer_info_update(Request $request)
  {
    $transfer_info =TransferInfo::find($request->id);
    $transfer_info->transfer_commission=$request->transfer_commission;
    $transfer_info->transfer_limit_max= $request->transfer_limit_max;
    $transfer_info->transfer_limit_min= $request->transfer_limit_min;

    $transfer_info->save();
      return back()->with('transfer_updated', 'Transfer Info Successfully Updated!!');
  }
  public function withdraw_info_update(Request $request)
  {
    $withdraw_info =WithdrawCommission::find($request->id);
    $withdraw_info->withdraw_commission=$request->withdraw_commission;
    $withdraw_info->withdraw_limit_max= $request->withdraw_limit_max;
    $withdraw_info->withdraw_limit_min= $request->withdraw_limit_min;
    $withdraw_info->monthly_withdraw_coin_limit= $request->monthly_withdraw_coin_limit;
    $withdraw_info->min_token_withdraw= $request->min_token_withdraw;
    $withdraw_info->max_token_withdraw= $request->max_token_withdraw;

    $withdraw_info->save();
      return back()->with('withdraw_updated', 'Withdraw Info Successfully Updated!!');
  }
  public function company_update(Request $request)
  {


    $filename=null;
    $uploadedFile = $request->file('image1');
    $oldfilename = $company['company_image'] ?? 'demo.jpg';

    $oldfileexists = Storage::disk('public')->exists('Company/' . $oldfilename);

    if ($uploadedFile !== null) {

        if ($oldfileexists && $oldfilename != $uploadedFile) {
            //Delete old file
            Storage::disk('public')->delete('Company/' . $oldfilename);
        }
        $filename_modified = str_replace(' ', '_', $uploadedFile->getClientOriginalName());
        $filename = time() . '_' . $filename_modified;

        Storage::disk('public')->putFileAs(
            'Company/',
            $uploadedFile,
            $filename
        );

        $data['image1'] = $filename;
    } elseif (empty($oldfileexists)) {
        throw new GeneralException('Company image not found!');
        //return redirect()->back()->with(['flash_danger' => 'User image not found!']);
        //file check in storage

    }
    $filename2=null;
    $uploadedFile2 = $request->file('image2');
    $oldfilename2 = $company['company_icon'] ?? 'demo.jpg';

    $oldfileexists2 = Storage::disk('public')->exists('Company/' . $oldfilename2);

    if ($uploadedFile2 !== null) {

        if ($oldfileexists2 && $oldfilename2 != $uploadedFile2) {
            //Delete old file
            Storage::disk('public')->delete('Company/' . $oldfilename2);
        }
        $filename_modified2 = str_replace(' ', '_', $uploadedFile2->getClientOriginalName());
        $filename2 = time() . '_' . $filename_modified2;

        Storage::disk('public')->putFileAs(
            'Company/',
            $uploadedFile2,
            $filename2
        );

        $data['image2'] = $filename2;
    } elseif (empty($oldfileexists2)) {
        throw new GeneralException('Company icon not found!');
        //return redirect()->back()->with(['flash_danger' => 'User image not found!']);
        //file check in storage

    }

    $company =Company::find($request->id);
    $company->company_name=$request->company_name;
    $company->company_image= $filename;
    $company->company_icon= $filename2;

    $company->save();
      return back()->with('company_updated', 'Company Info Successfully Updated!!');
  }

}
