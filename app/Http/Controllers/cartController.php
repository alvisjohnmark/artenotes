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
use App\Models\RecipientDetail;
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
        $recipient = RecipientDetail::firstOrCreate(['client_id' => $clientId]);
    
        // Extract request data
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
    
        // Check for existing cart item
        $cartItem = CartItems::where('cart_id', $cart->id)
            ->where('item_id', $itemId)
            ->where('item_type', $itemType)
            ->first();
    
        // Process recipient details if it's a service
        $recipientDetailsId = null;
        if ($itemType === 'service') {
            $recipientDetails = $request->input('recipientDetails', []);
            $hasRose = $recipientDetails['has_rose'] ?? false;
    
            if ($hasRose) {
                $totalPrice += 100;
            }
    
            $recipientDetail = RecipientDetail::create([
                'client_id' => $recipient->id,
                'font' => $recipientDetails['font'] ?? null,
                'has_rose' => $hasRose,
                'envelope_color' => $recipientDetails['envelope_color'] ?? null,
                'recipient_name' => $recipientDetails['recipient_name'] ?? null,
                'province' => $recipientDetails['province'] ?? null,
                'city_municipality' => $recipientDetails['city_municipality'] ?? null,
                'barangay' => $recipientDetails['barangay'] ?? null,
                'street' => $recipientDetails['street'] ?? null,
                'message' => $recipientDetails['message'] ?? null,
            ]);
    
            $recipientDetailsId = $recipientDetail->id;
        }
    
        if ($cartItem) {
            $updateData = [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ];
    
            // Only update recipient_detail_id if the item type is service
            if ($itemType === 'service') {
                $updateData['recipient_detail_id'] = $recipientDetailsId;
            }
    
            $cartItem->update($updateData);
        } else {
            CartItems::create([
                'cart_id' => $cart->id,
                'recipient_detail_id' => $itemType === 'service' ? $recipientDetailsId : $recipient->id,
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
    
        $cartItems = CartItems::where('cart_id', $cart->id)
            ->with([
                'product' => function ($query) {
                    $query->with('pictures:id,product_id,file_path');
                },
                'service',
                'recipientDetail' 
            ])
            ->get()
            ->unique(function ($item) {
                return $item->item_id . '-' . $item->item_type;
            });
    
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
public function removeFromOrder($id, Request $request)
{
    $recipientDetailId = $request->recipient_detail_id;

    $orderItem = OrderItems::where('id', $id)
                            ->where('recipient_detail_id', $recipientDetailId)
                            ->first();

    if (!$orderItem) {
        return response()->json(['message' => 'Item not found or recipient detail mismatch'], 404);
    }

    // Find the related order and cart item
    $order = Order::find($orderItem->order_id);
    $cartItem = CartItems::where('item_id', $orderItem->item_id)
                         ->where('recipient_detail_id', $recipientDetailId) // Ensure matching recipient detail
                         ->first();

    // Delete the order item
    $orderItem->delete();

    // Calculate the new total amount for the order
    $totalAmount = OrderItems::where('order_id', $order->id)->sum('total_price');
    $order->total_amount = $totalAmount > 0 ? $totalAmount + 80 : 0;
    $order->status = 0;
    $order->save();

    // Update `checked` to false if the CartItem exists and matches recipient_detail_id
    if ($cartItem) {
        $cartItem->checked = false;
        $cartItem->save(); 
    }

    return response()->json(['message' => 'Item removed from cart successfully']);
}




public function checkoutOrder(Request $request, $id)
{
    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $totalAmount = OrderItems::where('order_id', $order->id)->sum('total_price');

    $order->client_id = $request->client_id;
    $order->status = 1; 
    $order->save();

    return response()->json(['message' => 'Order placed successfully.', 'total_amount' => $totalAmount]);
}



public function saveOrderItems(Request $request)
{
    $clientId = Auth::id();
    if (!$clientId) {
        return response()->json(['message' => 'Please log in to checkout items to your cart.'], 403);
    }

    $order = Order::firstOrCreate(['client_id' => $clientId]);
    $recipient = RecipientDetail::firstOrCreate(['client_id' => $clientId]);

    $cartItems = CartItems::whereHas('cart', function ($query) use ($clientId) {
        $query->where('client_id', $clientId);
    })->where('checked', true)->get();

    // $totalAmount = 0; 

    foreach ($cartItems as $item) {
        $totalPrice = $item->quantity * $item->price;

        OrderItems::updateOrCreate(
            [
                'recipient_detail_id' => $recipient->id,
                'order_id' => $order->id,
                'item_id' => $item->item_id,
                'item_type' => $item->item_type,
            ],
            [
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $totalPrice, 
            ]
        );
    }

    // $order->total_amount = $totalAmount+80;
    // $order->save();

    return response()->json(['message' => 'Order items saved successfully.']);
}


public function getOrderItems()
{
    $clientId = Auth::id();

    $order = Order::where('client_id', $clientId)->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $totalAmount = (int) OrderItems::where('order_id', $order->id)->sum('total_price');
    
    $order->total_amount = $totalAmount > 0 ? $totalAmount + 80 : 0;
    $order->save();

    $orderItems = OrderItems::with([
        'product',
        'product.pictures:id,product_id,file_path',
    ])
    ->where('order_id', $order->id) 
    ->get();

    return response()->json([
        'order_items' => $orderItems,
        'total_amount' => $order->total_amount,
        'subtotal' => $totalAmount,
    ]);
}




}

    