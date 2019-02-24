<?php $__env->startSection('title', 'About'); ?>

<?php $__env->startSection('content'); ?>

  <h1>About Us</h1>

  <p>
    We're really cool stuff.
  </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>