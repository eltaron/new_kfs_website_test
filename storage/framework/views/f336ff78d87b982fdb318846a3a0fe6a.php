<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['size' => 64]));

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

foreach (array_filter((['size' => 64]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<svg <?php echo e($attributes->class(['kfs-lotus'])); ?> data-draw viewBox="0 0 64 64" width="<?php echo e($size); ?>" height="<?php echo e($size); ?>" aria-hidden="true" focusable="false">
    <path pathLength="1" d="M32 54 C24 44 22 30 32 12 C42 30 40 44 32 54 Z" />
    <path pathLength="1" d="M32 54 C22 50 12 40 10 26 C20 30 28 38 32 54 Z" />
    <path pathLength="1" d="M32 54 C42 50 52 40 54 26 C44 30 36 38 32 54 Z" />
    <path pathLength="1" d="M14 58 H50" />
</svg>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/lotus.blade.php ENDPATH**/ ?>