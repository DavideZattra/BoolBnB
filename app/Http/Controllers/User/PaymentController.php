<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Sponsor;
use App\Models\Apartment;
use App\User;

class PaymentController extends Controller
{
    public function process(Request $request, User $user)
    {
        // dd($request);
        // dd($user);
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xtb6mz33jvnv7kz4',
            'publicKey' => 'vyj99b6yqhnwsgcs',
            'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
        ]);

        // pass $clientToken to your front-end
        $clientToken = $gateway->clientToken()->generate([
            // 'customerId' => User::Pluck('id')->where('id', $user->id)
        ]);

        return view("users.braintree.payment", compact('clientToken'));
    }

    public function checkout(Request $request, User $user)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xtb6mz33jvnv7kz4',
            'publicKey' => 'vyj99b6yqhnwsgcs',
            'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Alessandro',
                'lastName' => 'Sainato',
                'email' => 'alessandro.sainato@boolean.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $transaction = $result->transaction;

            
            // $order = new Order();
            $data =  $request->all();

            $data['restaurant_id'] = (int)$data['restaurant_id'];   
            $data['total_price'] = $data['amount'];

            // $order->fill($data);
            // $order->save();
    
            return view('payment.checkout')->with('success_message', 'The payment was successfully. The id:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('Il pagamento non è andato a buon fine: '.$result->message);
        }
    }

}
