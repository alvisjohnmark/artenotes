<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\CartItems;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
{
    $client = new Client();
    $url = 'https://api.paymongo.com/v1/payment_intents';

    $amount = max($request->amount, 2000); 

    $response = $client->post($url, [
        'auth' => [env('PAYMONGO_SECRET_KEY'), ''],
        'json' => [
            'data' => [
                'attributes' => [
                    'amount' => $amount,
                    'payment_method_allowed' => ['gcash'],
                    'currency' => 'PHP',
                ]
            ]
        ]
    ]);

    $responseBody = json_decode($response->getBody(), true);
    return response()->json($responseBody['data']);
}

    public function confirmPayment(Request $request,$orderID)
    {
        $client = new Client();
        $paymentMethodUrl = 'https://api.paymongo.com/v1/payment_methods';
        $attachIntentUrl = "https://api.paymongo.com/v1/payment_intents/{$request->payment_intent_id}/attach";

        $paymentMethodResponse = $client->post($paymentMethodUrl, [
            'auth' => [env('PAYMONGO_SECRET_KEY'), ''],
            'json' => [
                'data' => [
                    'attributes' => [
                        'type' => 'gcash', 
                    ]
                ]
            ]
        ]);

        $paymentMethodData = json_decode($paymentMethodResponse->getBody(), true);

        $confirmResponse = $client->post($attachIntentUrl, [
            'auth' => [env('PAYMONGO_SECRET_KEY'), ''],
            'json' => [
                'data' => [
                    'attributes' => [
                        'payment_method' => $paymentMethodData['data']['id'],
                        'client_key' => $request->client_key,
                        'return_url' => 'http://localhost:8088/thankyou', 
                    ]
                ]
            ]
        ]);

        // Get the response data and extract the redirect URL
        $confirmData = json_decode($confirmResponse->getBody(), true);

        $order = Order::find($orderID);
        $order->status = 1;
        $order->save();

        CartItems::where('cart_id', $orderID)
            ->where('checked', 1)
            ->delete();
        
        OrderItems::where('order_id', $orderID)
            ->delete();
   
            
        return response()->json([
            'redirect_url' => $confirmData['data']['attributes']['next_action']['redirect']['url'] 
        ]);

        
    }

    public function updateOrderStatus($orderId)
    {
        try {
            $order = Order::find($orderId);
            $order->status = 1;
            $order->save();
    
            CartItems::where('cart_id', $orderId)
                ->where('checked', 1)
                ->delete();
            
            OrderItems::where('order_id', $orderId)
                ->delete();
    

            return response()->json(['message' => 'Order status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update order status', 'error' => $e->getMessage()], 500);
        }
    }
    
}
