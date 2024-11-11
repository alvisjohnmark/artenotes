<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Order;

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

    public function confirmPayment(Request $request)
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

        // $clientId = Auth::id();
        // if (!$clientId) {
        //     return response()->json(['message' => 'Please log in to checkout items to your cart.'], 403);
        // }

        // OrderItems::whereHas('cart', function ($query) use ($clientId) {
        // $query->where('order_id', $clientId);
        // })->where('checked', true)->delete();

        return response()->json([
            'redirect_url' => $confirmData['data']['attributes']['next_action']['redirect']['url'] 
        ]);

        
    }

    public function updateOrderStatus(Request $request)
    {
        // Validate the incoming request (optional)
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|integer', // 1 for COD status
        ]);

        try {
            // Find the order by ID
            $order = Order::findOrFail($request->order_id);

            // Update the order status
            $order->status = $request->status;
            $order->save();

            return response()->json(['message' => 'Order status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update order status'], 500);
        }
    }
}
