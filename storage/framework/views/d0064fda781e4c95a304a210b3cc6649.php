<?php $__env->startSection('content'); ?>

<h2>Daftar Kamar</h2>

<?php $__currentLoopData = $dataKamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div>
        <p>ID Kamar: <?php echo e($kamar->id_kamar); ?></p>

        <p>Harga per bulan: Rp <?php echo e($kamar->harga_per_bulan); ?></p>

        <hr>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kayla/Desktop/2nd sem/sisdat prak/project mahaking kos/mahaking-kos/resources/views/kamar/index.blade.php ENDPATH**/ ?>