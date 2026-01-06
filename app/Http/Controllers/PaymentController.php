<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentCreateRequest;
use App\Services\PaymentService;


class PaymentController extends Controller
{
    public function createOrder(PaymentCreateRequest $request, PaymentService $payment) {
        return $payment->paypalCreateOrder($request->user(), $request->validated());
    }
}
