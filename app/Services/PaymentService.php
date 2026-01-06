<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use PaypalServerSdkLib\Authentication\ClientCredentialsAuthCredentialsBuilder;
use PaypalServerSdkLib\Environment;
use PaypalServerSdkLib\Models\Builders\AmountBreakdownBuilder;
use PaypalServerSdkLib\Models\Builders\ItemBuilder;
use PaypalServerSdkLib\Models\Builders\MoneyBuilder;
use PaypalServerSdkLib\Models\Builders\AmountWithBreakdownBuilder;
use PaypalServerSdkLib\Models\Builders\OrderRequestBuilder;
use PaypalServerSdkLib\Models\Builders\PaymentSourceBuilder;
use PaypalServerSdkLib\Models\Builders\PurchaseUnitRequestBuilder;
use PaypalServerSdkLib\PaypalServerSdkClient;
use PaypalServerSdkLib\PaypalServerSdkClientBuilder;

class PaymentService {
    /**
     * @return void
     */

    protected static PaypalServerSdkClient $client;

    public function __construct()
    {
        self::$client = PaypalServerSdkClientBuilder::init()
             ->clientCredentialsAuthCredentials(ClientCredentialsAuthCredentialsBuilder::init(
                 config('paypal.CLIENT_ID'),
                 config('paypal.CLIENT_SECRET'),
             ))
             ->environment(Environment::SANDBOX)
             ->build();
    }

    protected  static function handlePaypalResponse($response)
    {
        $jsonResponse = json_decode($response->getBody(), true);
        return [
            "jsonResponse" => $jsonResponse,
            "httpStatusCode" => $response->getStatusCode(),
        ];
    }

    public function paypalCreateOrder(User $user, Array $data) {

        $address = $user->addresses()->find($data['shipping_id']);

        $payload = [
            'body' => [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "custom_id" => $address->id,
                        "amount" => [
                            "currency_code" => "PHP",
                            "value" => $data['total'],
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => "PHP",
                                    "value" => $data['total']
                                ],
                            ]
                        ],
                        "items" => collect($data['products'])->map(function (array $product) {
                            return [
                                'name' => $product['product_name'],
                                'unit_amount' => [
                                    'currency_code' => 'PHP',
                                    'value' => $product['price'],
                                ],
                                'quantity' => $product['quantity'],
                                'image_url' => $product['image'],
                                'url' => $product['product_link']
                            ];
                        })->toArray(),

                        "shipping" => [
                            "name" => [
                                "full_name" => $address->recipient_name
                            ],
                            "address" => [
                                "address_line_1" => $address->phone,
                                "address_line_2" => (string) $address->street,
                                "admin_area_2" => $address->city,
                                "admin_area_1" => $address->province,
                                "postal_code" => "95131",
                                "country_code" => "PH"
                            ]
                        ]
                    ],
                ],
                "payment_source" => [
                    "paypal" => [
                        "experience_context" => [
                            "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                            "landing_page" => "LOGIN",
                            "shipping_preference" => "SET_PROVIDED_ADDRESS",
                            "user_action" => "PAY_NOW",
                            "return_url" => $data['return_url'],
                            "cancel_url" => $data['cancel_url']
                        ]
                    ]
                ]
            ]
        ];

        $apiResponse = self::handlePaypalResponse(self::$client->getOrdersController()->createOrder($payload));

        if ($apiResponse['httpStatusCode'] > 300) {
            return response()->json([
                'success' => false,
                'message' => "Something went wrong when creating paypal order",
                'error' => $apiResponse['jsonResponse']
            ], $apiResponse['httpStatusCode']);
        }
        return response()->json([
            'success' => true,
            'message' => "Paypal Order successfully created",
            'data' => $apiResponse['jsonResponse'],
        ]);
    }

    public static function paypalCaptureOrder(string $token) {
        $captureBody = [
            'id' => $token
        ];

        return self::handlePaypalResponse(self::$client->getOrdersController()->captureOrder($captureBody));
    }



    public function create(User $user, Array $data) {

        $exists = $user->orders()->where('order_no', $data['token'])->first();

        if ($exists){
            return response()->json([
                'success' => true,
                'message' => "Order Successfull retrieved",
                'data' => $exists->toResource()
            ]);
        }

        $capture = self::paypalCaptureOrder($data['token']);

        if($capture['httpStatusCode'] >= 300){
            return response()->json([
                'success' => false,
                'message' => "Something went wrong when capturing paypal order",
                'error' => $capture['jsonResponse']
            ], $capture['httpStatusCode']);
        }

        dd(self::$client->getOrdersController()->getOrder($data['token']));

        /* $order = DB::transaction(function () use($user,$data) { */
        /*     $order = $user->orders()->create([ */
        /*         'order_no' => $data['order_no'], */
        /*         'total' => $data['total'] */
        /*     ]); */
        /**/
        /**/
        /*     $order->products()->createMany($data['products']); */
        /**/
        /*     return $order->load('products'); */
        /* }); */

        return self::paypalCreateOrder($data);
    }
}
