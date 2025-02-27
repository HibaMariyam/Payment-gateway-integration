<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\EasebuzzWebService;

class BalanceController extends Controller
{
    public function showForm()
    {
        return view('balance.add-money');
    }

    public function addMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $transaction = Transaction::create([
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'transactionable_type' => User::class,
            'transactionable_id' => Auth::user()->id
        ]);

        $redirectUrl = EasebuzzWebService::initiatePayment($transaction, Auth::user());

        return redirect($redirectUrl);
    }
}
