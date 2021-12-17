<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SponsorApartment;
use App\Models\Apartment;
use App\Models\Sponsor;

class PaymentController extends Controller
{
    public function payment($apartment)
    {   
        if(Auth::user()->id != Apartment::findOrFail($apartment)->user_id){
            return redirect()->route('users.apartments.index');
        }

        $sponsors = Sponsor::all();

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('users.braintree.payment', compact('token', 'sponsors', 'apartment'));

    }

    public function checkout(Request $request, $apartment)
    {
        $user = Auth::user();
        
        

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([

            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $user->name,
                'lastName' => $user->surname,
                'email' => $user->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {

            $transaction = $result->transaction;
            $sponsor = Sponsor::where('price', $transaction->amount)->get();
            // dd($sponsor[0]);
            $newSponsorApartment = new SponsorApartment;
            
            $newSponsorApartment->apartment_id =  ($apartment);
            $newSponsorApartment->sponsor_id = $sponsor[0]->id;
            $newSponsorApartment->transaction_id = $transaction->id; 
            $newSponsorApartment->start = Carbon::now()->toDateTimeString();
            $newSponsorApartment->end = Carbon::now()->addDays($sponsor[0]->duration)->toDateTimeString();

            // dd($newSponsorApartment);
            $newSponsorApartment->save();



            return view('users.braintree.checkout')->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
          
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }

}
