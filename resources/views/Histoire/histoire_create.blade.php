@extends('template')
@section('content')
<title>Création d histoires</title>

<h1>Formulaire</h1>
@if(Session::has('erreur'))
    <div class="alert alert-danger w-75  m-5" role="alert">
        {{ session()->get('erreur') }}
    </div>
@endif

 <form action="{{ route('histoire.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="{{ old('titre') }}" id="titre">
        @error('titre')
        {{ $message }}
        @enderror
    <div class="mb-3">

        <label class="form-label" for="audio">Sélectionner l&#039intro :</label>
        <input type="file" name="intro" accept="audio/*" id="intro" class="form-control form-control @error('audio') is-invalid @enderror" for="audio">
        <br>
        <label class="form-label" for="image">Sélectionner l&#039image :</label>
        <input type="file" name="image" accept="image/*" id="image" class="form-control form-control @error('image') is-invalid @enderror" for="image">
        <br>
        <label class="form-label" for="audio">Sélectionner l&#039audio :</label>
        <input type="file" name="audio" accept="audio/*" id="audio" class="form-control form-control @error('audio') is-invalid @enderror" for="audio">
        <br>
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <input type="submit" value="Créer" class="btn btn-success">

</form>


@stop
