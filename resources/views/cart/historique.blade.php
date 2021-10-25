@extends('layouts.app')

<?php
    use App\Http\Controllers\CartController;
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Historique des commandes</div>

                <div class="card-body">
                    @foreach($historique as $row)
                        <div class="row">
                            <div class="col-12"><b>Date de la réservation:</b> {{$row->created_at}}</div>                             
                            <div class="col-12"><b>Prix total:</b> {{$row->total}} €</div>                            
                            <div class="col-12"><b>Détails de la commande:</b></div> 
                            <div class="col-12 pt-2">
                                @foreach(CartController::getDescriptionData($row->description) as $element)
                                    <p>
                                        <u>Title: </u>{{CartController::title($element->representation_id)}}</br>
                                        <u>Place: </u>{{CartController::place($element->place_id)}}</br>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
