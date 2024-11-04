<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItems;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\OrderItems;
use App\Models\Client;

class cartController extends Controller
{
    public function addToCart(Request $request)
    {
        $clientId = Auth::id();
        if (!$clientId) {
            return response()->json(['message' => 'Please log in to add items to your cart.'], 403);
        }

        $cart = Cart::firstOrCreate(['client_id' => $clientId]);
        $itemId = $request->input('item_id');
        $itemType = $request->input('item_type'); 
        $quantity = $request->input('quantity', 1);
        $price = 0;

        if ($itemType === 'product') {
            $product = Product::find($itemId);
            if (!$product) {
                return response()->json(['message' => 'Product not found.'], 404);
            }
            $price = $product->price;
        } elseif ($itemType === 'service') {
            $service = Service::find($itemId);
            if (!$service) {
                return response()->json(['message' => 'Service not found.'], 404);
            }
            $price = $service->service_price;
        } else {
            return response()->json(['message' => 'Invalid item type.'], 400);
        }

        $totalPrice = $price * $quantity;

        $cartItem = CartItems::where('cart_id', $cart->id)
            ->where('item_id', $itemId)
            ->where('item_type', $itemType)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity; 
            $cartItem->total_price = $totalPrice;
            $cartItem->save();
        } else {
            CartItems::create([
                'cart_id' => $cart->id,
                'item_id' => $itemId, 
                'item_type' => $itemType,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $totalPrice,
            ]);
        }

        return response()->json(['message' => ucfirst($itemType) . ' added to cart successfully.']);
    }

    public function getCartItems()
    {
        $clientId = Auth::id();
    
        $cart = Cart::where('client_id', $clientId)->first();
    
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }
    
        $cartItems = CartItems::with([
            'product',
            'product.pictures:id,product_id,file_path',
        ])
        ->where('cart_id', $cart->id) 
        ->get();
    
        return $cartItems;
    }
    
public function updateChecked(Request $request, $itemId)
{

    $cartItem = CartItems::find($itemId);
    $cartItem->checked = $request->checked;
    $cartItem->save();

    return response()->json(['message' => 'Checked status updated successfully']);
}

    
public function updateQuantity(Request $request, $id)
{
    $item = CartItems::find($id);
    if (!$item) {
        return response()->json(['message' => 'Quantity not found'], 404);
    }
    $item->update($request->only(['quantity']));
    return response()->json(['message' => 'Quantity updated successfully', 'quantity' => $item->quantity]);
}

public function removeFromCart($id)
{
    $cartItem = CartItems::where('id', $id)->first();

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found'], 404);
    }    $cartItem->delete();

    return response()->json(['message' => 'Item removed from cart successfully']);
}

public function checkoutOrder(Request $request, $id)
{
    $client = Order::find($id);
        if (!$client) {
            return response()->json(['message' => 'client not found'], 404);
        }

    $client->client_id = $request->client_id;
    $client->total_amount = $request->total;
    $client->status  = 1;
    $client->save();

    return response()->json(['message' => 'Order placed successfully.']);
}

public function saveOrderItems($orderId)
{
    $clientId = Auth::id();
        if (!$clientId) {
            return response()->json(['message' => 'Please log in to checkout items to your cart.'], 403);
        }

    $order = Order::firstOrCreate(['client_id' => $clientId]);

    $cartItems = CartItems::whereHas('cart', function ($query) use ($clientId) {
        $query->where('client_id', $clientId);
    })->where('checked', true)->get();

    foreach ($cartItems as $item) {
        OrderItems::create([
            'order_id' => $order->id,
            'item_id' => $item->item_id,
            'item_type' => $item->item_type,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total_price' => $item->total_price,
        ]);
    }

    // CartItems::whereHas('cart', function ($query) use ($clientId) {
    //     $query->where('client_id', $clientId);
    // })->where('checked', true)->delete();

    return response()->json(['message' => 'Order items saved successfully.']);
}




}

    