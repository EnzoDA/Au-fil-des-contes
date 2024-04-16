

<?php $__env->startSection('content'); ?>

<p>Ajouter un tag : </p>

<form method="post" action="<?php echo e(route('tags.store')); ?>">
    <?php echo csrf_field(); ?>

    <p>Nom du tag :
        <input type="text" required name="tag_nom" id="tag_nom" placeholder="Nom du tag">
    </p>

    <div class="form-inline">
        <input class="form-control form-control-lg" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Rechercher" title="Rechercher" name="search">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th>
                        <p>Titre de l'histoire</p>
                    </th>
                    <th>
                        <p>Associée au tag ?</p>
                    </th>
                </tr>
            </thead>
            <tbody id="histoires-table">
                <?php $__currentLoopData = $histoires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histoire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr onclick="cocherCase(this)">
                    <td><?php echo e($histoire->titre); ?></td>
                    <td><input type="checkbox" name="histoire_id[]" id="histoire_id" value="<?php echo e($histoire->id); ?>"></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <br>
    <input type="submit" value="Ajouter le tag">
</form>

<script>
    function searchTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const tableBody = document.getElementById('histoires-table');
        const tableRows = tableBody.querySelectorAll('tr');

        for (let i = 0; i < tableRows.length; i++) {
            const row = tableRows[i];
            const histoireTitle = row.querySelector('td').textContent.toLowerCase();
            const isVisible = histoireTitle.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
        }
    }

    function cocherCase(ligne) {
        const checkbox = ligne.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\AUFILDESCOMPTES\Au-fil-des-comptes\resources\views/tag/tag_add.blade.php ENDPATH**/ ?>