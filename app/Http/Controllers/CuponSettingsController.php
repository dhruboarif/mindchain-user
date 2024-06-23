<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuponSetting;
use App\Models\User;
use App\Models\AddMoney;
use App\Models\CouponWallet;
use App\Models\MerchantSetting;
use Auth;

class CuponSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CuponSetting::orderBy('id', 'desc')->paginate(16);
        return view ('admin.pages.cupon_settings', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png',
            'amount' => 'required|integer'
        ]);
        //$imagePath = $request->file('file')->store('cupon');
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        
        // Upload the file to the public directory
        $file->storeAs('public', $fileName);
        $data = new CuponSetting();
        $data->image = $fileName; // Save the image path or filename in the 'image' column
        $data->amount = $request->amount;
        if($data->save()) {
            return redirect()->back()->with('insert_success', 'Coupon inserted successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function user_cupon_index()
    {
        $data = CuponSetting::where('status', '1')->get();
        return view ('user.pages.redeem_cupon', compact('data'));
    }
    
    public function user_cupon_redeem($id)
    {
        $data = CuponSetting::findOrfail($id);
          // dd($request);
      $data['sum_deposit']=AddMoney::where('user_id',Auth::id())->where('status','approve')->sum('amount');
    //dd($data['sum_deposit_token']);
    if($data['sum_deposit'] < $data->amount)
    {
        return back()->with('purchase_error', 'Insufficent Balance');
    };
       $user= User::where('id',Auth::id())->first();
   // $sponsor= User::where('id',$user->sponsor)->first();
    $deduct= new AddMoney();
    $deduct->user_id = Auth::id();
    $deduct->amount = -($data->amount);


    $deduct->method = 'Reedeem Coupon ';
    $deduct->type = 'Debit';
    $deduct->status= 'approve';

    $deduct->description = 'Charge deducted for redeem coupon ' . ' $ ' . $data->amount;
    $deduct->save();
    $setting= MerchantSetting::first();
    $add_money= new CouponWallet();
    $add_money->user_id = Auth::id();
    $add_money->amount = ($data->amount)+ ($data->amount * $setting->bonus /100);
    
    $add_money->method = 'Coupon wallet deposit ';
    $add_money->type = 'Debit';

    $add_money->description = 'Added' . '$' . ($data->amount)+ ($data->amount * $setting->bonus /100). ' to Coupon Wallet by reedeming coupon';
    $add_money->save();
    
     return back()->with('insert_success', 'Coupon reedeemed successfully!!');
        
    }
}
