

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h3>Modifier une caverne</h3>

    <form action="<?php echo e(route('caverne.update', $caverne->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?php echo e(old('titre', $caverne->titre)); ?>" class="form-control"/>
            <?php $__errorArgs = ['titre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
    <label for="image">Image</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="image" name="image" class="custom-file-input" onchange="updateFileName('image')">
            <label class="custom-file-label" for="image" id="imageLabel">Choisir une nouvelle image</label>
        </div>
    </div>
    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-danger"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

        <div class="form-group">
    <label for="audio">Audio</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" id="audio" name="audio" class="custom-file-input" onchange="updateFileName('audio')">
            <label class="custom-file-label" for="audio" id="audioLabel">Choisir un nouvel audio</label>
        </div>
    </div>
    <?php $__errorArgs = ['audio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-danger"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

        <button type="submit" class="btn btn-primary">Modifier cette Caverne</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/caverne/modifier-caverne.blade.php ENDPATH**/ ?>