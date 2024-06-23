<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BonusWallet;
use App\Models\AddMoney;
use App\Models\User;
use App\Models\MusdStakingSetting;
use App\Models\PurchaseMusd;
use App\Models\LevelSetting;
use Carbon\Carbon;
use DateTime;
use App\Models\MusdWallet;
use function Sodium\add;
use Auth;
use App\Models\AmbassadorWallet;
class DailyMusd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'musd:daily';

    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Daily MUSD';
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
        $purchases= PurchaseMusd::all();



      foreach ($purchases as $row) {

              $date1 = new DateTime($row['created_at']);
              $date2 = new DateTime(Carbon::now()->addDay(1));
              $days  = $date2->diff($date1)->format('%a');
            
            echo $row->user_id . '<br/>'; 

              if ($days <= $row->days){


                  $bonus= new AddMoney();
                  $bonus->user_id= $row->user_id;

                  $bonus->amount= $row->daily;
                  $bonus->method= 'Daily Staking Bonus';
                  $bonus->type= 'Credit';
                  $bonus->status = 'approve';
                  $bonus->description= $row->daily . ' $ ' . 'Daily Bonus for purchasing '. 'Staking Package' ;
                  $bonus->save();
                  $usr= User::where('id',$row->user_id)->first();
                  $sponsor= User::where('id',$usr->sponsor)->first();
                  $staking= MusdStakingSetting::first();
                //  $bonus= new AddMoney();
               //   $bonus->user_id= $sponsor->id;
               //   $bonus->received_from= $row->user_id;

                //  $bonus->amount= $row->daily * ($staking->seller_bonus/100);
                //  $bonus->method= 'Daily Seller Bonus';
                 // $bonus->type= 'Credit';
                 // $bonus->status = 'approve';
                 // $bonus->description= $row->daily * ($staking->seller_bonus/100) . ' $ ' . 'Daily Seller Bonus from '. $usr->user_name ;
               //   $bonus->save();
                 $g_set = LevelSetting::first();
         
             $received_user= User::where('id',$row->user_id)->first();
                $lvl_1=User::where('id',$row->user_id)->first();
                //dd($lvl_1->placement_id);
                $lvl_1_placement= User::where('id',$lvl_1->sponsor)->first();


                //dd($lvl_1_placement);
               

                                $bonus_amount_l = new AddMoney();
                                $bonus_amount_l->user_id = $lvl_1_placement->id;
                                $bonus_amount_l->received_from = $lvl_1->id;
                                $bonus_amount_l->amount = $row->daily * ($staking->seller_level_1/100);
                                $bonus_amount_l->method = 'Level Bonus';
                                $bonus_amount_l->type = 'Credit';
                                $bonus_amount_l->status = 'approve';

                                $bonus_amount_l->description= ($row->daily  * ($staking->seller_level_1/100)).' $'. ' Level 1 Bonus Credited from '. $received_user->user_name;

                                $bonus_amount_l->save();
                
                                    $lvl_2= User::where('id',$lvl_1_placement->sponsor)->first();
                                    //dd($lvl_2);
                                                    if($lvl_2){
                                                        $bonus_amount_l = new AddMoney();
                                                        $bonus_amount_l->user_id = $lvl_2->id;
                                                        $bonus_amount_l->received_from = $row->user_id;
                                                        $bonus_amount_l->amount = $row->daily * ($staking->seller_level_2/100);
                                                        $bonus_amount_l->method = 'Level Bonus';
                                                        $bonus_amount_l->type = 'Credit';
                                                        $bonus_amount_l->status = 'approve';
                                                        $bonus_amount_l->description= ($row->daily  * ($staking->seller_level_2/100)).' $'. ' Level 2 Bonus Credited from '. $received_user->user_name;
                        
                                                        $bonus_amount_l->save();
                                                        
                                                        $lvl_3= User::where('id',$lvl_2->id)->first();
                                                        $lvl_3_placement= User::where('id',$lvl_3->sponsor)->first();
                                   // dd($lvl_3_placement);
                                    if($lvl_3_placement){
                                                    $bonus_amount_l = new AddMoney();
                                                    $bonus_amount_l->user_id = $lvl_3_placement->id;
                                                    $bonus_amount_l->received_from = $row->user_id;
                                                    $bonus_amount_l->amount = $row->daily * ($staking->seller_level_3/100);
                                                    $bonus_amount_l->method = 'Level Bonus';
                                                    $bonus_amount_l->type = 'Credit';
                                                    $bonus_amount_l->status = 'approve';
                                                    $bonus_amount_l->description= ($row->daily  * ($staking->seller_level_3/100)).' $'. ' Level 3 Bonus Credited from '. $received_user->user_name;
                                                    $bonus_amount_l->save();
                                                    
                                        $lvl_4= User::where('id',$lvl_3_placement->id)->first();
                                        $lvl_4_placement= User::where('id',$lvl_4->sponsor)->first();
                                     
                                        if($lvl_4_placement){
                                             $bonus_amount_l = new AddMoney();
                                                        $bonus_amount_l->user_id = $lvl_4_placement->id;
                                                        $bonus_amount_l->received_from = $row->user_id;
                                                        $bonus_amount_l->amount = $row->daily * ($staking->seller_level_4/100);
                                                        $bonus_amount_l->method = 'Level Bonus';
                                                        $bonus_amount_l->type = 'Credit';
                                                        $bonus_amount_l->status = 'approve';
                                                        $bonus_amount_l->description= ($row->daily  * ($staking->seller_level_4/100)).' $'. ' Level 4 Bonus Credited from '. $received_user->user_name;
                                                        $bonus_amount_l->save();
                                                        
                                            $lvl_5= User::where('id',$lvl_4_placement->id)->first();
                                             $lvl_5_placement= User::where('id',$lvl_5->sponsor)->first();
                                             if($lvl_5_placement){
                                                            $bonus_amount_l = new AddMoney();
                                                            $bonus_amount_l->user_id = $lvl_5_placement->id;
                                                            $bonus_amount_l->received_from = $row->user_id;
                                                            $bonus_amount_l->amount = $row->daily * ($staking->seller_level_5/100);
                                                            $bonus_amount_l->method = 'Level Bonus';
                                                            $bonus_amount_l->status = 'approve';
                                                            $bonus_amount_l->type = 'Credit';
                                                            $bonus_amount_l->description= ($row->daily  * ($staking->seller_level_5/100)).' $'. ' Level 5 Bonus Credited from '. $received_user->user_name;
                            
                                                            $bonus_amount_l->save();
                                             }
                                        }
                                    }
                                }
                 
  }
  else
        {
            
            if($row->status == 0)
            {
                    
                        
                    $bonus= new AddMoney();
                    $bonus->user_id= $row->user_id;

                    $bonus->amount= ($row->amount);
                    $bonus->method= 'Token Settlement';
                    $bonus->type= 'Credit';
                    $bonus->status = 'approve';
                    $bonus->description= $row->amount. ' $ ' . 'settlement bonus for staking';
                    $bonus->save(); 
                    
                    
                    $bonus_token= new MusdWallet();
                    $bonus_token->user_id= $row->user_id;

                    $bonus_token->amount= -($row->amount);
                    $bonus_token->method= 'Token Settlement Adjustment';
                    $bonus_token->type= 'Debit';
                    //$bonus_token->status = 'approved';
                    $bonus_token->description= $row->amount. ' $ ' . 'settlement adjustment in Cash wallet for staking ';
                    $bonus_token->save();  
                    
                    $purchase_update= PurchaseMusd::where('id',$row->id)->first();
                    $purchase_up= PurchaseMusd::find($purchase_update->id);
                    $purchase_up->status= 1;
                    $purchase_up->save();
                    
            }
        }
        $this->info('Successfully added daily bonus.');
        
        
    }

    }
}
