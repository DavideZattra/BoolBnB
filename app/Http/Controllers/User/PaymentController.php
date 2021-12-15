<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Sponsor;

class PaymentController extends Controller
{
    public function process(Request $request, User $user)
    {
        // dd($request);
        // dd($user);
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('users.braintree.payment', [
            'token' => $token
        ]);

    }

    public function checkout(Request $request, User $user)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xtb6mz33jvnv7kz4',
            'publicKey' => 'vyj99b6yqhnwsgcs',
            'privateKey' => '5950ef3e257855ac1bcdf4a0c64ea5c2'
        ]);

        // $amount = $request->amount;

        $data = $request->all();
        $amount = Sponsor::where('id',$data['sponsor_id'])->pluck('price')->first();

        dd($amount);
        $nonce = $request->payment_method_nonce;
        $name = $user->name;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // if ($result->success) {
        //     $transaction = $result->transaction;
        //     // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        //     // return back()->with('success_message', 'Transaction succesSful. The ID is'. $transaction->id);
        //     $ora = Carbon::now();
        //     $ultimaDataFine = Carbon::parse(Sponsor::where('apartment_id',$request->apartment_id)->pluck('end_date')->sortDesc()->first());
        //     if($ultimaDataFine->greaterThan($ora)){
        //         $request['data_inizio'] = $ultimaDataFine;
        //     } else {
        //         $request['data_inizio'] = $ora;
        //     };
        //     // aggiungo durata alla data inizio e calcolo data fine
        //     $durata = Sponsor::where('id',$request->sponsor_id)->pluck('durata')->first();
        //     $request['data_fine'] = Carbon::parse($request['data_inizio'])->addHours($durata);
        //     // scrivo dati su database e restituisco JSON di risposta
        //     $sponsorApartment = SponsorApartment::create($request->all());
        //     return redirect()->route('apartments.show', $data['apartment_id'])->with('success_message', 'Pagamento effettuato. Transazione n. '. $transaction->id);
        // } else {
        //     $errorString = "";
  
        //     foreach($result->errors->deepAll() as $error) {
        //         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        //     }
  
        //     // $_SESSION["errors"] = $errorString;
        //     // header("Location: " . $baseUrl . "index.php");
        //     return back()->withErrors('An error occured with message '. $result->message);
        // }
    
        if ($result->success) {
            $transaction = $result->transaction;

            
            $order = new Sponsor();
            $data =  $request->all();
    
            return view('users.braintree.checkout')->with('success_message', 'The payment was successfully. The id:'. $transaction->id);
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
