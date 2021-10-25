<?php 

    $total = app('App\Http\Controllers\CartController')->total();

    // Set your secret key. Remember to switch to your live secret key in production.
    // See your keys here: https://dashboard.stripe.com/apikeys
    \Stripe\Stripe::setApiKey('sk_test_51JmKdCLTn5oPDsLLtD3Ki0T4Ntk0cwWsUz0vZWvl3RKXxISGbTkQDSB0yUkgjz6Prjg28LOUtKAWyIJ7BuMtlvS600eIRdtdiJ');

    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $total*100,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'receipt_email' => 'Arthur.a379@gmail.com',
    ]);

    $clientSecret = $paymentIntent->client_secret;

?>

@extends('layouts.main')

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('meta')
    <!-- En plus du token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="col-md-12 mb-5">
        <h1>Page de paiement</h1>
        <div class="row">
            <div class="col-6">
                <form id="paiement-form" class="my-2" action="{{route('paiement.store')}}" methode="POST">                    
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-9">
                            <label class="form-label">Rue</label>
                            <input type="text" class="form-control" name="rue" required>
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label">Numero</label>
                            <input type="text" class="form-control" name="numero" required>
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label">Code postal</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3 col-9">
                            <label class="form-label">Ville</label>
                            <input type="text" class="form-control" name="ville" required>
                        </div>
                        <div id="card-element">
                            <!-- Elements will create Input elements here-->
                        </div>
                        <div id="card-errors" role="alert">
                            <!-- We'll put the error messages in this element-->
                        </div>
                    </div>
                    <button id='submit' class="btn btn-secondary mt-6 mt-4">Payer {{$total}} €</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        // configuration stripe: https://stripe.com/docs/
        var stripe = Stripe('pk_test_51JmKdCLTn5oPDsLLITGzvNwPHeUIrT6nzyaXKtj87rZ5PyLChtbWs924vGgxv5dT11MP2aEtFzexNT9yqoJaNpuL00HGcyfq8c');
        
        var elements = stripe.elements({ clientSecret: '{{$clientSecret}}' });
        var cardElement = elements.create('payment');
        cardElement.mount("#card-element");

        // soumission du formulaire
        var form = document.getElementById('paiement-form');

        //Messages en cas de succes/erreur du n° de la carte
        cardElement.on('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
            if (error) {
              displayError.textContent = error.message;
            } else {
              displayError.textContent = '';
            }
        });

        form.addEventListener('submit', async (e)=> {
            //Empêche la soumission du formulaire (rechargement de la page)
            e.preventDefault();

            // check paiement avec l'api stripe
            const {error} = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{route('paiement.store')}}",
                    }
            });
        });
    </script>
@endsection