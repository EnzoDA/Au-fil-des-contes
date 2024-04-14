

<?php $__env->startSection('content'); ?>

<!-- // LIEN CREATION CAVERNE // -->
<a href="<?php echo e(route ('caverne.create')); ?>" class="btn btn-primary" style="margin-top: 10px">Créer une
    Caverne</a>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Intro</th>
                <th>Image</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cavernes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caverne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                <?php echo e($caverne->titre); ?>

                </td>
                <td>
                <img src="<?php echo e(Storage::url('app\public/' . $caverne->audio)); ?>" alt="Caverne Audio">
                </td>
                <td>
                <img src="<?php echo e(asset('storage/' . $caverne->image)); ?>" alt="Caverne Image">
                </td>
                <td>
                <form action="<?php echo e(route('caverne.edit', [$caverne["id"]])); ?>" method="get">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
                </td>
                <td>
                <form action="">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                </td>
            </tr>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/caverne/caverne.blade.php ENDPATH**/ ?>