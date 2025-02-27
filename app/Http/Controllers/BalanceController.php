<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



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


        $data = [
            "key" => "MERCHANT_KEY",
            "txnid" => $transaction->id,
            "amount" => $request->amount,
            "productinfo" => "User Wallet",
            "firstname" => $user->name ?? "User",
            "email" => $user->email ?? "test@howincloud.com",
        ];

        $hashKey = self::getHashKey($data);


        $data['phone'] = $user->phone ?? "1234567890";
        $data['surl'] = route('payment.return');
        $data['furl'] = route('payment.return');
        $data['hash'] = $hashKey;


        $easebuzzProurl = "https://pay.easebuzz.in/pay/";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateLink', [
            'form_params' => $data,
        ]);
        $resp = json_decode($response->getBody()->getContents(), true);

        $redirectUrl = $easebuzzProurl . $resp['data'];

        return redirect($redirectUrl);
    }


    private function getHashKey($posted)
    {

        $hash_sequence   = "key|txnid|amount|productinfo|firstname|email||||||||||salt";

        $hash_sequence_array = explode('|', $hash_sequence);
        $hash = null;

        foreach ($hash_sequence_array as $value) {
            $hash .= isset($posted[$value]) ? $posted[$value] : '';
            $hash .= '|';
        }

        $hash .= "SALT_KEY";
        return strtolower(hash('sha512', $hash));
    }
}
