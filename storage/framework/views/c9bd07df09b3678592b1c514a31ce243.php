<?php $__env->startSection('content'); ?>

<h2>Login</h2>

<form>

    <input type="text" placeholder="Email / No HP">

    <br><br>

    <input type="password" placeholder="Password">

    <br><br>

    <button type="submit">Login</button>

</form>

<p>Belum punya akun?</p>

<a href="/register">Register</a>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kayla/Desktop/2nd sem/sisdat prak/project mahaking kos/mahaking-kos/resources/views/auth/login.blade.php ENDPATH**/ ?>