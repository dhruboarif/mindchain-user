<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
     protected $commands = [
         //Commands\DailyBonus::class,

     ];
    protected function schedule(Schedule $schedule)
    {
      $schedule->command('daily:schedule')->everyMinute();
      $schedule->command('users:deleteInactive')->daily(); 
    // Run the command daily

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
