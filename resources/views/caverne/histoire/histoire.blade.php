@extends('template')

@section('content')

<!-- // LIEN CREATION histoire // -->
<h2>
    Voici les histoires associés à la caverne {{ $caverne->titre }}
</h2>
<form action="{{ route('histoire.create', $caverne->id) }}" method="get" class="md-3 mb-3">
    @csrf
    <button type="submit" class="btn btn-primary">Créer une Histoire</button>
</form>
<div class="form-inline md-3 mb-3">
    <input class="form-control form-control-lg" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher" title="Rechercher">
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm text-center" id="myTable"> <!-- Ajout de la classe text-center pour centrer le contenu -->
        <thead>
            <tr>
                <th>Image</th>
                <th>
                <button class="btn btn-link" data-sort="name">Titre<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Intro</th>
                <th>Audio</th>
                <th>
                <button class="btn btn-link" data-sort="name">Note<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>
                <button class="btn btn-link" data-sort="name">Nombre de vues<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Voir le(s) Tag(s)</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histoires as $histoire)
            <tr>
                <td style="vertical-align: middle;"> <!-- Centrer verticalement le contenu de la cellule -->
                    <img src="{{ asset('storage/images/'.$histoire['image']) }}" alt="image" style="height: 100px; width: auto;"> <!-- Ajout des classes img-fluid pour assurer la largeur automatique et fixed-height pour la hauteur fixe -->
                </td>
                <td style="vertical-align: middle;">{{ $histoire->titre }}</td>
                <td style="vertical-align: middle;">
                    <audio controls>
                        <source src="{{ asset('storage/audios/' . $histoire->intro) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </td>
                <td style="vertical-align: middle;">
                    <audio controls>
                        <source src="{{ asset('storage/audios/' . $histoire->audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </td>
                <td style="vertical-align: middle;">{{ $histoire->note }}</td>
                <td style="vertical-align: middle;">{{ $histoire->nb_vue }}</td>
                <td style="vertical-align: middle;">
                <form action="{{ route('histoire.tag.show', $caverne->id)}}" method="get">
                        @csrf
                        <input type="hidden" name="idhistoire" value="{{ $histoire->id }}">
                        <button type="submit" class="btn btn-primary">Voir le(s) Tag(s)</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                    <form action="{{ route('histoire.edit', $caverne->id)}}" method="get">
                        @csrf
                        <input type="hidden" name="idupdate" value="{{ $histoire->id }}">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                <form action="{{ route('histoire.destroy', $caverne->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="iddestroy" value="{{ $histoire->id }}">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $histoires->links('pagination::bootstrap-5') }}
@stop


