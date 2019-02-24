<?php $__env->startComponent('mail::message'); ?>

#New project: <?php echo e($project->title); ?>


<?php echo e($project->description); ?>



<?php $__env->startComponent('mail::button', ['url' => url('/projects/' . $project->id)]); ?>
View Project
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
