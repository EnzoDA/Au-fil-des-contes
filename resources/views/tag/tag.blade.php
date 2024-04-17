@extends('template')

@section('content')

<h2>
    Voici tous les mots-clés existants
</h2>
<!-- // LIEN CREATION TAG // -->
<form action="{{ route('tag.create') }}" method="get" class="md-3 mb-3">
    @csrf
    <button type="submit" class="btn btn-primary">Ajouter un mot clé</button>
</form>

<div class="form-inline md-3 mb-3">
    <input class="form-control form-control-lg" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher" title="Rechercher">
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm text-center" id=""> <!-- Ajout de la classe text-center pour centrer le contenu -->
        <thead>
            <tr>
                <th>
                <button class="btn btn-link" data-sort="tag_nom">Nom<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{ $tag['tag_nom'] }}</td>
                
                <td style="vertical-align: middle;">
                    <form method="get" action="{{route('tag.edit', $tag->id)}}" style="vertical-align: middle;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                    <form method="POST" action="{{route('tag.destroy', $tag->id)}}" style="vertical-align: middle;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $tags->links('pagination::bootstrap-5') }}
@stop






