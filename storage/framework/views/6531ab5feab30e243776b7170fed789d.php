<p>Ajouter un tag : </p>
<form method="post" action="<?php echo e(route('tags.store')); ?>">
    <?php echo csrf_field(); ?>

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>
    <!-- Ajouter une liste déroulante pour sélectionner l'histoire à laquelle s'applique le tag -->

        <input type="submit" value="Ajouter le tag">
</form><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/tag/tag_add.blade.php ENDPATH**/ ?>