
@extends('template')

@section('content')
<div class="container mt-4">
    <h3>Créer un mot-clé</h3>

    <form action="{{ route('tag.store') }}" method="POST" >
        @csrf

        <div class="form-group">
            <input type="text" id="tag_nom" name="tag_nom" value="{{ old('tag_nom') }}" class="form-control"/>
            @error('tag_nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Ajouter ce Mot-clé</button>
    </form>
</div>
@stop
