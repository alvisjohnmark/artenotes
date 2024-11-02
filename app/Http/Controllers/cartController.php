<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CartItems;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Service;

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
    $cartItems = CartItems::with([
        'product', 
        'product.pictures:id,product_id,file_path',
    ])->get();

    return $cartItems;
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


}

    