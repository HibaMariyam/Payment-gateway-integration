<?php

namespace App\Services;

class EasebuzzWebService
{

    public static function initiatePayment($transaction, $user)
    {
        $data = [
            "key" => "CSBST4AV6Y",
            "txnid" => $transaction->id,
            "amount" => $transaction->amount,
            "productinfo" => "User Wallet",
            "firstname" => $user->name ?? "User",
            "email" => $user->email ?? "test@howincloud.com",
            "phone" => $user->phone ?? "1234567890",
            "surl" => route('payment.return'),
            "furl" => route('payment.return'),
        ];

        $data['hash'] = self::getHashKey($data);

        $easebuzzProurl = "https://pay.easebuzz.in/pay/";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateLink', [
            'form_params' => $data,
        ]);

        $resp = json_decode($response->getBody()->getContents(), true);
        $redirectUrl = $easebuzzProurl . $resp['data'];

        return $redirectUrl;
    }

    private static function getHashKey($posted)
    {

        $hash_sequence   = "key|txnid|amount|productinfo|firstname|email||||||||||salt";

        $hash_sequence_array = explode('|', $hash_sequence);
        $hash = null;

        foreach ($hash_sequence_array as $value) {
            $hash .= isset($posted[$value]) ? $posted[$value] : '';
            $hash .= '|';
        }

        $hash .= "TUQ0SKLVVX";
        return strtolower(hash('sha512', $hash));
    }
}
