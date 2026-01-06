<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function store(OrderCreateRequest $request, OrderService $order) {
        return $order->create($request->user(), $request->validated());
    }
}
