@extends('layouts.app')

@section('content')
    
    <section class="bg-container">
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
      
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content container-flex p-5">
            <form method="post" id="payment-form" action="{{route('users.braintree.checkout', $apartment)}}">
                @csrf 


                <div class="form-check mt-4 row w-100 d-flex justify-content-between">
                    
                    <div class="input-wrapper amount-wrapper col-4 text-center">

                        <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="2.99" checked>
                        <label class="form-check-label text-white" for="amount">
                            Standard - $2.99
                        </label>
                    </div>

                    <div class="input-wrapper amount-wrapper col-4 text-center">
                        <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="5.99">
                        <label class="form-check-label text-white" for="amount">
                            Gold - $5.99
                        </label>
                    </div>

                    <div class="input-wrapper amount-wrapper col-4 text-center">
                        <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="9.99">
                        <label class="form-check-label text-white" for="amount">
                            Platinum - $9.99
                        </label>
                    </div>
                    
                </div>
                
                <div class="bt-drop-in-wrapper d-flex justify-content-center w-100 mt-5">
                    <div id="bt-dropin"></div>
                </div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />

                <div class="payment-button w-100 d-flex justify-content-center">
                    <button class="btn btn-outline-secondary text-white mt-4" type="submit"><span>Pay</span></button>
                </div>
                
            </form>
        </div>
    </section>
    

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          // paypal: {
          //   flow: 'vault'
          // }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
 @endsection