<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PurcahseCommunityToken; 
use App\Models\User; 

class BmindTeamInvestmentUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bmind:teaminvest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        //$users = User::where('id', 138)->get();
 
 
        foreach ($users as $user) {
            $teamInvestment = $this->calculateTeamInvestment($user);
            //dd($teamInvestment); 
            $user->update(['team_invest' => $teamInvestment]);
        }

    $this->info('Successfully updated bmind team investment.');
    }
    
     private function calculateTeamInvestment($user, $depth = 0, $maxDepth = 20)
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
