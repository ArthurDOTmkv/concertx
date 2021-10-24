@extends('layouts.main')

@section('meta')
    <!-- En plus du token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@if(count($cart) > 0)
    <div class="px-4 px-lg-0">
      <div class="pb-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 p-4 bg-white rounded shadow-sm mb-5">

              <!-- Shopping cart table -->
              <div class="table table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 bg-light">
                        <div class="ps-4 text-uppercase">Concert</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="text-uppercase">Place</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="text-uppercase">Prix</div>
                      </th>
                      <th scope="col" class="border-0 bg-light" width="200px">
                        <div class="text-uppercase">Supprimer</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cart as $row)
                    <tr>
                      <td class="border-0 align-middle">
                        <div class="row">
                          <div class="col-4">
                            <img src="@php echo App\Http\Controllers\CartController::image($row->representation_id) @endphp" alt="concert" style="object-fit:cover;width:100px;height:170px;"/>
                          </div>
                          <div class="col d-flex align-items-center">@php echo App\Http\Controllers\CartController::title($row->representation_id) @endphp</div>
                        </div>
                        </td>
                      <td class="border-0 align-middle">@php echo App\Http\Controllers\CartController::place($row->place_id) @endphp</td>
                      <td class="border-0 align-middle">{{$row->prix}} €</td>
                      <td class="border-0 align-middle">
                      <form action="{{route('remove.from.cart', ['id'=>$row->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class='btn btn-danger text-white'><i class='fa fa-trash'></i></button>
                        </form>
                      </td>                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- End -->
            </div>
          </div>

          <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le vendeur</div>
              <div class="p-4">
                <p class="font-italic mb-4">Si vous avez des informations pour le vendeur, vous pouvez les laisser dans la case ci-dessous</p>
                <textarea name="" cols="30" rows="7" class="form-control" style="resize: none;"></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Aperçu de la commande </div>
              <div class="p-4">
                <ul class="list-unstyled mb-4">
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total de la commande </strong><strong>{{round($total/1.21)}} €</strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">TVA</strong><strong>{{round($total-($total/1.21))}} €</strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                    <h5 class="font-weight-bold">{{$total}} €</h5>
                  </li>
                </ul><a href="{{route('paiement.index')}}" class="btn btn-dark rounded-pill py-2 btn-block">Procéder au paiment</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
@else
<div class="col-md-12">
    <p>Le panier est vide</p>        
</div>
@endif
@endsection

@section('js')
<script>
    var qty = document.querySelectorAll('#qty');
    Array.from(qty).forEach((element)=>{
        element.addEventListener('change', function(){
            var rowId = this.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var places = element.getAttribute('data-places');
            fetch(
                `/panier/${rowId}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain; */*",
                        "X-Requested-with": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    /*
                     * Le nom des méthodes EN MAJUSCULES car les valeurs 
                     * des attributs sont key sensitives sinon erreur "Failed to fetch
                     */
                    method: 'PATCH',
                    body: JSON.stringify({
                        qty: this.value,
                        places: places
                    })
                }).then((data) => {
                    console.log(data);
                    location.reload();
                }).catch((error) => {
                    console.log(error);
                })
        });
    });
    
</script>
@endsection