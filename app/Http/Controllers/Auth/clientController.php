<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class clientController extends Controller
{
    public function register(Request $request)
    {
        $client = Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make(value: $request->password),
        ]);
    
        Cart::create([
            'client_id' => $client->id,
        ]);

        Order::create([
            'client_id' => $client->id,
        ]);
    
        $token = $client->createToken('client-token')->plainTextToken;
    
        return response()->json([
            'client' => $client,
            'token' => $token
        ], 201);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'string|email',
            'password' => 'string',
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $client->createToken('client-token')->plainTextToken;

        return response()->json([
            'client' => $client,
            'token' => $token
        ], 200);
    }

    public function getClientDetails()
    {
        $clientId = Auth::id();

        $clientDetails = Client::find($clientId);
        return response()->json($clientDetails);
    }

    public function saveAddress(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'client not found'], 404);
        }
    
        $client->street = $request->street;
        $client->{"city/town"} = $request->city; 
        $client->province = $request->province;
        $client->country = $request->country;
        $client->zipcode = $request->zipcode;
        $client->hasAddress = 1;
        $client->save();

    
        return response()->json(['message' => ' addresss added']);
    }
}
