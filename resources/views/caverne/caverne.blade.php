@extends('template')

@section('content')

<!-- // LIEN CREATION CAVERNE // -->
<a href="{{route ('caverne.create')}}" class="btn btn-primary" style="margin-top: 10px">Créer une
    Caverne</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Intro</th>
                <th>histoire</th>
                <th>Voir Contes</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cavernes as $caverne)
            <tr>
                <td>{{ $caverne['image'] }} </td>
                <td>{{ $caverne['titre'] }} </td>
                <td>{{ $caverne['audio'] }} </td>

                <td>{{ $caverne->histoires->count() }}</td>
                <td><a href={{ route('histoirecaverne', $caverne->id) }} class="btn btn-primary">Voir les contes</a></td>
                <td>
                <form action="{{ route('caverne.edit', [$caverne["id"]])}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
                </td>
                <td>
                <form action="">
                        @csrf
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
