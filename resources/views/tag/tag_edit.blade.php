<p>Modifier un tag : </p>
<form method="post" action="{{route('tags.update',$tag->id)}}">
    @csrf
    @method('PUT')

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>
    <!-- Ajouter une liste déroulante pour sélectionner l'histoire à laquelle s'applique le tag -->

        <input type="submit" value="Modifier le tag">
</form>