@extends('template')

@section('content')
<h1>{{ $caverne->titre }}</h1>
<button type="button" class="btn btn-outline-success"><a class="text-decoration-none text-dark" href="{{ route('histoire.create') }}">Création d une Histoire</a></button>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">titre</th>
        <th scope="col">Intro</th>
        <th scope="col">Audio</th>
        <th scope="col">Note</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
        @if($histoires)
        @foreach ($histoires as $histoire)
      <tr>

        <td>{{ $histoire->image }}</td>
        <td>{{ $histoire->titre }}</td>
        <td>{{ $histoire->intro }}</td>
        <td>{{ $histoire->audio }}</td>
        <td>{{ $histoire->note }}</td>
        <td><a class="btn btn-warning" href={{ route('histoire.edit', $histoire->id )}}>Modifier</a></td>
        <td><form action={{ route('histoire.destroy', $histoire->id) }} method="POST" >
            @csrf
            @method('delete')
          <input type="submit" value="Supprimer" class="btn btn-danger">
         </form></td>

      </tr>

      @endforeach
      @else
          <tr>
              <td colspan="7">Aucune histoire trouvée pour cette caverne.</td>
          </tr>
      @endif

    </tbody>
  </table>














@stop
