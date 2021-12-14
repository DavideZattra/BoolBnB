<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\User\Braintree\Gateway;
use App\Models\Sponsor;

class PaymentController extends Controller
{
    // public function process()
    // {
    //     $gateway = new \Braintree\Gateway([
    //         'environment' => 'sandbox',
    //         'merchantId' => 'xtb6mz33jvnv7kz4',
    //         'publicKey' => 'vyj99b6yqhnwsgcs',
    //         'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
    //     ]);

    //     $token = $gateway->clientToken()->generate();

    //     return view("payment", compact('token'));
    // }

    // public function checkout(Request $request)
    // {
    //     dd($request);
    //     $gateway = new \Braintree\Gateway([
    //         'environment' => 'sandbox',
    //         'merchantId' => 'xtb6mz33jvnv7kz4',
    //         'publicKey' => 'vyj99b6yqhnwsgcs',
    //         'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
    //     ]);

    //     $amount = $request->amount;
        

    //     $nonce = $request->payment_method_nonce;


    //     //dati inviati al sito braintree
    //     $result = $gateway->transaction()->sale([
    //         'amount' => $amount,
    //         'paymentMethodNonce' => $nonce,
    //         'customer' => [
    //             'firstName' => 'Alessandro',
    //             'lastName' => 'Sainato',
    //             'email' => 'alessandro.sainato@boolean.com',
    //         ],
    //         'options' => [
    //             'submitForSettlement' => true
    //         ]
    //     ]);
    
    //     if ($result->success) {
    //         $transaction = $result->transaction;

            
    //         $sponsor = new Sponsor();
    //         $data =  $request->all();

    //         $data['restaurant_id'] = (int)$data['restaurant_id'];   
    //         $data['total_price'] = $data['amount'];

    //         $sponsor->fill($data);
    //         $sponsor->save();
    
    //         return view('payment.checkout')->with('success_message', 'The payment was successfully. The id:'. $transaction->id);
    //     } else {
    //         $errorString = "";
    
    //         foreach ($result->errors->deepAll() as $error) {
    //             $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    //         }
    
    //         // $_SESSION["errors"] = $errorString;
    //         // header("Location: index.php");
    //         return back()->withErrors('Sorry! The payements was not successfull: '.$result->message);
    //     }
    // }
}
