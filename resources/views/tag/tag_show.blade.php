@extends('template')

@section('content')

<p>Information sur le mot clé : ...</p>

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>

    <div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>    
            <th>
                <p>Titre de l'histoire</p>
            </th>
        </thead>
        @foreach ($histoires as $histoire)
        <tr>
            <td>{{ $histoire->titre }}</td>
        </tr>
        @endforeach
    </table>
    </div>

@stop