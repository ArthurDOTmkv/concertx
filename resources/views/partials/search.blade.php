<form class="d-flex" action="{{route('concerts.search')}}">
    <input class="form-control rounded-0" type="text" name="search" value="{{request()->search ?? ''}}" placeholder="Recherche">
    <button class="btn btn-dark rounded-0 d-none" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>