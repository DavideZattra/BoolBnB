@extends('layouts.app')

@section('content')

    <div class="container">
        <form id="payment-form" action="#" method="post">
            <!-- Putting the empty container you plan to pass to
            `braintree.dropin.create` inside a form will make layout and flow
            easier to manage -->
            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>
    </div>

 @endsection

 @section('scripts-entrypoint')

    <script type="text/javascript">

        const form = document.getElementById('payment-form');
        // Step two: create a dropin instance using that container (or a string
        //   that functions as a query selector such as `#dropin-container`)
        braintree.dropin.create({
            container: document.getElementById('dropin-container'),
            authorization: CLIENT_TOKEN_FROM_SERVER,
            container: '#dropin-container'
            }, 
            
            (error, dropinInstance) => {

            if (error) console.error(error);

            form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.getElementById('nonce').value = payload.nonce;
            form.submit();
                });
            });
        });

    </script>

 @endsection