@extends('template')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<h1>{{ $caverne->titre }}</h1>
<button type="button" class="btn btn-outline-success"><a class="text-decoration-none text-dark" href="{{ route('createhistoire', $caverne->id) }}">Création d une Histoire</a></button>
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
            <td><img src="{{ asset("storage/images/thumbnail/". $histoire->image )}}" alt="Image"></td>
            <td>{{ $histoire->titre }}</td>
            <td>
                <button onclick="toggleAudio('{{ asset("storage/audios/intro/" . $histoire->intro) }}')">
                    <i class="fas fa-play"></i>
                </button>
            </td>
            <td>
                <button onclick="toggleAudio('{{ asset("storage/audios/" . $histoire->audio) }}')">
                    <i class="fas fa-play"></i>
                </button>
            </td>
            <td>{{ $histoire->note }}</td>
            <td><a class="btn btn-warning" href={{ route('histoire.edit', $histoire->id )}}>Modifier</a></td>
            <td>
                <form action={{ route('histoire.destroy', $histoire->id) }} method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7">Aucune histoire trouvée pour cette caverne.</td>
        </tr>
        @endif
    </tbody>

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
