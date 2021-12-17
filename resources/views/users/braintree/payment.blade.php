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


                <div class="form-check mt-4 row w-100 d-flex justify-content-around">
                    
                    <div class="input-wrapper amount-wrapper col-4 text-center">
                        
                        <div class="card">
                            <img src="https://www.psypost.org/wp-content/uploads/2021/09/poor-homeless-sad-man.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="2.99" checked>
                                <label class="form-check-label" for="amount">
                                    Standard - $2.99
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input-wrapper amount-wrapper col-4 text-center">

                        <div class="card">
                            <img src="https://mindbodygreen-res.cloudinary.com/images/w_767,q_auto:eco,f_auto,fl_lossy/org/avocyzq5ejtiuxdyj/woman-looking-angry-or-annoyed.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="5.99">
                                <label class="form-check-label" for="amount">
                                    Gold - $5.99
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="input-wrapper amount-wrapper col-4 text-center">

                        <div class="card">
                            <img src="https://i1.wp.com/maximizeminimalism.com/wp-content/uploads/2020/07/Frugal-Rich-People-7-Secrets-Of-Wealthy-People-Who-Live-Humbly.jpg?fit=1000%2C800&ssl=1" class="card-img-top" alt="">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <input class="form-check-input" type="radio" name="amount" min="1" id="amount" value="9.99">
                                <label class="form-check-label" for="amount">
                                    Platinum - $9.99
                                </label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="bt-drop-in-wrapper d-flex justify-content-center w-100 mt-5">
                    <div class="drop-in-internal-wrapper w-50">
                        <div id="bt-dropin"></div>
                    </div>
                    
                </div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                
                <div class="payment-button d-flex justify-content-center w-100">
                    <div class="payment-button-internal-wrapper w-50">
                        <button class="btn btn-outline-secondary text-white mt-4 w-100" type="submit"><span>Pay</span></button>
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