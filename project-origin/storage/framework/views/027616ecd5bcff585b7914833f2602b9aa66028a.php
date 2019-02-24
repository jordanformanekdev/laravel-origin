<?php $__env->startSection('content'); ?>
  <h1>Create a new Project</h1>
  <form class="" action="/projects" method="post">

    <?php echo e(csrf_field()); ?>


    <div>
      <input type="text" name="title" placeholder="Project title" value="<?php echo e(old('title')); ?>" >
    </div>

    <div>
      <textarea name="description" placeholder="Project description" required><?php echo e(old('description')); ?></textarea>
    </div>

    <div>
      <button type="submit">Create Project</button>
    </div>

    <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>