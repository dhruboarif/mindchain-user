<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\UsdWallet;
use App\Models\EliteSetting;
use App\Models\usdStaking; 

class DailyUsdStaking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usd:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily USD Staking';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $EliteSetting = EliteSetting::first(); 
      $bonusApplicate= $EliteSetting->duration; 

      
      $eliteUsers = usdStaking::whereNotIn('user_id', [1])->get();
      //$eliteUsers = usdStaking::where('user_id', 2354)->get();

        //dd($eliteUsers->created_at);
        
        foreach ($eliteUsers as $user) {

                $createdAt = Carbon::parse($user->created_at);
                $currentDate = Carbon::now();
                $days = $createdAt->diffInDays($currentDate); 
                
               
                if ($createdAt->diffInDays($currentDate) <= $bonusApplicate)
                     //dd($bonusApplicate);

                  $bonus= new UsdWallet();
                  $bonus->user_id= $user->user_id;

                  $bonus->amount= $user->daily_bonus;
                  $bonus->method= 'Daily USD Staking Bonus';
                  $bonus->type= 'Credit';
                  $bonus->status = 'approve';
                  $bonus->description= $user->daily_bonus . ' $ ' . 'Daily Bonus for purchasing Elite Membership' ;
                  $bonus->save();
        }
        $this->info('Successfully added USD daily bonus.');

        return Command::SUCCESS;
    }
}
