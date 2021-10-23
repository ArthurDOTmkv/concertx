@extends('layouts.main')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <script>
        var selectedSeats = [];

        // appel fonction
        function toggle( xVal, yVal, element){
            // if deja vert
            if(selectedSeats.find(object=>object.x==xVal && object.y==yVal)){

                // retire object de l'arr pour envoyer au back-end
                selectedSeats = [...selectedSeats.filter( e => JSON.stringify(e) !== '{"x":'+ xVal + ',"y":'+yVal+'}' )];
                console.log(selectedSeats);
                
                // enleve class de l'element
                element.classList.remove("selected");

            // if gris
            }else{            
                selectedSeats.push({ x: xVal, y: yVal });
                element.classList.add("selected");  
            }
        };

        function envoyer(){
            console.log(JSON.stringify(selectedSeats));
            fetch('/reservation',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify(selectedSeats)
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch((error) => {
                console.error('Error:', error);
            });
        };
    </script>

    <h3 class="mb-4 ms-2">Choisir une place:</h3>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12 px-5" style="perspective:5000px">
                <div class="screen"></div>
            </div>
        </div>
        @for ($x = 1; $x <= 10; $x++)
            <div class="row">
                @for ($y = 1; $y <= 15; $y++)
                <?php
                    $dispo=true;
                    foreach($indisponible as $place){
                        if($place["rangee"]==$x && $place["colonne"]==$y){
                            $dispo=false;
                        }
                    }
                ?>
                    @if($dispo)
                        <div class="col d-flex justify-content-center mb-2"><div class="place" onclick="toggle({{$x}},{{$y}}, this)">{{$x}},{{$y}}</div></div>
                    @else
                        <div class="col d-flex justify-content-center mb-2"><div class="place disabled"></div></div>
                    @endif
                @endfor
            </div>
        @endfor
        <div class="row d-flex justify-content-end">
            <div class="col-4 text-end">
                <button class="btn btn-light rounded-0 my-3 d-inline-block" onclick="envoyer()">Ajouter au panier</button>
            </div>
        </div>
    </div>
    

@endsection