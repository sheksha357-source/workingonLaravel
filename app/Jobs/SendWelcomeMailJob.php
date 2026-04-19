<?php
namespace App\Jobs;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;        // retry 3 times if fails
    public int $timeout = 60;     // max 60 seconds per attempt

    public function __construct(public int $userId) {}

    // this runs in background
    public function handle()
    {
        $user = User::findOrFail($this->userId);

        Mail::to('psvali000@gmail.com')  // override email for testing
            ->send(new WelcomeMail($user));
    }

    // runs if all retries fail
    public function failed(\Throwable $exception)
    {
        \Log::error('WelcomeMail failed: ' . $exception->getMessage());
    }
}
