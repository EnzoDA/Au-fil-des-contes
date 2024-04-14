<p>Liste des tags</p>

<a href="<?php echo e(route('tags.create')); ?>">
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
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($tag->tag_nom); ?></td>
        <td>
            <form method="POST" action="<?php echo e(route('tags.destroy', [$tag ['id']])); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit">Supprimer</button>

            </form>
        </td>
        <td><a href="<?php echo e(route('tags.edit', [$tag ['id']])); ?>">Modifier</a></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/tag/tag_all.blade.php ENDPATH**/ ?>