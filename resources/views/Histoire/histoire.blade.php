@extends('template')
@section('content')
<title>Histoires</title>



<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Intro</th>
        <th scope="col">Image</th>
        <th scope="col">Audio</th>
        <th scope="col">Note</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($histoires as $histoire)
      <tr>

        <td>{{ $histoire->titre }}</td>
        <td>@if ($histoire->intro == null)
            <button onclick="toggleAudio('{{ asset("storage/audios/intro/" . $histoire->intro) }}')">
                <i class="fas fa-play"></i>
            </button>
        @else
            <p>aucune intro</p>
        @endif </td>
        <td>@if ($histoire->image == null)
            <img src="{{ asset("images/thumbnail/". $histoire->image )}}" alt="Image">
        @else
            <p>aucune image</p>
        @endif </td>
        <td>@if ($histoire->audio == null)
            <button onclick="toggleAudio('{{ asset("storage/audios/" . $histoire->audio) }}')">
                <i class="fas fa-play"></i>
            </button>
        @else
            <p>aucun audio</p>
        @endif </td>
        <td>{{ $histoire->note }}</td>
        <td><a class="btn btn-warning" href={{ route('histoire.edit', $histoire->id )}}>Modifier</a></td>
        <td><form action={{ route('histoire.destroy', $histoire->id) }} method="POST" >
            @csrf
            @method('delete')
          <input type="submit" value="Supprimer" class="btn btn-danger">
         </form></td>

      </tr>

      @endforeach

    </tbody>
  </table>


  <script>
    var currentAudio = null;
    var currentAudioPath = null;
    var audioPaused = false;
    var audioPosition = 0;

    function toggleAudio(audioPath) {
        if (currentAudio !== null && currentAudioPath === audioPath) {
            if (audioPaused) {
                currentAudio.play();
                audioPaused = false;
            } else {
                currentAudio.pause();
                audioPaused = true;
                audioPosition = currentAudio.currentTime;
            }
        } else {
            if (currentAudio !== null) {
                currentAudio.pause();
            }
            currentAudio = new Audio(audioPath);
            currentAudioPath = audioPath;
            currentAudio.currentTime = audioPosition;
            currentAudio.play();
            audioPaused = false;
        }
    }
</script>

@stop
