@extends('template')

@section('content')
<h2>
    Voici toutes les cavernes existantes
</h2>
<!-- // LIEN CREATION CAVERNE // -->
<form action="{{ route('caverne.create') }}" method="get" class="md-3 mb-3">
    @csrf
    <button type="submit" class="btn btn-primary">Créer une Caverne</button>
</form>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm text-center"> <!-- Ajout de la classe text-center pour centrer le contenu -->
        <thead>
            <tr>
                <th>Image</th>
                <th>
                <button class="btn btn-link" data-sort="name">Titre<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Intro</th>
                <th>
                <button class="btn btn-link" data-sort="name">Histoires <i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Voir les Histoires</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-body">
            @foreach($cavernes as $caverne)
            <tr>
                <td style="vertical-align: middle;"> <!-- Centrer verticalement le contenu de la cellule -->
                    <img src="{{ asset('storage/images/'.$caverne['image']) }}" alt="image" style="height: 100px; width: auto;"> <!-- Ajout des classes img-fluid pour assurer la largeur automatique et fixed-height pour la hauteur fixe -->
                </td>
                <td style="vertical-align: middle;">{{ $caverne['titre'] }}</td>
                <td style="vertical-align: middle;">
                    <audio controls>
                        <source src="{{ asset('storage/audios/' . $caverne->audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </td>
                <td style="vertical-align: middle;">{{ $caverne->histoires->count() }}</td>
                <td style="vertical-align: middle;"><a href="{{ route('histoire.index', $caverne->id) }}" class="btn btn-primary">Voir les Histoires</a></td>
                <td style="vertical-align: middle;">
                    <form action="{{ route('caverne.edit', $caverne->id)}}" method="get" style="vertical-align: middle;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                    <form action="{{ route('caverne.destroy', $caverne->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop


