
<?php $__env->startSection('content'); ?>
<title>Histoires</title>


<button type="button" class="btn btn-outline-success"><a class="text-decoration-none text-dark" href="<?php echo e(route('histoire.create')); ?>">Création d une Histoire</a></button>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $histoires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histoire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>

        <td><?php echo e($histoire->titre); ?></td>
        <td><a class="btn btn-warning" href=<?php echo e(route('histoire.edit', $histoire->id )); ?>>Modifier</a></td>
        <td><form action=<?php echo e(route('histoire.destroy', $histoire->id)); ?> method="POST" >
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
          <input type="submit" value="Supprimer" class="btn btn-danger">
         </form></td>

      </tr>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
  </table>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/Histoire/histoire.blade.php ENDPATH**/ ?>