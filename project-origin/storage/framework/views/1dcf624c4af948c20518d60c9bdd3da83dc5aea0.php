<?php $__env->startSection('content'); ?>
  <h1 class="title">Edit Project</h1>
  <form class="" action="/projects/<?php echo e($project->id); ?>" method="POST">
    <?php echo method_field('PATCH'); ?>
    <?php echo csrf_field(); ?>
    <div class="field">
      <label class="label" for="title">Title</label>
      <div class="control">
        <input type="text" name="title" value="<?php echo e($project->title); ?>">
      </div>
    </div clss="field">
    <div class="field">
      <label class="label" for="description">Description</label>
      <div class="control">
        <textarea name="description"><?php echo e($project->description); ?></textarea>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <button type="submit">Update Project</button>
      </div>
    </div>
  </form>

  <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <form class="" action="/projects/<?php echo e($project->id); ?>" method="post">
    <?php echo method_field('DELETE'); ?>
    <?php echo csrf_field(); ?>
    <div class="field">
      <div class="control">
        <button type="submit">Delete Project</button>
      </div>
    </div>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>