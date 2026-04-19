<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestMail extends Command
{
    protected $signature   = 'mail:send-test';
    protected $description = 'Send beautiful test mail every 1 minute';

   public function handle()
{
    try {
        $recipients = [
            'psvali000@gmail.com',
            'sheksha357@gmail.com',
        ];

        $data = [
            'sentAt' => now()->format('d M Y, h:i A'),
        ];

        foreach ($recipients as $email) {
            $data['email'] = $email; // pass each email to blade

            Mail::send('emails.auto-test', $data, function ($message) use ($email) {
                $message->to($email)
                        ->subject('🛍️ Welcome to Hallimart! ' . now()->format('d M Y, h:i A'));
            });

            $this->info('✅ Mail sent to: ' . $email);
        }

    } catch (\Throwable $e) {
        $this->error('❌ Mail failed: ' . $e->getMessage());
    }
}
}