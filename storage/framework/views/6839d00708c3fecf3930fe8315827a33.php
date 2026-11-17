<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    // Colour of the area under the wave (CSS colour / var), or "none" for a line-only wave.
    'fill' => 'var(--kfs-ivory)',
    // bottom | top  (top flips the wave so it can sit above a dark footer/section)
    'position' => 'bottom',
    // Slow water drift. Stops automatically with prefers-reduced-motion / "إيقاف الحركة".
    'animated' => true,
    'gold' => false,
    // Thin second wave line behind the main one.
    'back' => true,
]));

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

foreach (array_filter(([
    // Colour of the area under the wave (CSS colour / var), or "none" for a line-only wave.
    'fill' => 'var(--kfs-ivory)',
    // bottom | top  (top flips the wave so it can sit above a dark footer/section)
    'position' => 'bottom',
    // Slow water drift. Stops automatically with prefers-reduced-motion / "إيقاف الحركة".
    'animated' => true,
    'gold' => false,
    // Thin second wave line behind the main one.
    'back' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->class(['kfs-wavebar', 'kfs-wavebar--' . $position, 'is-animated' => $animated, 'is-gold' => $gold])); ?> aria-hidden="true">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($back): ?>
    <svg class="kfs-wavebar__svg kfs-wavebar__svg--back" viewBox="0 0 2880 80" preserveAspectRatio="none" focusable="false">
        <path class="kfs-wavebar__line2" d="M0 34 C240 52 480 52 720 34 S1200 16 1440 34 S1920 52 2160 34 S2640 16 2880 34" />
    </svg>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <svg class="kfs-wavebar__svg" viewBox="0 0 2880 80" preserveAspectRatio="none" focusable="false">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fill !== 'none'): ?>
            <path class="kfs-wavebar__fill" style="fill: <?php echo e($fill); ?>" d="M0 40 C240 10 480 10 720 40 S1200 70 1440 40 S1920 10 2160 40 S2640 70 2880 40 V80 H0Z" />
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <path class="kfs-wavebar__line" d="M0 40 C240 10 480 10 720 40 S1200 70 1440 40 S1920 10 2160 40 S2640 70 2880 40" />
    </svg>
</div>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/wave.blade.php ENDPATH**/ ?>