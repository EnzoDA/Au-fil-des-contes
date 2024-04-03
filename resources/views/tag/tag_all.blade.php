@extends('template')

@section('content')

<p>Liste des mots clés</p>

<a href="{{route('tags.create')}}" class="btn btn-primary" style="margin-top: 10px">Ajouter un mot clé</a>
<br><br>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>
                <p>Nom</p>
            </th>
            <th>
                <p>Conte associé</p>
            </th>
            <th>
                <p>Modifier</p>
            </th>
            <th>
                <p>Supprimer</p>
            </th>
        </tr>
    </thead>
    @foreach ($tags as $tag)
    <tr>
        <td>{{$tag->tag_nom}}</td>
        <td><form action="{{ route('tags.show', [$tag["id"]])}}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Voir</button>
            </form>
        </td>
        <td>
            <form action="{{ route('tags.edit', [$tag["id"]])}}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </td>
        <td>
            <form method="POST" action="{{route('tags.destroy', [$tag ['id']])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>

            </form>
        </td>
        
    </tr>
    @endforeach
</table>
</div>
@stop