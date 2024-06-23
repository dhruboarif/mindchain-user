<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PurcahseCommunityToken;
use Carbon\Carbon;
use DateTime;
use App\Models\BmindWallet; 
use App\Models\User; 

class bmindDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bmind:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Bmind Bonus';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $purchases = PurcahseCommunityToken::where('token_name', 'bmind')
                    ->whereNotIn('user_id', [1])
                    ->get();
    // dd($purchases);

      foreach ($purchases as $row) {

              $date1 = new DateTime($row['created_at']);
              $date2 = new DateTime(Carbon::now()->addDay(1));
              $days  = $date2->diff($date1)->format('%a');
//dd($row);
             if ($days <= $row->bonus_duration){
                $user = User::where('id', $row->user_id)->first();
                $bonus_amount = new BmindWallet();
                $bonus_amount->user_id = $user->id;
                $bonus_amount->amount = $row->daily_bonus;
                $bonus_amount->method = 'Daily Bmind Staking Bonus';
                $bonus_amount->type = 'Credit';
                $bonus_amount->status = 'approved';
                $bonus_amount->description= $row->daily_bonus .' BMIND'. ' Bonus for Staking Bmind';
                $bonus_amount->save();
            }
        else
        {
            if($row->stake_refund_status == 0)
            {
                    $bonus= new BmindWallet();
                    $bonus->user_id= $row->user_id;
                    $bonus->amount= ($row->token_amount);
                    $bonus->method= 'Bmind Token Settlement';
                    $bonus->type= 'Credit';
                    $bonus->status = 'approved';
                    $bonus->description= $row->amount. ' $ ' . 'settlement for bmind staking';
                    $bonus->save(); 
                    
                    $bmindstakededuct= new bmind_staking_wallets();
                    $bmindstakededuct->user_id= $row->user_id;
                    $bmindstakededuct->amount= -($row->token_amount);
                    $bmindstakededuct->method= 'Bmind Token Settlement Adjustment';
                    $bmindstakededuct->type= 'Debit';
                    $bmindstakededuct->status = 'Approved';
                    $bmindstakededuct->description= $row->amount. ' $ ' . 'settlement adjustment in Bmind wallet for staking ';
                    $bmindstakededuct->save();
                    
                    $purchase_update= PurcahseCommunityToken::where('id',$row->id)->first();
                    $purchase_up= PurcahseCommunityToken::find($purchase_update->id);
                    $purchase_up->stake_refund_status= 1;
                    $purchase_up->save();
            }
        }
        $this->info('Successfully added daily bonus.');
    }
    }
}
