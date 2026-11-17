<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['width' => 220, 'light' => false]));

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

foreach (array_filter((['width' => 220, 'light' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<svg <?php echo e($attributes->class(['kfs-heritage-orn', 'is-light' => $light])); ?> data-draw viewBox="0 0 220 24" width="<?php echo e($width); ?>" height="<?php echo e(round($width * 24 / 220)); ?>" aria-hidden="true" focusable="false">
    <path pathLength="1" d="M2 10 H86 M2 14 H86 M134 10 H218 M134 14 H218" />
    <path pathLength="1" d="M110 2 L124 12 L110 22 L96 12 Z" />
    <path pathLength="1" d="M110 7 C106 10 106 14 110 17 C114 14 114 10 110 7 Z" />
    <circle cx="90" cy="12" r="2" />
    <circle cx="130" cy="12" r="2" />
</svg>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/heritage.blade.php ENDPATH**/ ?>