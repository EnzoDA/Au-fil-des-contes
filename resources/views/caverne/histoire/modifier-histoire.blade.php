@extends('template')

@section('content')

<div class="container mt-4">
    <h3>Modifier une histoire</h3>

    <form action="{{ route('histoire.update', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre', $histoire->titre) }}" class="form-control"/>
            @error('titre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
    <label for="image">Image</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="image" name="image" class="custom-file-input" onchange="updateFileName('image')">
            <label class="custom-file-label" for="image" id="imageLabel">Choisir une nouvelle image</label>
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
            <label class="custom-file-label" for="intro" id="introLabel">Choisir une nouvelle intro</label>
        </div>
    </div>
    @error('audio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
        <div class="form-group">
    <label for="audio">Audio</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="audio" name="audio" class="custom-file-input" onchange="updateFileName('audio')">
            <label class="custom-file-label" for="audio" id="audioLabel">Choisir un nouvel audio</label>
        </div>
    </div>
    @error('audio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
        <input type="hidden" name="idupdate" value="{{ $histoire->id }}">
        <button type="submit" class="btn btn-primary">Modifier cette Histoire</button>
    </form>
</div>
@stop