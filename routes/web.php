<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PaymentController;
use App\Jobs\SendWelcomeMailJob;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('This is a Laravel test email.', function ($message) {
            $message->to('psvali000@gmail.com')
                ->subject('Laravel Test Mail');
        });

        return 'Test email sent successfully.';
    } catch (\Throwable $e) {
        return response('Mail send failed: '.$e->getMessage(), 500);
    }
});
Route::get('/test-queue-mail', function () {

    // dispatch job
    SendWelcomeMailJob::dispatch(1);

    return 'Job dispatched! Check jobs table & run queue:work';
});
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{id}/send-mail', [UserController::class, 'sendMail'])->name('users.sendMail');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/create-order', [PaymentController::class, 'createOrder']);
Route::post('/verify-payment', [PaymentController::class, 'verify']);
