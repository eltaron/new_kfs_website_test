<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'subtitle' => null,     // lead paragraph under the title (alias: lead)
    'lead' => null,
    'image' => null,        // optional background photo URL — sits under the dark-green identity overlay
    'kicker' => null,       // small gold label above the title (alias: eyebrow)
    'eyebrow' => null,
    'icon' => null,         // optional Font Awesome class shown in a soft square
    'crumbs' => [],         // after «الرئيسية»: ['label' => 'url-or-null', ...]  or  [['label', 'url-or-null'], ...]
    'current' => null,      // breadcrumb label for the current page (defaults to the title, trimmed)
    'size' => 'default',    // default | compact (forms, dashboards, auth) | detail (articles, records)
    'wave' => true,         // static wave base (gold line + page-colour fill)
    'waveFill' => 'var(--kfs-page-bg, var(--kfs-bg))',
    'container' => 'container', // wrapper class (e.g. "mkt-container" inside the store)
    'tag' => 'header',
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
    'title' => '',
    'subtitle' => null,     // lead paragraph under the title (alias: lead)
    'lead' => null,
    'image' => null,        // optional background photo URL — sits under the dark-green identity overlay
    'kicker' => null,       // small gold label above the title (alias: eyebrow)
    'eyebrow' => null,
    'icon' => null,         // optional Font Awesome class shown in a soft square
    'crumbs' => [],         // after «الرئيسية»: ['label' => 'url-or-null', ...]  or  [['label', 'url-or-null'], ...]
    'current' => null,      // breadcrumb label for the current page (defaults to the title, trimmed)
    'size' => 'default',    // default | compact (forms, dashboards, auth) | detail (articles, records)
    'wave' => true,         // static wave base (gold line + page-colour fill)
    'waveFill' => 'var(--kfs-page-bg, var(--kfs-bg))',
    'container' => 'container', // wrapper class (e.g. "mkt-container" inside the store)
    'tag' => 'header',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $lead = $subtitle ?? $lead;
    $kicker = $kicker ?? $eyebrow;
    $size = in_array($size, ['default', 'compact', 'detail'], true) ? $size : 'default';
    $heading = $slot->isEmpty() ? $title : $slot;
    $currentLabel = \Illuminate\Support\Str::limit(trim(strip_tags($current ?? ($title ?: (string) $slot))), 60);
    $trail = [];
    foreach ((array) $crumbs as $key => $value) {
        if (is_array($value)) {
            $trail[] = [$value[0] ?? ($value['label'] ?? ''), $value[1] ?? ($value['url'] ?? null)];
        } else {
            $trail[] = [$key, $value];
        }
    }
    $hasMeta = isset($meta) && trim((string) $meta) !== '';
    $hasActions = isset($actions) && trim((string) $actions) !== '';
    // Optional raw trail: <x-slot:breadcrumb><li class="breadcrumb-item">…</li>…</x-slot> (must include the current item).
    $hasCustomTrail = isset($breadcrumb) && trim((string) $breadcrumb) !== '';
?>

<<?php echo e($tag); ?> <?php echo e($attributes->class([
    'kfs-page-hero',
    'kfs-page-hero--' . $size,
    'has-image' => (bool) $image,
    'has-wave' => $wave,
])); ?>>
    <div class="kfs-page-hero__bg" aria-hidden="true">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
            <span class="kfs-page-hero__img" style="background-image: url('<?php echo e($image); ?>');"></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="<?php echo e($container); ?> kfs-page-hero__container">
        <nav class="kfs-page-hero__nav" aria-label="مسار التنقل">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><i class="fa-solid fa-house" aria-hidden="true"></i> الرئيسية</a></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCustomTrail): ?>
                    <?php echo e($breadcrumb); ?>

                <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $trail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $url]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label !== '' && $label !== null): ?>
                        <li class="breadcrumb-item">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($url): ?><a href="<?php echo e($url); ?>"><?php echo e($label); ?></a><?php else: ?><span><?php echo e($label); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($currentLabel); ?></li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ol>
        </nav>
        <div class="kfs-page-hero__inner kfs-hero-anim">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
                <span class="kfs-page-hero__icon" aria-hidden="true"><i class="<?php echo e($icon); ?>"></i></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="kfs-page-hero__text">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kicker): ?>
                    <span class="kfs-page-hero__kicker"><?php echo e($kicker); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h1 class="kfs-page-hero__title"><?php echo e($heading); ?></h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead): ?>
                    <p class="kfs-page-hero__lead"><?php echo e($lead); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMeta): ?>
                    <div class="kfs-page-hero__meta"><?php echo e($meta); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActions): ?>
                <div class="kfs-page-hero__actions"><?php echo e($actions); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($wave): ?>
        <?php if (isset($component)) { $__componentOriginal4a64e495c5d7bdd1a9e6622470f37d0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a64e495c5d7bdd1a9e6622470f37d0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.wave','data' => ['class' => 'kfs-page-hero__wave','fill' => $waveFill,'animated' => false,'gold' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.wave'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'kfs-page-hero__wave','fill' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($waveFill),'animated' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'gold' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4a64e495c5d7bdd1a9e6622470f37d0a)): ?>
<?php $attributes = $__attributesOriginal4a64e495c5d7bdd1a9e6622470f37d0a; ?>
<?php unset($__attributesOriginal4a64e495c5d7bdd1a9e6622470f37d0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4a64e495c5d7bdd1a9e6622470f37d0a)): ?>
<?php $component = $__componentOriginal4a64e495c5d7bdd1a9e6622470f37d0a; ?>
<?php unset($__componentOriginal4a64e495c5d7bdd1a9e6622470f37d0a); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?php echo e($tag); ?>>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($hasCustomTrail)): ?>
    <?php
        // BreadcrumbList structured data mirroring the visible trail (Home › … › current page).
        $kfsCrumbItems = collect([['الرئيسية', route('home')]])
            ->concat(collect($trail)->filter(fn ($c) => filled($c[0])))
            ->push([$currentLabel, url()->current()])
            ->values()
            ->map(fn ($c, $i) => array_filter([
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => trim(strip_tags((string) $c[0])),
                'item' => $c[1] ?: null,
            ]));
    ?>
    <?php $__env->startPush('seo'); ?>
        <script type="application/ld+json"><?php echo json_encode(['<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $kfsCrumbItems->all()], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/components/kfs/page-hero.blade.php ENDPATH**/ ?>