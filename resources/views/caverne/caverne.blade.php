@extends('template')

@section('content')

<!-- // LIEN CREATION CAVERNE // -->
<a href="{{route ('caverne.create')}}" class="btn btn-primary" style="margin-top: 10px">Créer une
    Caverne</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Intro</th>
                <th>Image</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cavernes as $caverne)
            <tr>
                <td>{{ $caverne['titre'] }} </td>
                <td>{{ $caverne['audio'] }} </td>
                <td>{{ $caverne['image'] }} </td>
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