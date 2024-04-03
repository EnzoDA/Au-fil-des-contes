@extends('template')
@section('content')
<title>Modification d histoires</title>
<h1>Formulaire</h1>
@if(Session::has('erreur'))
    <div class="alert alert-danger w-75  m-5" role="alert">
        {{ session()->get('erreur') }}
    </div>
@endif

 <form action="{{ route('histoire.update', $histoire->id) }}" method="POST">
    @method('PUT')
    @csrf
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="{{ $histoire->titre  }}" id="titre">
        @error('titre')
        {{ $message }}
        @enderror
    <input type="submit" class="btn btn-success" value="Modifier">

 </form>


@stop
