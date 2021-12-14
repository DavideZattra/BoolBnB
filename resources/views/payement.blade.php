@extends('layouts.app')

@section('content')

{{-- <div class="content">
    <form method="post" id="payment-form" action="#">
        @csrf
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
</div> --}}
{{-- <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button>

  <script type="text/javascript">
    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
        authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
        selector: '#dropin-container'
        }, function (err, instance) {
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
            // Submit payload.nonce to your server
            });
        })
    });
  </script>
   --}}