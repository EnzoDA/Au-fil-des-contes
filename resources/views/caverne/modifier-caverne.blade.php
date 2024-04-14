@extends('template')

@section('content')

<div class="container mt-4">
    <h3>Modifier une caverne</h3>

    <form action="{{ route('caverne.update', $caverne->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre', $caverne->titre) }}" class="form-control"/>
            @error('titre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <div class="custom-file">
                <input type="file" id="image" name="image" class="custom-file-input">
                <label class="custom-file-label" for="image">Choisir une nouvelle image</label>
            </div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="audio">Audio</label>
            <div class="custom-file">
                <input type="file" id="audio" name="audio" class="custom-file-input">
                <label class="custom-file-label" for="audio">Choisir un nouvel audio</label>
            </div>
            @error('audio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Modifier cette Caverne</button>
    </form>
</div>
@stop
