@extends('template')
@section('content')

<div class="container mt-4">
    <h3>Créer une histoire</h3>

    <form action="{{ route('histoire.store', $id) }}" method="POST" enctype="multipart/form-data">
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
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="image" name="image" class="custom-file-input" onchange="updateFileName('image')">
            <label class="custom-file-label" for="image" id="imageLabel">Choisir l'image</label>
        </div>
    </div>
    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="intro">Intro</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="intro" name="intro" class="custom-file-input" onchange="updateFileName('intro')">
            <label class="custom-file-label" for="intro" id="introLabel">Choisir l'intro</label>
        </div>
    </div>
    @error('intro')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="audio">Audio</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="audio" name="audio" class="custom-file-input" onchange="updateFileName('audio')">
            <label class="custom-file-label" for="audio" id="audioLabel">Choisir l'audio</label>
        </div>
    </div>
    @error('audio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>



<div class="form-group border rounded p-3">
    <label for="tags">Tags</label>
    <div class="row">
        @foreach($tags as $tag)
        <div class="col-md-3">
            <div class="form-check">
                <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" class="form-check-input">
                <label for="tag{{ $tag->id }}" class="form-check-label">{{ $tag->tag_nom }}</label>
            </div>
        </div>
        @endforeach
    </div>
    @error('tags')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>



        <button type="submit" class="btn btn-success">Ajouter cette histoire</button>
    </form>
</div>
@stop
