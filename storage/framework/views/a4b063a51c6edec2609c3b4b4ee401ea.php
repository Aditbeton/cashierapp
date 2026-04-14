<?php $__env->startSection('title-content'); ?>
    <i class="fas fa-home mr-2"></i> Beranda
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
            <?php if (isset($component)) { $__componentOriginalb823c3edc6fddf766a702863b793dcc6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb823c3edc6fddf766a702863b793dcc6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.box','data' => ['title' => 'User','icon' => 'fas fa-user-tie','background' => 'bg-danger','route' => route('user.index'),'jumlah' => $user->jumlah]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'User','icon' => 'fas fa-user-tie','background' => 'bg-danger','route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.index')),'jumlah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->jumlah)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $attributes = $__attributesOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $component = $__componentOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__componentOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalb823c3edc6fddf766a702863b793dcc6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb823c3edc6fddf766a702863b793dcc6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.box','data' => ['title' => 'Kategori','icon' => 'fas fa-list','background' => 'bg-warning','route' => route('kategori.index'),'jumlah' => $kategori->jumlah]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kategori','icon' => 'fas fa-list','background' => 'bg-warning','route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('kategori.index')),'jumlah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kategori->jumlah)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $attributes = $__attributesOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $component = $__componentOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__componentOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
        <?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalb823c3edc6fddf766a702863b793dcc6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb823c3edc6fddf766a702863b793dcc6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.box','data' => ['title' => 'Pelanggan','icon' => 'fas fa-users','background' => 'bg-primary','route' => route('pelanggan.index'),'jumlah' => $pelanggan->jumlah]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pelanggan','icon' => 'fas fa-users','background' => 'bg-primary','route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('pelanggan.index')),'jumlah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pelanggan->jumlah)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $attributes = $__attributesOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $component = $__componentOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__componentOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalb823c3edc6fddf766a702863b793dcc6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb823c3edc6fddf766a702863b793dcc6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.box','data' => ['title' => 'Produk','icon' => 'fas fa-box-open','background' => 'bg-success','route' => route('produk.index'),'jumlah' => $produk->jumlah]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Produk','icon' => 'fas fa-box-open','background' => 'bg-success','route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('produk.index')),'jumlah' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($produk->jumlah)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $attributes = $__attributesOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__attributesOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb823c3edc6fddf766a702863b793dcc6)): ?>
<?php $component = $__componentOriginalb823c3edc6fddf766a702863b793dcc6; ?>
<?php unset($__componentOriginalb823c3edc6fddf766a702863b793dcc6); ?>
<?php endif; ?>
    </div>
    <div class="card">
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        var ctx = document.getElementById('myChart').getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $cart['labels'] ?>,
                datasets: [{
                    label: "<?php echo e($cart['label']); ?>",
                    data: <?= $cart['data'] ?>,
                    borderWidth: 3,
                    borderColor: 'white',
                    backgroundColor: 'rgb(0, 0, 255, 0.3)',
                    fill: true
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mugon-tokas\resources\views/welcome.blade.php ENDPATH**/ ?>