<?php $__env->startSection('content'); ?>

<h2>Register</h2>

<form>

    <input type="text" placeholder="Nama">

    <br><br>

    <input type="email" placeholder="Email">

    <br><br>

    <input type="password" placeholder="Password">

    <br><br>

    <select>
        <option>User</option>
        <option>Pemilik</option>
    </select>

    <br><br>

    <button type="submit">Register</button>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kayla/Desktop/2nd sem/sisdat prak/project mahaking kos/mahaking-kos/resources/views/auth/register.blade.php ENDPATH**/ ?>