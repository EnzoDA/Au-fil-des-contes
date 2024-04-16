@extends('template')
@section('content')
<div class="container">
    <h2>Tags associés à l'histoire {{$histoire->titre}}</h2>
    <div id="associatedTags" class="mt-4">
        @foreach($histoire->tags as $tag)
        <span class="badge badge-primary mr-2 tag-badge" data-tag-id="{{$tag->id}}">
            {{$tag->tag_nom}} <button type="button" class="btn btn-sm btn-danger" onclick="removeTag('{{$tag->id}}')"><i class="ri-close-fill"></i></button>
        </span>
        @endforeach
    </div>

    <h3 class="mt-4">Tous les tags</h3>
    <div id="allTags" class="mt-2">
        @foreach($tags as $tag)
        <span class="badge badge-secondary mr-2 tag-badge" data-tag-id="{{$tag->id}}">
            {{$tag->tag_nom}} <button type="button" class="btn btn-sm btn-success" onclick="addTag('{{$tag->id}}')"><i class="ri-add-fill"></i></button>
        </span>
        @endforeach
    </div>

    <button id="updateTagsBtn" class="btn btn-primary mt-4" style="display: none;">Mettre à jour les tags</button>
    
    <form id="updateTagsForm" method="POST" action="{{ route('histoire.tag.update', $id) }}" style="display: none;">
        @csrf
        <input type="hidden" name="idhistoire" value="{{$histoire->id}}">
        <input type="hidden" name="tags" id="selectedTagsInput">
    </form>
</div>

<script>
    // Fonction pour ajouter un tag à la liste des tags associés
    function addTag(tagId) {
        var tagElement = document.querySelector('#allTags span[data-tag-id="' + tagId + '"]');
        var tagName = tagElement.textContent.trim();
        var tagBadge = '<span class="badge badge-primary mr-2 tag-badge" data-tag-id="' + tagId + '">' + tagName + ' <button type="button" class="btn btn-sm btn-danger" onclick="removeTag(' + tagId + ')"><i class="ri-close-fill"></i></button></span>';
        document.querySelector('#associatedTags').insertAdjacentHTML('beforeend', tagBadge);
        tagElement.remove();
        updateButtons(); // Met à jour les boutons après avoir ajouté un tag
        updateTagsInput(); // Met à jour les tags dans le champ de formulaire
    }

    // Fonction pour supprimer un tag de la liste des tags associés
    function removeTag(tagId) {
        var tagElement = document.querySelector('#associatedTags span[data-tag-id="' + tagId + '"]');
        var tagName = tagElement.textContent.trim();
        var tagBadge = '<span class="badge badge-secondary mr-2 tag-badge" data-tag-id="' + tagId + '">' + tagName + ' <button type="button" class="btn btn-sm btn-success" onclick="addTag(' + tagId + ')"><i class="ri-add-fill"></i></button></span>';
        document.querySelector('#allTags').insertAdjacentHTML('beforeend', tagBadge);
        tagElement.remove();
        updateButtons(); // Met à jour les boutons après avoir supprimé un tag
        updateTagsInput(); // Met à jour les tags dans le champ de formulaire
    }

    // Fonction pour mettre à jour les boutons d'ajout et de suppression en fonction des listes de tags
    function updateButtons() {
        var associatedTags = document.getElementById('associatedTags').querySelectorAll('.tag-badge');
        var allTags = document.getElementById('allTags').querySelectorAll('.tag-badge');
        
        associatedTags.forEach(function(tag) {
            tag.querySelector('button').innerHTML = '<i class="ri-close-fill"></i>';
        });

        allTags.forEach(function(tag) {
            tag.querySelector('button').innerHTML = '<i class="ri-add-fill"></i>';
        });

        // Afficher le bouton "Mettre à jour les tags" s'il y a eu une modification
        var updateTagsBtn = document.getElementById('updateTagsBtn');
        var updateTagsForm = document.getElementById('updateTagsForm');

        if (associatedTags.length !== {{$histoire->tags->count()}} || allTags.length !== {{$tags->count()}}) {
            updateTagsBtn.style.display = 'block';
            updateTagsForm.style.display = 'block';
        } else {
            updateTagsBtn.style.display = 'none';
            updateTagsForm.style.display = 'none';
        }
    }

    // Appel initial pour mettre à jour les boutons lors du chargement de la page
    updateButtons();

    // Soumettre le formulaire pour mettre à jour les tags
    document.getElementById('updateTagsBtn').addEventListener('click', function() {
        var selectedTags = [];
        var associatedTags = document.getElementById('associatedTags').querySelectorAll('.tag-badge');

        associatedTags.forEach(function(tag) {
            selectedTags.push(tag.getAttribute('data-tag-id'));
        });

        // Convertir les tags en chaîne JSON
        var tagsJSON = JSON.stringify(selectedTags);

        // Mettre à jour la valeur du champ de formulaire avec les tags en chaîne JSON
        document.getElementById('selectedTagsInput').value = tagsJSON;

        // Soumettre le formulaire
        document.getElementById('updateTagsForm').submit();
    });
</script>

@stop
