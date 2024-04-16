

<?php $__env->startSection('content'); ?>
<h2>
    Voici toutes les cavernes existantes
</h2>
<!-- // LIEN CREATION CAVERNE // -->
<form action="<?php echo e(route('caverne.create')); ?>" method="get" class="md-3 mb-3">
    <?php echo csrf_field(); ?>
    <button type="submit" class="btn btn-primary">Créer une Caverne</button>
</form>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm text-center"> <!-- Ajout de la classe text-center pour centrer le contenu -->
        <thead>
            <tr>
                <th>Image</th>
                <th>
                <button class="btn btn-link" data-sort="name">Titre<i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Intro</th>
                <th>
                <button class="btn btn-link" data-sort="name">Histoires <i class="ri-expand-up-down-fill"></i></button>
                </th>
                <th>Voir les Histoires</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php $__currentLoopData = $cavernes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caverne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="vertical-align: middle;"> <!-- Centrer verticalement le contenu de la cellule -->
                    <img src="<?php echo e(asset('storage/images/'.$caverne['image'])); ?>" alt="image" style="height: 100px; width: auto;"> <!-- Ajout des classes img-fluid pour assurer la largeur automatique et fixed-height pour la hauteur fixe -->
                </td>
                <td style="vertical-align: middle;"><?php echo e($caverne['titre']); ?></td>
                <td style="vertical-align: middle;">
                    <audio controls>
                        <source src="<?php echo e(asset('storage/audios/' . $caverne->audio)); ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </td>
                <td style="vertical-align: middle;"><?php echo e($caverne->histoires->count()); ?></td>
                <td style="vertical-align: middle;"><a href="<?php echo e(route('histoire.index', $caverne->id)); ?>" class="btn btn-primary">Voir les Histoires</a></td>
                <td style="vertical-align: middle;">
                    <form action="<?php echo e(route('caverne.edit', $caverne->id)); ?>" method="get" style="vertical-align: middle;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </td>
                <td style="vertical-align: middle;">
                    <form action="<?php echo e(route('caverne.destroy', $caverne->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/caverne/caverne.blade.php ENDPATH**/ ?>