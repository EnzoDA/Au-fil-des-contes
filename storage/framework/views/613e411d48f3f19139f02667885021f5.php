

<?php $__env->startSection('content'); ?>

<p>Liste des mots clés</p>

<a href="<?php echo e(route('tags.create')); ?>" class="btn btn-primary" style="margin-top: 10px">Ajouter un mot clé</a>
<br><br>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th>
                <p>Nom</p>
            </th>
            <th>
                <p>Conte associé</p>
            </th>
            <th>
                <p>Modifier</p>
            </th>
            <th>
                <p>Supprimer</p>
            </th>
        </tr>
    </thead>
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($tag->tag_nom); ?></td>
        <td><form action="<?php echo e(route('tags.show', [$tag["id"]])); ?>" method="get">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Voir</button>
            </form>
        </td>
        <td>
            <form action="<?php echo e(route('tags.edit', [$tag["id"]])); ?>" method="get">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </td>
        <td>
            <form method="POST" action="<?php echo e(route('tags.destroy', [$tag ['id']])); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Supprimer</button>

            </form>
        </td>
        
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/tag/tag_all.blade.php ENDPATH**/ ?>