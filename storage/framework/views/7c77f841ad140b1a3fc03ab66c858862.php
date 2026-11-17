<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => 'docs',   // docs | search | calendar | map | box | inbox
    'title' => 'لا توجد بيانات حالياً',
    'text' => null,
    'compact' => false,
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
    'icon' => 'docs',   // docs | search | calendar | map | box | inbox
    'title' => 'لا توجد بيانات حالياً',
    'text' => null,
    'compact' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->class(['kfs-empty', 'kfs-empty--compact' => $compact])); ?> role="status">
    <svg class="kfs-empty__art" viewBox="0 0 200 150" width="200" height="150" aria-hidden="true" focusable="false">
        <circle class="e-sun" cx="150" cy="38" r="16" />
        <circle class="e-sun-ring" cx="150" cy="38" r="24" />
        <rect class="e-card" x="46" y="26" width="92" height="96" rx="8" />
        <path class="e-fold" d="M118 26 V44 H138" />
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($icon):
            case ('search'): ?>
                <circle class="e-mark" cx="88" cy="70" r="16" />
                <path class="e-mark" d="M100 82 L114 96" />
                <?php break; ?>
            <?php case ('calendar'): ?>
                <rect class="e-mark" x="66" y="52" width="52" height="46" rx="5" />
                <path class="e-mark" d="M66 64 H118 M78 46 V56 M106 46 V56" />
                <path class="e-gold" d="M78 76 h8 M96 76 h8 M78 86 h8" />
                <?php break; ?>
            <?php case ('map'): ?>
                <path class="e-mark" d="M64 56 L80 50 L104 58 L120 52 V92 L104 98 L80 90 L64 96 Z M80 50 V90 M104 58 V98" />
                <circle class="e-gold-fill" cx="92" cy="70" r="4" />
                <?php break; ?>
            <?php case ('box'): ?>
                <path class="e-mark" d="M66 62 L92 50 L118 62 V90 L92 102 L66 90 Z M66 62 L92 74 L118 62 M92 74 V102" />
                <?php break; ?>
            <?php case ('inbox'): ?>
                <path class="e-mark" d="M64 74 L74 54 H110 L120 74 V96 H64 Z M64 74 H82 L86 82 H98 L102 74 H120" />
                <?php break; ?>
            <?php default: ?>
                <path class="e-mark" d="M64 54 H112 M64 66 H120 M64 78 H104 M64 90 H114" />
                <path class="e-gold" d="M64 104 H90" />
        <?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <path class="e-wave" d="M10 132 C30 122 50 122 70 132 S110 142 130 132 170 122 190 132" />
        <path class="e-wave e-wave--2" d="M24 142 C40 136 56 136 72 142 S104 148 120 142 152 136 176 142" />
    </svg>
    <h3 class="kfs-empty__title"><?php echo e($title); ?></h3>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($text): ?>
        <p class="kfs-empty__text"><?php echo e($text); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slot->isNotEmpty()): ?>
        <div class="kfs-empty__actions"><?php echo e($slot); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/empty-state.blade.php ENDPATH**/ ?>