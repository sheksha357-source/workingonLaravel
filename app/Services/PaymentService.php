<?php

namespace App\Services;

use Razorpay\Api\Api;

class PaymentService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    public function createOrder($amount)
    {
        return $this->api->order->create([
            'receipt' => uniqid(),
            'amount' => $amount * 100,
            'currency' => 'INR'
        ]);
    }

    public function verify($data)
    {
        return $this->api->utility->verifyPaymentSignature($data);
    }
}