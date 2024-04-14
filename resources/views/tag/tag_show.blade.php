@extends('template')

@section('content')

<p>Information sur le mot-clé : {{$tag->tag_nom}}</p>

<p>Nom du tag :
    <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag" value="{{ $tag->tag_nom }}">
</p>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <th>
                <p>Titre de l'histoire</p>
            </th>
        </thead>
        @foreach ($tags as $tag)
        <tr>
            <td>{{ $tag->titre }}</td>
        </tr>
        @endforeach
    </table>
</div>

@stop