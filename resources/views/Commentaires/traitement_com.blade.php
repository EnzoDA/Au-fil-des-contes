@extends('template')
@section('content')
<h2>
  Gestion des commentaires
</h2>
<div class="table-responsive">
  <div class="container ">
    <div class="row row-cols-1 row-cols-md-3 ">
      @foreach($commentaires as $key => $commentaire)
        <div class="col">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">{{ $commentaire->pseudo }}</h5>
              <p class="card-text">{{ $commentaire->commentaire }}</p>
              <div class="d-flex">
              <form  action="{{ route('commentaire.update', $commentaire->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Valider</button>
              </form>
              <form class="ml-2" action="{{ route('commentaire.destroy', $commentaire->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Supprimer</button>
              </form>
            </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>





@stop
