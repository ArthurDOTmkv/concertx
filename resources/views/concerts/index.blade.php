@extends('layouts.main')

@section('content')
    @foreach($concerts as $concert)
        <div class="col-md-6">
          <div class="row g-0 border round-0 overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">            
          <div class="col">
                <img src="{{$concert->image}}" alt="" width="100%" height="100%" style="object-fit:cover;" />
            </div>
            <div class="col-8 d-flex flex-column position-static">
              <div class="p-3">
                <strong class="d-inline-block mb-2 text-primary">
                      @foreach($concert->categories as $categorie)
                          {{$categorie->nom}}
                      @endforeach
                </strong>
                <h5 class="mb-3">{{$concert->titre}}</h5>
                <div class="text-left pt-3">
                  <a href="{{route('concerts.show', $concert->slug)}}" class="btn btn-light rounded-0" style="margin-bottom: 10px;">Continuer vers le concert</a>
                </div>
                </div>
            </div>
          </div>
        </div>
   @endforeach
   <!-- Générer les liens de pagination en concervant les slugs
        sans la fonction appends(), les catégories ne sont pas 
        reprises dans l'url
   -->
   {{$concerts->appends(request()->input())->links()}}
@endsection