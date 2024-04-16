
@extends('template')

@section('content')
<div class="container mt-4">
    <h3>Modifier un mot-clé</h3>

    <form action="{{ route('tag.update' , $tag->id) }}" method="POST" >
        @csrf
        @method('put')
        <div class="form-group">
            <label for="tag_nom">Nom</label>
            <input type="text" id="tag_nom" name="tag_nom" value="{{ old('tag_nom', $tag->tag_nom) }}" class="form-control"/>
            @error('tag_nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Modifier ce Mot-clé</button>
    </form>
</div>
@stop