@extends('layouts.main')

@section('content')
    @foreach($shows as $show)
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">
                    <div class="badge rounded-pill bg-primary">{{$places}}</div>
                    @foreach($concert->categories as $categorie)
                        {{$categorie->nom}} {{$loop->last ? '' : ' '}}
                    @endforeach
                </strong>
                <h3 class="mb-2">{{$concert->titre}}</h3>
                <div class="mb-2 text-muted">{{$show->moment}}</div>
                <div class="mb-2 text-muted"><b>Prix</b> : {{$concert->getPrix()}}</div>
                
                <!-- Interpréter l'HTML -->
                <p class="mb-4">{!! $concert->description !!}</p>
                @if($places === 'Disponible')
                    <form action='{{route('cart.store')}}' method='POST'>
                        @csrf
                        <input type='hidden' name='concert_id' value='{{$concert->id}}'>
                        <button class='btn btn-light'>Ajouter au panier</button>
                    </form>
                @endif
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src="{{asset('storage/' . $concert->image)}}" alt="" />
            </div>
            </div>
        </div>
    @endforeach
@endsection