<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BonusWallet;
use App\Models\TokenWallet;
use App\Models\User;
use App\Models\StakingSetting;
use App\Models\PurchaseStake;
use Carbon\Carbon;
use DateTime;
use App\Models\StakingWallet;
use function Sodium\add;
use Auth;
use App\Models\AmbassadorWallet;

class DailyStaking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staking:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Staking Bonus';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $purchases= PurchaseStake::all();
//$purchases= PurchaseStake::where('user_id', 2354)->get();
//dd($purchases);


      foreach ($purchases as $row) {

              $date1 = new DateTime($row['created_at']);
              $date2 = new DateTime(Carbon::now()->addDay(1));
              $days  = $date2->diff($date1)->format('%a');

              if ($days <= $row->days){
                  $bonus= new BonusWallet();
                  $bonus->user_id= $row->user_id;
                  $bonus->amount= $row->daily;
                  $bonus->method= 'Daily Staking Bonus';
                  $bonus->type= 'Credit';
                  $bonus->status = 'approved';
                  $bonus->description= $row->daily . ' MIND Token ' . 'Daily Bonus for purchasing '. 'Staking Package' ;
                  $bonus->save();
                  
                  $usr= User::where('id',$row->user_id)->first();
                  $sponsor= User::where('id',$usr->sponsor)->first();
                  $staking= StakingSetting::first();
                  $bonus= new BonusWallet();
                  $bonus->user_id= $sponsor->id;
                  $bonus->received_from= $row->user_id;
//dd($row->daily * ($staking->seller_bonus/100));

                  $bonus->amount= $row->daily * ($staking->seller_bonus/100);
                  $bonus->method= 'Daily Seller Bonus';
                  $bonus->type= 'Credit';
                  $bonus->status = 'approved';
                  $bonus->description= $row->daily * ($staking->seller_bonus/100) . ' MIND Token ' . 'Daily Seller Bonus from '. $usr->user_name ;
                  $bonus->save();
  }
  else
        {
            
            if($row->status == 0)
            {
                    $ambassador= User::where('id',$row->user_id)->first();
                    if($ambassador->ambassador == 1)
                    
                    {
                    $bonus= new AmbassadorWallet();
                    $bonus->user_id= $row->user_id;

                    $bonus->amount= ($row->amount);
                    $bonus->method= 'Token Settlement';
                    $bonus->type= 'Credit';
                    $bonus->status = 'approved';
                    $bonus->description= $row->amount. ' MIND Token ' . 'settlement bonus for staking';
                    $bonus->save(); 
                    }else {
                        
                    $bonus= new BonusWallet();
                    $bonus->user_id= $row->user_id;

                    $bonus->amount= ($row->amount);
                    $bonus->method= 'Token Settlement';
                    $bonus->type= 'Credit';
                    $bonus->status = 'approved';
                    $bonus->description= $row->amount. ' MIND Token ' . 'settlement bonus for staking';
                    $bonus->save(); 
                    }
                    
                    $bonus_token= new StakingWallet();
                    $bonus_token->user_id= $row->user_id;

                    $bonus_token->amount= -($row->amount);
                    $bonus_token->method= 'Token Settlement Adjustment';
                    $bonus_token->type= 'Debit';
                    //$bonus_token->status = 'approved';
                    $bonus_token->description= $row->amount. ' MIND Token ' . 'settlement adjustment in Mind wallet for staking ';
                    $bonus_token->save();  
                    
                    $purchase_update= PurchaseStake::where('id',$row->id)->first();
                    $purchase_up= PurchaseStake::find($purchase_update->id);
                    $purchase_up->status= 1;
                    $purchase_up->save();
                    
            }
        }
        $this->info('Successfully added daily bonus.');
        
        
    }
}
}
