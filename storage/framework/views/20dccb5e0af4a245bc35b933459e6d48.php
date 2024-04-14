
<?php $__env->startSection('content'); ?>
<title>Création d histoires</title>

<h1>Formulaire</h1>
<?php if(Session::has('erreur')): ?>
    <div class="alert alert-danger w-75  m-5" role="alert">
        <?php echo e(session()->get('erreur')); ?>

    </div>
<?php endif; ?>

 <form action="<?php echo e(route('histoire.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="<?php echo e(old('titre')); ?>" id="titre">
        <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <?php echo e($message); ?>

        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <input type="submit" class="btn btn-success" value="Créer">

 </form>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/Histoire/histoire_create.blade.php ENDPATH**/ ?>