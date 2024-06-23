<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WelcomeMail;


class DeleteInactiveUsers extends Command
{
    protected $signature = 'users:deleteInactive';
    protected $description = 'Delete registered users after 48 hours if email is unverified';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        $expirationTime = now()->subHours(48);

        User::where('is_email_verified', '!=', 1)
            ->where('created_at', '<', $expirationTime)
            ->delete();

        $this->info('Inactive users deleted successfully.');
        Mail::to('ariful48@gmail.com')->send(new WelcomeMail());
    }
}
