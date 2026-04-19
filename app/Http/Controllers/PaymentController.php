<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Models\Payment;

class 
PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // Show page
    public function index()
    {
        return view('payment');
    }

    // Create order
    public function createOrder()
    {
        $order = $this->paymentService->createOrder(100);

        Payment::create([
            'order_id' => $order['id'],
            'amount' => 100,
            'status' => 'created'
        ]);

        return response()->json($order);
    }

    // Verify payment
    public function verify(Request $request)
    {
        try {
            $this->paymentService->verify([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);

            Payment::where('order_id', $request->razorpay_order_id)
                ->update([
                    'payment_id' => $request->razorpay_payment_id,
                    'status' => 'success'
                ]);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {

            return response()->json(['status' => 'failed']);
        }
    }
}
