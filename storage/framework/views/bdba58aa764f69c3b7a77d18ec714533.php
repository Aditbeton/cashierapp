<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['title', 'icon', 'routes']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['title', 'icon', 'routes']); ?>
<?php foreach (array_filter((['title', 'icon', 'routes']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<li class="nav-item">
    <a href="<?php echo e(route($routes[0])); ?>"
        class="nav-link <?php echo e(in_array(request()->route()->getName(), $routes) ? 'active' : ''); ?>">
        <i class="nav-icon <?php echo e($icon); ?>"></i>
        <p><?php echo e($title); ?></p>
    </a>
</li><?php /**PATH C:\laragon\www\mugon-tokas\resources\views/components/nav-item.blade.php ENDPATH**/ ?>