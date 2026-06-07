<?php $__env->startSection('content'); ?>

<h2>Daftar Kos</h2>

<?php $__currentLoopData = $dataKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div>
        <h3><?php echo e($kos->nama_kos); ?></h3>

        <p>Alamat: <?php echo e($kos->alamat); ?></p>

        <p>Harga Minimum: Rp <?php echo e($kos->harga_min); ?></p>

        <hr>
    </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kayla/Desktop/2nd sem/sisdat prak/project mahaking kos/mahaking-kos/resources/views/kos/index.blade.php ENDPATH**/ ?>