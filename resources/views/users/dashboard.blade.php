@extends('layouts.app')

@section('content')
<div class="container" id='dashboard'>

    <div class="content">
        <form method="post" id="payment-form" action="#">
            @csrf
            <section>
                <label for="amount">
                    <span class="input-label text-white">Amount</span>
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
    </div>

    <div class="row justify-content-center wrapper">

        <div class="col-12 pb-4">
            <h2>My Dashboard.</h2>
        </div>

        {{-- Profile information --}}
        <div class="col-12 col-md-12 col-lg-6 mb-3 mb-lg-0">
            <div class="card">

                <div class="card-header ">My Profile</div>
                <div class="card-body d-md-flex align-items-center">
                    <div class="col-12 col-md-6 d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ asset('storage/'. $user->profile_picture) }}" alt="" >
                        </div>
                    </div>

                    <div class="user-data col-12 col-md-6">
                        <ul>
                            <li><span>Name:</span> {{ $user->name }}</li>
                            <li><span>Surname:</span> {{ $user->surname }}</li>
                            <li><span>Email:</span> {{ $user->email }}</li>
                            <li><span>Birth date:</span> {{ $user->birth_date }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card-footer">
                    {{-- Button to edit the user profile --}}
                    <a href='{{ route('users.edit', Auth::user()->id) }}' class="btn btn-custom">
                        Edit your profile
                    </a>
                </div>

            </div>
        </div>

        {{-- apartments information --}}
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card">

                <div class="card-header">My Apartments</div>
                <div class="card-body">

                    
                    <ul class="apartment-list">
                        @forelse ($userApartments as $apartment)
                        {{-- @dd($apartment) --}}
                            <li class="list-group-item"><a href="{{ route('users.apartments.show', $apartment['id'] ) }}">{{ ucfirst($apartment['descriptive_title']) }}</a></li>
                        @empty
                            <li class="list-group-item">Insert a new apartment and become a member of our family!</li>
                        @endforelse
                    </ul>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    {{-- Button that show user apartments --}}
                    <a href='{{ route('users.apartments.index')}}' class="btn btn-dark">
                        My Apartments
                    </a>
                    {{-- Button that allow user to insert a new apartment --}}
                    <a href='{{ route('users.apartments.create')}}' class="btn btn-dark">
                        Insert new apartment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
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
