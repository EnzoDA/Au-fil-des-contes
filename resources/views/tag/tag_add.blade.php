@extends('template')

@section('content')

<p>Ajouter un tag : </p>
<form method="post" action="{{route('tags.store')}}">
    @csrf

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>

    <div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>    
            <th>
                <p>Titre de l'histoire</p>
            </th>
            <th>
                <p>Associée au tag ?</p>
            </th>
        </thead>
        @foreach ($histoires as $histoire)
        <tr>
            <td>{{ $histoire->titre }}</td>
        
            <td><input type="checkbox" name="histoire_id[]" id="histoire_id" value="{{ $histoire->id }}"></td>
        </tr>
        @endforeach
    </table>
    </div>
    <br>
    <input type="submit" value="Ajouter le tag">
</form>

@stop