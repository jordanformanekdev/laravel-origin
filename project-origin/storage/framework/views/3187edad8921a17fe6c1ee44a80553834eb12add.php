<?php $__env->startSection('content'); ?>

  <div>
    <?php echo e($project->title); ?>

  </div>

  <div>
    <?php echo e($project->description); ?>

  </div>

  <div class="content">
    <a href="/projects/<?php echo e($project->id); ?>/edit">
      Edit
    </a>
  </div>

  <?php if($project->tasks->count()): ?>
  <div>
    <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <form method="POST" action="/tasks/<?php echo e($task->id); ?>">
        <?php echo method_field('PATCH'); ?>
        <?php echo csrf_field(); ?>
        <label class="checkbox" for="completed">
          <input
            type="checkbox"
            name="completed"
            onChange="this.form.submit()"
            <?php echo e($task->completed ? 'checked' : ''); ?>>
          <?php echo e($task->description); ?>

        </label>
      </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php endif; ?>

  <form class="box" action="/projects/<?php echo e($project->id); ?>/tasks" method="POST">
    <?php echo csrf_field(); ?>
    <label for="description">New Task</label>
    <div class="control">

      <input type="text" class="input" name="description" placeholder="New Task" required>

    </div>
    <div class="field">

      <div class="control">
        <button type="submit" class="button is-link">Add Task</button>
      </div>

    </div>
  </form>

  <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>