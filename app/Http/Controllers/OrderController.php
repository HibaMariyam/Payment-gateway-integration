<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\EasebuzzWebService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('order', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $totalPrice = $product->price * $request->quantity;

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        $transaction = Transaction::create([
            'amount' => 2,
            'user_id' => Auth::user()->id,
            'transactionable_type' => Order::class,
            'transactionable_id' =>  $order->id
        ]);

        $redirectUrl = EasebuzzWebService::initiatePayment($transaction, Auth::user());




        return redirect($redirectUrl);
    }
}
