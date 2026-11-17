<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'num' => null,          // kept for backwards compatibility (no longer rendered in v2)
    'eyebrow' => null,      // optional small teal label above the title
    'title' => '',          // plain text (use the slot for rich HTML)
    'subtitle' => null,
    'align' => 'start',     // start | center
    'dark' => false,
    'link' => null,
    'linkText' => 'عرض الكل',
    'id' => null,
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
    'num' => null,          // kept for backwards compatibility (no longer rendered in v2)
    'eyebrow' => null,      // optional small teal label above the title
    'title' => '',          // plain text (use the slot for rich HTML)
    'subtitle' => null,
    'align' => 'start',     // start | center
    'dark' => false,
    'link' => null,
    'linkText' => 'عرض الكل',
    'id' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->class(['kfs-stitle', 'kfs-stitle--center' => $align === 'center', 'kfs-stitle--dark' => $dark])); ?> data-reveal>
    <div class="kfs-stitle__text">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($eyebrow): ?>
            <span class="kfs-stitle__eyebrow"><?php echo e($eyebrow); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <h2 class="kfs-stitle__title" <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>><?php echo e($slot->isEmpty() ? $title : $slot); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
            <p class="kfs-stitle__sub"><?php echo e($subtitle); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($link): ?>
        <a href="<?php echo e($link); ?>" class="kfs-stitle__link">
            <span><?php echo e($linkText); ?></span><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($tools)): ?>
        <div class="kfs-stitle__tools"><?php echo e($tools); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/section-title.blade.php ENDPATH**/ ?>