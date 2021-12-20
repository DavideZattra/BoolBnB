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

        <div class="content container-flex p-4">
            <h3 class="text-center text-white pb-1">Choose your sponsorship:</h3>
            <form method="post" id="payment-form" action="{{route('users.braintree.checkout', $apartment)}}">
                @csrf 

                <div class="form-check mt-4 p-0 row d-flex justify-content-center">
                    <div class="input-wrapper amount-wrapper col-12 col-md-6 col-lg-3 text-center">
                        
                        <div class="card murphy-card">
                            <img class="murphy" src="https://www.noidegli8090.com/wp-content/uploads/2017/12/una-poltrona-per-due-eddie-murphy-1.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="2.99" checked>
                                <label class="form-check-label" for="amount">
                                    Standard - $2.99
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input-wrapper amount-wrapper col-12 col-md-6 col-lg-3 text-center mt-5 mt-md-0">

                        <div class="card murphy-card">
                            <img class="murphy" src="https://www.nonsonsolofilm.it/wp-content/uploads/2020/11/Una-poltrona-per-due-Trading-Places-John-Landis-Dan-Aykroyd-Eddie-Murphy-Jamie-Lee-Curtis-Ralph-Bellamy-Don-Ameche.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="5.99">
                                <label class="form-check-label" for="amount">
                                    Gold - $5.99
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input-wrapper amount-wrapper col-12 col-md-6 col-lg-3 text-center mt-5 mt-lg-0">

                        <div class="card murphy-card">
                            <img class="murphy" src="https://i.ytimg.com/vi/FpYHwjqf22Y/maxresdefault.jpg" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="9.99">
                                <label class="form-check-label" for="amount">
                                    Platinum - $9.99
                                </label>
                            </div>
                        </div>
                    </div>
                    <p class="text-white payment-text col-12 col-md-8 px-lg-5 pt-5">Sponsorships help your business increase its credibility and visibility, improve its public image, and build prestige. 
                        Like any form of marketing, it should be used strategically as a way to reach your target customers.
                        <br>Our LUXINN team is always up to date with the newest marketing strategies, 
                        so that our sponsorships are always the upgraded following the newest trends. 
                    </p>
                </div>
                
                <div class="bt-drop-in-wrapper d-flex justify-content-center w-100 mt-3">
                    <div class="drop-in-internal-wrapper w-lg-50">
                        <div id="bt-dropin"></div>
                    </div>
                </div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                
                <div class="payment-button d-flex justify-content-center w-100">
                    <div class="payment-button-internal-wrapper">
                        <button class="btn btn-custom mt-4" type="submit"><span>Pay</span></button>
                    </div>
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