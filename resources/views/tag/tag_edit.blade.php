@extends('template')

@section('content')

<p>Modifier un tag : </p>
<form method="post" action="{{route('tags.update',$tag->id)}}">
    @csrf
    @method('PUT')

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag" value="{{ $tag->tag_nom }}">
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
        
            <td><input type="checkbox" name="histoire_id[]" id="histoire_id" value="{{ $histoire->id }}"value="{{ $histoire->id }}" @if ($histoire->tags->contains($tag)) checked @endif></td>
            <input type="hidden" name="histoire_id_to_remove[]" value="{{ $histoire->id }}">
        </tr>
        @endforeach
    </table>
    <br>

        <input type="submit" value="Modifier le tag">
</form>

@stop