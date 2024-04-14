@extends('template')

@section('content')

<div class="container mt-4">
    <h3>Créer une caverne</h3>

    <form action="{{ route('caverne.store') }}" method="POST" enctype="multipart/form-data">
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

<script>
    function updateFileName(inputId) {
        var fileName = document.getElementById(inputId).files[0].name;
        document.getElementById(inputId + 'Label').innerHTML = fileName;
    }
</script>




        <button type="submit" class="btn btn-success">Ajouter cette Caverne</button>
    </form>
</div>
@stop
