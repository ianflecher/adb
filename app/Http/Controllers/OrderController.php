<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // In your OrderController

    public function checkout(Request $request)
{
    try {
        // Validate the incoming request data
        $validated = $request->validate([
            'order_status' => 'required|string',
            'total_price' => 'required|numeric',
            'items' => 'required|string',  // We're now expecting a JSON string for items
        ]);

        // Decode items from JSON string to array
        $items = json_decode($validated['items'], true);

        // Validate items array (optional but recommended)
        if (!is_array($items) || empty($items)) {
            throw new \Exception('Invalid items data.');
        }

        // Always use the default guest customer (make sure ID 1 exists)
        $guestCustomerId = 1;

        // Check if the customer exists before proceeding
        if (!$customer = Customer::find($guestCustomerId)) {
            throw new \Exception('Guest customer not found.');
        }

        // Create a new order
        $order = new Order();
        $order->customer_id = $guestCustomerId;
        $order->order_status = $validated['order_status'];
        $order->total_price = $validated['total_price'];
        $order->payment_id = null; 
        $order->discount_id = null; 
        $order->save();

        // Save each order item
        foreach ($items as $item) {
            // Check if product exists
            if (!$product = Product::find($item['id'])) {
                throw new \Exception('Product not found for ID: ' . $item['id']);
            }

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
        }
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred during checkout: ' . $e->getMessage()
        ], 500);
    }
    return view('user.home');
}

    public function showCheckoutPage()
    {
        $cart = session('cart', []);
        return view('user.checkout', compact('cart'));
    }

    public function payment()
    {
        return view('user.payment');
    }
}    