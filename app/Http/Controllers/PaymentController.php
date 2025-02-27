<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentReturn(Request $request)
    {
        info($request->all());
        $success = $request->query('success', false); // Default to false if not provided

        $txnid = $request->txnid;
        $status = $request->status;
        $transaction = Transaction::where('id', $txnid)->first();

        if ($status == "success") {
            $user = User::find($transaction->user_id);
            $user->balance += $transaction->amount;
            $user->save();
        }
        $transaction->status = $status;
        $transaction->save();


        return view('payment_return', compact('success'));
    }
}
