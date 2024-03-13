@extends('template')

@section('content')

<div class="container mt-4">
    <h3>Créer une caverne</h3>

    <form action="{{ route('caverne.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" class="form-control"/>
            @error('titre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}" class="form-control"/>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="audio">Audio</label>
            <input type="text" id="audio" name="audio" value="{{ old('audio') }}" class="form-control"/>
            @error('audio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Ajouter cette Caverne</button>
    </form>
</div>
@stop
