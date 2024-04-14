@extends('template')

@section('content')

<!-- // LIEN CREATION CAVERNE // -->
<a href="{{ route('caverne.create') }}" class="btn btn-primary" style="margin-top: 10px">Créer une Caverne</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm text-center"> <!-- Ajout de la classe text-center pour centrer le contenu -->
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Intro</th>
                <th>Histoires</th>
                <th>Voir les Histoires</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
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
                <td style="vertical-align: middle;"><a href="{{ route('histoirecaverne', $caverne->id) }}" class="btn btn-primary">Voir les Histoires</a></td>
                <td style="vertical-align: middle;">
                    <form action="{{ route('caverne.edit', [$caverne["id"]])}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                <form action="{{ route('caverne.destroy', $caverne->id) }}" method="POST">
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
@stop