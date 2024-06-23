<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WithdrawBonus;
use Carbon\Carbon;
use DateTime;
use App\Models\BonusWallet;
use App\Models\AddMoney;
use App\Models\Withdraw;
use App\Models\UsdWallet;

class TimerCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time_check:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expiration Check';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $withdrawUSDT= UsdWallet::where('status','awaiting')->get();
        $withdraws= WithdrawBonus::where('status','awaiting')->get();
        $withdraw_funds= Withdraw::where('status','awaiting')->get();
        $transfers= BonusWallet::where('method','Transfer Money')->where('status','pending')->get();
        $transfer_funds= AddMoney::where('method','Transfer Money')->where('status','pending')->get();
        
        foreach ($withdrawUSDT as $row) {
            
              $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->created_at);


            $diff_in_minutes = $to->diffInMinutes($from);
            //dd($diff_in_minutes,$to,$from);
            if ($diff_in_minutes >= 15 ) {
               $update_withdraw= UsdWallet::find($row->id);
               $update_withdraw->status ='expired';
               $update_withdraw->save();
            }

        }
        
        
        foreach ($withdraws as $row) {
            
              $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->created_at);


            $diff_in_minutes = $to->diffInMinutes($from);
            //dd($diff_in_minutes,$to,$from);
            if ($diff_in_minutes >= 15 ) {
               $update_withdraw= WithdrawBonus::find($row->id);
               $update_withdraw->status ='expired';
               $update_withdraw->save();
            }

        }
         foreach ($withdraw_funds as $row4) {
            
              $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row4->created_at);


            $diff_in_minutes = $to->diffInMinutes($from);
            //dd($diff_in_minutes,$to,$from);
            if ($diff_in_minutes >= 15 ) {
               $update_withdraw= Withdraw::find($row4->id);
               $update_withdraw->status ='expired';
               $update_withdraw->save();
            }

        }
        foreach ($transfers as $row2) {
            
            $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
                      $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row2->created_at);


          $diff_in_minutes = $to->diffInMinutes($from);
          //dd($diff_in_minutes,$to,$from);
          if ($diff_in_minutes >= 15 ) {
             $update_transfer= BonusWallet::find($row2->id);
             $update_transfer->status ='expired';
             $update_transfer->save();
          }

      }
        foreach ($transfer_funds as $row3) {
            
            $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
                      $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row3->created_at);


          $diff_in_minutes = $to->diffInMinutes($from);
          //dd($diff_in_minutes,$to,$from);
          if ($diff_in_minutes >= 15 ) {
             $update_transfer= AddMoney::find($row3->id);
             $update_transfer->status ='expired';
             $update_transfer->save();
          }

      }



        $this->info('Successfully Check Expiration.');

    }
}
