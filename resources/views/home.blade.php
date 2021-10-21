@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Historique des commandes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Afficher toutes les commandes de l'utilistaeur connecté-->
                    @foreach(Auth()->user()->commandes as $commande)
                    <div class="card">
                        <div class="card-header">
                            Commande du {{Carbon\Carbon::parse($commande->paymentCreatedAt)->format('d/m/Y')}} <strong>({{getPrix($commande->montant)}} TVA inclus)</strong>
                        </div>
                        <div class="card-body">
                            <h5><strong>Liste des concerts</strong></h5>
                            @foreach(unserialize($commande->concerts) as $concert)
                            <div><b>Concert :</b> {{$concert[0]}}</div>
                            <div><b>Prix :</b> {{getPrix($concert[1])}}</div>
                            <div><b>Nombre de places :</b> {{$concert[2]}}</div>    
                            </br>
                            @endforeach
                        </div>
                    </div></br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
