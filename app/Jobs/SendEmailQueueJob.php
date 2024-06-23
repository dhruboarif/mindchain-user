<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomizeEmail;

class SendEmailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $subject;
    protected $content;
    protected $user;


    public function __construct($email, $subject, $content, $user)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
        $this->user = $user;
    }

    public function handle()
    {
        //dd($this->user);
        Mail::to($this->email)
            ->send(new CustomizeEmail($this->subject, $this->content, $this->user));
    }
}
