@extends('template')
@section('content')
<title>Création d histoires</title>

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

<form action="{{ route('store_histoire', $caverne->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="{{ old('titre') }}" id="titre">
    @error('titre')
    {{ $message }}
    @enderror
    <div class="mb-3">

        <label class="form-label" for="audio">Sélectionner l&#039intro :</label>
        <input type="file" name="intro" accept="audio/*" id="intro" class="form-control form-control @error('intro') is-invalid @enderror" for="intro">
        <br>
        <label class="form-label" for="image">Sélectionner l&#039image :</label>
        <input type="file" name="image" accept="image/*" id="image" class="form-control form-control @error('image') is-invalid @enderror" for="image">
        <br>
        <label class="form-label" for="audio">Sélectionner l&#039audio :</label>
        <input type="file" name="audio" accept="audio/*" id="audio" class="form-control form-control @error('audio') is-invalid @enderror" for="audio">
        <br>
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('audio')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-inline">
            <input class="form-control form-control-lg" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher un tag" title="Rechercher un tag" name="search">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>
                            <p>Nom</p>
                        </th>
                        <th>
                            <p>Associé à l'histoire ?</p>
                        </th>
                    </tr>
                </thead>
                <tbody id="tags-table">
                    @foreach ($tags as $tag)
                    <tr onclick="cocherCase(this)">
                        <td>{{$tag->tag_nom}}</td>
                        <td><input type="checkbox" name="tag_id[]" id="tag_id" value="{{ $tag->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <input type="submit" value="Créer" class="btn btn-success">

        <script>
            function searchTable() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const tableBody = document.getElementById('tags-table');
                const tableRows = tableBody.querySelectorAll('tr');

                for (let i = 0; i < tableRows.length; i++) {
                    const row = tableRows[i];
                    const tagName = row.querySelector('td').textContent.toLowerCase();
                    const isVisible = tagName.includes(searchTerm);
                    row.style.display = isVisible ? '' : 'none';
                }
            }

            function cocherCase(ligne) {
                const checkbox = ligne.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
        </script>

        @stop