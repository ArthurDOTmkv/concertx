@extends('layouts.main')

@section('script')
    <!-- Inclus la détection de fraude -->
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('meta')
    <!-- En plus du token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="col-md-12">
        <h1>Page de paiement</h1>
        <div class="row">
            <div class="col-md-6">
                <form id="paiement-form" class="my-2" action="{{route('paiement.store')}}" methode="POST">
                    @csrf
                    <div id="card-element">
                        <!-- Elements will create Input elements here-->
                    </div>
                    <div id="card-errors" role="alert">
                        <!-- We'll put the error messages in this element-->
                    </div>
                    <button id='submit' class="btn btn-secondary mt-6 mt-4">Payer {{getPrix(Cart::total())}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        var stripe = Stripe('pk_test_51IbU2DFyQMpZqbpyblriff2lgqkKyVeKFRmQVSFCyFXfxILaItMTgD5LYxlgUWsE4BS0oeWpfqSFBllIv0Qb52TH00FRMZnIEb');
        var elements = stripe.elements();
          
        var style = {
            base: {
              color: "#32325d",
              fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
              fontSmoothing: "antialiased",
              fontSize: "16px",
              "::placeholder": {
                color: "#aab7c4"
              }
            },
            invalid: {
              color: "#fa755a",
              iconColor: "#fa755a"
            }
        };
    
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        
        //Messages en cas de succes/erreur du n° de la carte
        card.on('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
            if (error) {
              displayError.textContent = error.message;
            } else {
              displayError.textContent = '';
            }
        });
        // Soumission du formulaire
        var form = document.getElementById('paiement-form');

        form.addEventListener('submit', function(ev) {
            //Empêche la soumission du formulaire (rechargement de la page)
            ev.preventDefault();    
            // submitButton.disabled = true;
            stripe.confirmCardPayment("{{ $clientSecret }}", {
            payment_method: {
                card: card,
                /*
                billing_details: {
                name: 'Jenny Rosen'
                } 
                */
            }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    // submitButton.disabled() = false;
                    console.log(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        var form = document.getElementById('paiement-form');
                        var url = form.action;
                        var paymentIntent = result.paymentIntent;
                        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                        fetch(
                            url, 
                            {
                            headers : {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain; */*",
                                "X-Requested-with": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })
                        }).then((data) => {
                            console.log(data)
                            if(data.status === 400)
                            {
                                var redirect = '/panier';
                            } else
                            {
                                var redirect = '/paiementreussi';
                            }
                            //form.reset();
                            window.location.href = redirect;
                        }).catch((error) => {
                            console.log(error)
                        })

                    //console.log(result.paymentIntent);
                    }
                }
            });
        });
    </script>
@endsection