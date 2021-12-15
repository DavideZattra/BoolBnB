@extends('layouts.app')

@section('content')

<div class="content text-danger">
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

    <form method="post" id="payment-form" action="{{ route('users.braintree.checkout') }}">
        @csrf
        <label for="amount">
            <span class="input-label">Amount</span>
            <div class="input-wrapper amount-wrapper">
                {{-- @foreach ($sponsors as $sponsor) --}}
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                {{-- @endforeach --}}
            </div>
        </label>
        <div id="dropin-container"></div>
        <input type="submit" />
        <input type="hidden" id="nonce" name="payment_method_nonce"/>
    </form>
</div>


@endsection


@section('scripts-entrypoint')

<script>
    let form = document.querySelector('#payment-form');
    let client_token = "{{ $clientToken }}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#dropin-container'
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