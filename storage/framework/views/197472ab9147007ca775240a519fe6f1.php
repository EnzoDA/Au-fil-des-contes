
<?php $__env->startSection('content'); ?>
<title>Histoires</title>



<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Intro</th>
        <th scope="col">Image</th>
        <th scope="col">Audio</th>
        <th scope="col">Note</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $histoires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histoire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>

        <td><?php echo e($histoire->titre); ?></td>
        <td><?php if($histoire->intro == null): ?>
            <button onclick="toggleAudio('<?php echo e(asset("storage/audios/intro/" . $histoire->intro)); ?>')">
                <i class="fas fa-play"></i>
            </button>
        <?php else: ?>
            <p>aucune intro</p>
        <?php endif; ?> </td>
        <td><?php if($histoire->image == null): ?>
            <img src="<?php echo e(asset("images/thumbnail/". $histoire->image )); ?>" alt="Image">
        <?php else: ?>
            <p>aucune image</p>
        <?php endif; ?> </td>
        <td><?php if($histoire->audio == null): ?>
            <button onclick="toggleAudio('<?php echo e(asset("storage/audios/" . $histoire->audio)); ?>')">
                <i class="fas fa-play"></i>
            </button>
        <?php else: ?>
            <p>aucun audio</p>
        <?php endif; ?> </td>
        <td><?php echo e($histoire->note); ?></td>
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


  <script>
    var currentAudio = null;
    var currentAudioPath = null;
    var audioPaused = false;
    var audioPosition = 0;

    function toggleAudio(audioPath) {
        if (currentAudio !== null && currentAudioPath === audioPath) {
            if (audioPaused) {
                currentAudio.play();
                audioPaused = false;
            } else {
                currentAudio.pause();
                audioPaused = true;
                audioPosition = currentAudio.currentTime;
            }
        } else {
            if (currentAudio !== null) {
                currentAudio.pause();
            }
            currentAudio = new Audio(audioPath);
            currentAudioPath = audioPath;
            currentAudio.currentTime = audioPosition;
            currentAudio.play();
            audioPaused = false;
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/Histoire/histoire.blade.php ENDPATH**/ ?>