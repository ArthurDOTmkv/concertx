@extends('layouts.main')

@section('content')
<h3 class="mb-4 ms-2">{{$concert->titre}}</h3>
<div class="row pb-4">
    <div class="col-3">
        <img src="{{$concert->image}}" style="object-fit:cover;width:100%;"/>
    </div>
    <div class="col-9 ps-4">
        {{$concert->description}}
    </div>
</div>
    @foreach($shows as $show)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-300 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">
                    @foreach($concert->categories as $categorie)
                        {{$categorie->nom}} {{$loop->last ? '' : ' '}}
                    @endforeach
                </strong>
                <div class="mb-2 text-muted">{{$show->moment}}</div>
                <div class="mb-2 text-muted"><b>Prix</b> : {{$show->prix}} €</div>
                
                <!-- Interpréter l'HTML -->
                <p class="mb-4">{!! $concert->description !!}</p>
                <a href="{{ url('/representations/' . $show->id) }}" class='btn btn-light'>Choisir place</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src="{{asset('storage/' . $concert->image)}}" alt="" />
            </div>
            </div>
        </div>
    @endforeach
@endsection