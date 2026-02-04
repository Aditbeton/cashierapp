<?php $__env->startSection('title-content'); ?>
<i class="fas fa-home mr-2"></i> Home
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        Content
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mugon-tokas\resources\views/welcome.blade.php ENDPATH**/ ?>