@extends('template')
@section('content')
<title>Modification d histoires</title>
<h1>Formulaire</h1>
@if(Session::has('erreur'))
    <div class="alert alert-danger w-75  m-5" role="alert">
        {{ session()->get('erreur') }}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-danger w-75  m-5" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

 <form action="{{ route('histoire.update', $histoire->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="{{ $histoire->titre }}" id="titre">
        @error('titre')
        {{ $message }}
        @enderror
    <div class="mb-3">

        <label class="form-label" for="audio">Sélectionner l&#039intro :</label>
        <input type="file" name="intro" accept="audio/*" id="intro" class="form-control form-control @error('intro') is-invalid @enderror" for="intro">
         <audio class="mt-3 mb-2" controls src="{{ asset("storage/audios/intro/" . $histoire->intro) }}"></audio>
        <br>
        <label class="form-label" for="image">Sélectionner l&#039image :</label>
        <input type="file" name="image" accept="image/*" id="image" class="form-control form-control @error('image') is-invalid @enderror" for="image">
            <img class="mt-3 mb-2" src="{{ asset("storage/images/thumbnail/". $histoire->image )}}" alt="Image">
        <br>
        <label class="form-label" for="audio">Sélectionner l&#039audio :</label>
        <input type="file" name="audio" accept="audio/*" id="audio" class="form-control form-control @error('audio') is-invalid @enderror" for="audio">
            <audio class="mt-3" controls src="{{ asset("storage/audios/" . $histoire->audio) }}"></audio>
        <br>
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('audio')
        <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <input type="submit" value="Créer" class="btn btn-success">

</form>

@stop
