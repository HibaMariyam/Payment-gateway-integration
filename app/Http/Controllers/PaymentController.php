<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentReturn(Request $request)
    {
        info($request->all());
        $success = false; // Default to false if not provided

        $txnid = $request->txnid;
        $status = $request->status;
        $transaction = Transaction::where('id', $txnid)->first();

        if ($status == "success") {

            switch ($transaction->transactionable_type) {
                case Order::class:
                    $order = Order::find($transaction->transactionable_id);
                    $order->status = 'completed';
                    $order->save();
                    break;

                case User::class:
                    $user = User::find($transaction->user_id);
                    $user->balance += $transaction->amount;
                    $user->save();
                    break;
            }
            $success = true;
        } else {
            switch ($transaction->transactionable_type) {
                case Order::class:
                    $order = Order::find($transaction->transactionable_id);
                    $order->status = 'failed';
                    $order->save();
                    break;

                case User::class:
                    break;
            }
        }
        $transaction->status = $status;
        $transaction->save();


        return view('payment_return', compact('success'));
    }


    public function paymentWebhook(Request $request)
    {
        info($request->all());
    }
}
