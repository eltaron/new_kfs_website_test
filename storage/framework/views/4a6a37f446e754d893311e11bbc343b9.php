<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['js' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['js' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if (! $__env->hasRenderedOnce('99b8b01b-8c34-482c-8729-3780a3fb7d58')): $__env->markAsRenderedOnce('99b8b01b-8c34-482c-8729-3780a3fb7d58'); ?>
    <?php $__env->startPush('css'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/kfs-portal.css')); ?>?v=<?php echo e(@filemtime(public_path('css/kfs-portal.css'))); ?>">
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($js): ?>
    <?php if (! $__env->hasRenderedOnce('52ef7327-272c-40d6-a9e9-fe6bc805814a')): $__env->markAsRenderedOnce('52ef7327-272c-40d6-a9e9-fe6bc805814a'); ?>
        <?php $__env->startPush('scripts'); ?>
            <script src="<?php echo e(asset('js/kfs-portal.js')); ?>?v=<?php echo e(@filemtime(public_path('js/kfs-portal.js'))); ?>" defer></script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/portal-assets.blade.php ENDPATH**/ ?>