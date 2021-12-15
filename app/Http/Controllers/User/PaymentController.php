<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sponsor;
use App\User;

class PaymentController extends Controller
{
    public function process(User $user)
    {
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

    public function checkout()
    {

    }

}
