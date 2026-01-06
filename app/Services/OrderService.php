<?php

namespace App\Services;

use App\Services\PaymentService;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService extends  PaymentService {
    public function create(User $user, Array $data) {
        $exists = $user
            ->orders()
            ->where('order_no', $data['token'])
            ->with(['products', 'address'])
            ->first();


        if ($exists){
            return response()->json([
                'success' => true,
                'message' => "Order Successfull retrieved",
                'data' => $exists->toResource()
            ]);
        }


        /* $capture = self::paypalCaptureOrder($data['token']); */
        /**/
        /* if($capture['httpStatusCode'] >= 300){ */
        /*     return response()->json([ */
        /*         'success' => false, */
        /*         'message' => "Something went wrong when capturing paypal order", */
        /*         'error' => $capture['jsonResponse'] */
        /*     ], $capture['httpStatusCode']); */
        /* } */

        $orderDetails = self::handlePaypalResponse(self::$client->getOrdersController()->getOrder([
            'id' => $data['token']
        ]))['jsonResponse'];


        $purchaseUnits = $orderDetails['purchase_units'][0];


        $order = DB::transaction(function () use($user,$orderDetails, $purchaseUnits) {
            $order = $user->orders()->create([
                'order_no' => $orderDetails['id'],
                'address_id' => (int) $purchaseUnits['custom_id'],
                'total' => (float) $purchaseUnits['amount']['value']
            ]);


            $order->products()->createMany(collect($purchaseUnits['items'])->map(function (Array $item) {
                return [
                    'price' => (float) $item['unit_amount']['value'],
                    'quantity' => (int) $item['quantity'],
                    'product_name' => $item['name'],
                    'image' => $item['image_url'],
                    'product_link' => $item['url'],
                ];
            })->toArray());

            return $order->load('products');
        });


        return response()->json([
            'success' => true,
            'message' => "Order successfully created",
            'data' => $order->toResource()
        ], 201);
    }
}
