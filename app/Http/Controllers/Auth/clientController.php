<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class clientController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients', 
            'password' => 'required|string|min:8',
        ]);
    
        // Create client
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Automatically create a cart for the newly registered client
        Cart::create([
            'client_id' => $client->id,
        ]);
    
        // Generate token for the client
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

        // Check if client exists and password matches
        if (!$client || !Hash::check($request->password, $client->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create Sanctum token for the logged-in client
        $token = $client->createToken('client-token')->plainTextToken;

        return response()->json([
            'client' => $client,
            'token' => $token
        ], 200);
    }
}
