<p>Liste des tags</p>

<a href="{{route('tags.create')}}">
  <button>Ajouter un tag</button>
</a>

<table>
    <tr>
        <th>
            <p>Nom</p>
        </th>
        <th>
            <p>Conte associé</p>
        </th>
    </tr>
    @foreach ($tags as $tag)
    <tr>
        <td>{{$tag->tag_nom}}</td>
        <td>
            <form method="POST" action="{{route('tags.destroy', [$tag ['id']])}}">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>

            </form>
        </td>
        <td><a href="{{route('tags.edit', [$tag ['id']])}}">Modifier</a></td>
    </tr>
    @endforeach
</table>
