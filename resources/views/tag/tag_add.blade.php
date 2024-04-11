@extends('template')

@section('content')

<p>Ajouter un tag : </p>

<form method="post" action="{{route('tags.store')}}">
    @csrf

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>

    <div class="form-inline">
        <input class="form-control form-control-lg" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher" title="Rechercher" name="search">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th>
                        <p>Titre de l'histoire</p>
                    </th>
                    <th>
                        <p>Associée au tag ?</p>
                    </th>
                </tr>
            </thead>
            <tbody id="histoires-table">
                @foreach ($histoires as $histoire)
                <tr onclick="cocherCase(this)">
                    <td>{{ $histoire->titre }}</td>
                    <td><input type="checkbox" name="histoire_id[]" id="histoire_id" value="{{ $histoire->id }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <input type="submit" value="Ajouter le tag">
</form>

<script>
    function searchTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const tableBody = document.getElementById('histoires-table');
        const tableRows = tableBody.querySelectorAll('tr');

        for (let i = 0; i < tableRows.length; i++) {
            const row = tableRows[i];
            const histoireTitle = row.querySelector('td').textContent.toLowerCase();
            const isVisible = histoireTitle.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
        }
    }

    function cocherCase(ligne) {
        const checkbox = ligne.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
    }
</script>

@stop