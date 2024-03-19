@extends('template')
@section('containt')
<title>Création d histoires</title>

<h1>Formulaire</h1>
@if(Session::has('erreur'))
    <div class="alert alert-danger w-75  m-5" role="alert">
        {{ session()->get('erreur') }}
    </div>
@endif

 <form action="{{ route('histoire.store') }}" method="POST">
    @csrf
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="{{ old('titre') }}" id="titre">
        @error('titre')
        {{ $message }}
        @enderror
    <input type="submit" class="btn btn-success" value="Créer">

 </form>


@stop
