<?php $__env->startSection('title', "Welcome"); ?>

<?php $__env->startSection('content'); ?>

  <h1>My <?php echo e($foo); ?> First Website</h1>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>