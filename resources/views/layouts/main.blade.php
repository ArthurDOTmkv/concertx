
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    @yield('meta')
    <title>ConcertX - Réservation de places</title>
    
    <!-- Scripts (drop down menu)-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script')

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


<style>
  body{
    background: #e3e3e3;
  }

  .btn-light:hover {
    color: #000;
    background-color: #e0e0e0;
    border-color: #e0e0e0;
}

  .screen{
    background: white;
    height: 100px;
    width:100%;
    transform: rotateX(-45deg);
    margin: 15px 0;
    box-shadow: 0 3px 10px rgba(0,0,0,0.7);
  }

  .place{
    width:40px;
    height:40px;
    border: 1px solid #1a1a1a;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    background: #8c8c8c;
  }

  .place.disabled{
    background: #b53828;
  }

  .place.selected{
    background: #71a62b;
  }


  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

li{
    list-style: none;
}
.blog-header {
  line-height: 1;
  border-bottom: 1px solid #e5e5e5;
}

.blog-header-logo {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif;
  font-size: 2.25rem;
}

.blog-header-logo:hover {
  text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif;
}

.display-4 {
  font-size: 2.5rem;
}
@media (min-width: 768px) {
  .display-4 {
    font-size: 3rem;
  }
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-scroller .nav-link {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
}

.card-img-right {
  height: 100%;
  border-radius: 0 3px 3px 0;
}

.flex-auto {
  -ms-flex: 0 0 auto;
  -webkit-box-flex: 0;
  flex: 0 0 auto;
}

.h-250 { height: 250px; }
@media (min-width: 768px) {
  .h-md-250 { height: 250px; }
}

.border-top { border-top: 1px solid #e5e5e5; }
.border-bottom { border-bottom: 1px solid #e5e5e5; }

.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }

/*
 * Blog name and description
 */
.blog-title {
  margin-bottom: 0;
  font-size: 2rem;
  font-weight: 400;
}
.blog-description {
  font-size: 1.1rem;
  color: #999;
}

@media (min-width: 40em) {
  .blog-title {
    font-size: 3.5rem;
  }
}

/* Pagination */
.blog-pagination {
  margin-bottom: 4rem;
}
.blog-pagination > .btn {
  border-radius: 2rem;
}

/*
 * Blog posts
 */
.blog-post {
  margin-bottom: 4rem;
}
.blog-post-title {
  margin-bottom: .25rem;
  font-size: 2.5rem;
}
.blog-post-meta {
  margin-bottom: 1.25rem;
  color: #999;
}

/*
 * Footer
 */
.blog-footer {
  padding: 2.5rem 0;
  color: #999;
  text-align: center;
  background-color: #f9f9f9;
  border-top: .05rem solid #e5e5e5;
}
.blog-footer p:last-child {
  margin-bottom: 0;
}
</style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->

  </head>
<body>

<div class="container bg-white">
<div id="app">
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">          
        <div class="col-4">
            <a class="blog-header-logo text-dark" href="/"><img src="/images/concertx-logo.jpg" alt="logo" height="70"/></a>
          </div>
          <div class="col-4 text-center">            
              @include('partials.search')
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">            
            @include('partials.auth')
            <a class="link-secondary" href="{{route('cart.index')}}" style="text-decoration:none">Panier  <span class="badge rounded-pill bg-dark">{{Cart::count()}}</span></a>
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach(App\Categorie::all() as $categorie)
                <a class="p-2 link-secondary" href="{{route('concerts.index', ['categorie' => $categorie->slug])}}">{{$categorie->nom}}</a>
            @endforeach
        </nav>
      </div>
    </div>
</div>
      
<main class="container">
@if(session('success'))
    <div class='alert alert-success'>
        {{session('success')}}
    </div>
@endif

@if(session('danger'))
    <div class='alert alert-danger'>
        {{session('danger')}}
    </div>
@endif

@if(count($errors) > 0)
    <div class='alert alert-danger'>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if( Request::get('categorie')=="theatre")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-theatre.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="chanson")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-chanson.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="musique")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-musique.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="cirque")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-cirque.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="film")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-film.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="drame")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-drame.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="film")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-film.jpg) no-repeat center / cover; height:350px;">
  @elseif( Request::get('categorie')=="comedie")
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-comedie.jpg) no-repeat center / cover; height:350px;">
  @else
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark rounded-0" style="background: url(/images/banner-background.jpg) no-repeat center / cover; height:350px;">
  @endif

    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">Let there be live</h1>
      <p class="lead my-3">Your next best-night-ever is waiting.</p>
    </div>
  </div>
@if(request()->input('search'))
    <h6>{{$concerts->total()}} résultat(s) toruvés pour "{{request()->search}}"</h6>
@endif

  <div class="row">
   @yield('content')
  </div>

</main><!-- /.container -->

@yield('js')
<footer class="row blog-footer">
  <p>Bachelier en Informatique de Gestion</p>
  <p>Arthur Khachaturov | <a href="https://www.isfce.org/">https://www.isfce.org/</a></p>
</footer>
</div>
</body>
</html>