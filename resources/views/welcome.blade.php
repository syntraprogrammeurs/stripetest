<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>
    <form id="checkout-form" action="/aankopen" method="POST">
    {{csrf_field()}}
        <input type="hidden" name="stripeToken" id="stripeToken">
        <input type="hidden" name="stripeEmail" id="stripeEmail">
        <button type="submit">Betaal</button>

        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script>
            let stripe = StripeCheckout.configure({
                key:"{{config('services.stripe.key')}}",
                image:"https://stripe.com/img/documentation/checkout/marketplace.png",
                locale:"auto",
                token: function(token){
                    document.querySelector('#stripeEmail').value = token.email;
                    document.querySelector('#stripeToken').value = token.id;
                    document.querySelector('#checkout-form').submit();
                }
            });

            document.querySelector('button').addEventListener('click', function(e){
                stripe.open({
                   name:'mijn product',
                   description: 'details over product',
                   zipCode:false,
                   amount: 1000,
                    currency: 'eur',
                });
                e.preventDefault();
            });
        </script>
    </form>
    </body>
</html>
