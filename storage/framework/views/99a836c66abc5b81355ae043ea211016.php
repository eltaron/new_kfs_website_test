<?php $__env->startSection('title', trim($project->name) . ' | مشروعات المحافظة'); ?>
<?php $__env->startSection('description', \Illuminate\Support\Str::limit(trim(html_entity_decode(strip_tags((string) $project->description), ENT_QUOTES | ENT_HTML5, 'UTF-8')), 155) ?: 'مشروعات محافظة كفر الشيخ'); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->thumbnail): ?>
    <?php $__env->startSection('og_image', asset(Storage::url($project->thumbnail))); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php
    $hasCoords = $project->latitude && $project->longitude;
?>

<?php $__env->startPush('css'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCoords): ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/kfs-landmark.css')); ?>?v=<?php echo e(@filemtime(public_path('css/kfs-landmark.css'))); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/kfs-project.css')); ?>?v=<?php echo e(@filemtime(public_path('css/kfs-project.css'))); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $name = trim($project->name);
        $category = trim((string) $project->category);
        $kinds = [
            'قومي' => ['label' => 'مشروع قومي', 'icon' => 'fa-solid fa-flag', 'tone' => 'primary'],
            'صناعي' => ['label' => 'منطقة صناعية', 'icon' => 'fa-solid fa-industry', 'tone' => 'olive'],
            'حياة كريمة' => ['label' => 'مبادرة حياة كريمة', 'icon' => 'fa-solid fa-hand-holding-heart', 'tone' => 'gold'],
            'استثماري' => ['label' => 'فرصة استثمارية', 'icon' => 'fa-solid fa-chart-line', 'tone' => 'bronze'],
        ];
        $kind = $kinds[$category] ?? ['label' => $category ?: 'مشروع', 'icon' => 'fa-solid fa-diagram-project', 'tone' => 'primary'];
        $isInvestment = $category === 'استثماري';

        $cover = $project->thumbnail ? Storage::url($project->thumbnail) : asset('images/bg/projects.jpg');
        $photos = collect($project->thumbnail ? [['src' => $cover, 'caption' => $name]] : [])
            ->concat($project->images->map(fn ($img) => ['src' => Storage::url($img->path), 'caption' => $img->caption ?: $name]))
            ->unique('src')->values();
        $mosaic = $photos->take(5);
        $extra = $photos->count() - $mosaic->count();

        $description = trim((string) $project->description);
        $isLong = mb_strlen(strip_tags($description)) > 900;
        $iframe = trim((string) $project->iframe);
        $directions = $hasCoords ? 'https://www.google.com/maps/dir/?api=1&destination=' . $project->latitude . ',' . $project->longitude : null;
        $program = $project->investment;
        $listUrl = match ($category) {
            'حياة كريمة' => Route::has('projects.hay-karima') ? route('projects.hay-karima') : route('projects.index'),
            'استثماري', 'صناعي' => $program ? route('investments.show', $program) : (Route::has('investments.index') ? route('investments.index') : route('projects.index')),
            default => route('projects.index'),
        };
        $listLabel = match ($category) {
            'حياة كريمة' => 'كل مشروعات حياة كريمة',
            'استثماري', 'صناعي' => $program ? 'كل ' . trim($program->title) : 'الاستثمار',
            default => 'كل المشروعات القومية',
        };
    ?>

    <main class="klm kpj kpj--<?php echo e($kind['tone']); ?>">
        <?php if (isset($component)) { $__componentOriginal41b59b94795194d9da2e0c0b1158fd94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b59b94795194d9da2e0c0b1158fd94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.page-hero','data' => ['title' => $name,'kicker' => $kind['label'],'icon' => $kind['icon'],'image' => $cover,'crumbs' => ['المشروعات' => route('projects.index')]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'kicker' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kind['label']),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kind['icon']),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cover),'crumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['المشروعات' => route('projects.index')])]); ?>
             <?php $__env->slot('meta', null, []); ?> 
                <span><i class="<?php echo e($kind['icon']); ?>" aria-hidden="true"></i> <?php echo e($kind['label']); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($program && ! in_array(trim($program->title), [$kind['label'], $category], true)): ?>
                    <span><i class="fa-solid fa-layer-group" aria-hidden="true"></i> <?php echo e(trim($program->title)); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->count() > 1): ?>
                    <span><i class="fa-solid fa-images" aria-hidden="true"></i> <?php echo e($photos->count()); ?> صورة</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41b59b94795194d9da2e0c0b1158fd94)): ?>
<?php $attributes = $__attributesOriginal41b59b94795194d9da2e0c0b1158fd94; ?>
<?php unset($__attributesOriginal41b59b94795194d9da2e0c0b1158fd94); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41b59b94795194d9da2e0c0b1158fd94)): ?>
<?php $component = $__componentOriginal41b59b94795194d9da2e0c0b1158fd94; ?>
<?php unset($__componentOriginal41b59b94795194d9da2e0c0b1158fd94); ?>
<?php endif; ?>

        <div class="container klm__wrap">
            <div class="klm__layout">
                
                <div class="klm__main">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->isNotEmpty()): ?>
                        <section class="klm-gallery klm-gallery--n<?php echo e(min($mosaic->count(), 5)); ?>" aria-label="معرض الصور">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $mosaic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($photo['src']); ?>" class="klm-gallery__item" data-fslightbox="project"
                                    data-caption="<?php echo e($photo['caption']); ?>" aria-label="عرض الصورة <?php echo e($i + 1); ?> من <?php echo e($photos->count()); ?>">
                                    <img src="<?php echo e($photo['src']); ?>" alt="<?php echo e($photo['caption']); ?>" <?php if($i > 0): ?> loading="lazy" <?php endif; ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->last && $extra > 0): ?>
                                        <span class="klm-gallery__more"><i class="fa-solid fa-images" aria-hidden="true"></i> +<?php echo e($extra); ?> صورة</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $photos->slice($mosaic->count()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($photo['src']); ?>" data-fslightbox="project" data-caption="<?php echo e($photo['caption']); ?>" hidden tabindex="-1" aria-hidden="true"></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->count() > 1): ?>
                                <button type="button" class="klm-gallery__all" data-open-gallery>
                                    <i class="fa-solid fa-grip" aria-hidden="true"></i> عرض كل الصور
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <section class="klm-card" aria-labelledby="kpjAboutTitle">
                        <h2 class="klm-card__title" id="kpjAboutTitle">
                            <span class="klm-card__icon kpj-icon" aria-hidden="true"><i class="fa-solid fa-circle-info"></i></span>
                            عن المشروع
                        </h2>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description !== ''): ?>
                            <div class="kpj-readmore <?php echo e($isLong ? 'is-collapsed' : ''); ?>" id="kpjAbout">
                                <div class="klm-prose"><?php echo clean($description, 'cms'); ?></div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLong): ?>
                                <button type="button" class="kpj-readmore__btn" aria-controls="kpjAbout" aria-expanded="false" data-more="اقرأ المزيد" data-less="عرض أقل">
                                    <span>اقرأ المزيد</span> <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php else: ?>
                            <p class="klm-muted">سيتم إضافة تفاصيل هذا المشروع قريبًا.</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </section>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCoords || $iframe !== ''): ?>
                        <section class="klm-card" aria-labelledby="kpjMapTitle">
                            <div class="klm-location__head">
                                <h2 class="klm-card__title" id="kpjMapTitle">
                                    <span class="klm-card__icon kpj-icon" aria-hidden="true"><i class="fa-solid fa-map-location-dot"></i></span>
                                    موقع المشروع
                                </h2>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCoords && Route::has('governorate.map')): ?>
                                    <a href="<?php echo e(route('governorate.map')); ?>" class="klm-link">الخريطة التفاعلية <i class="fa-solid fa-arrow-left" aria-hidden="true"></i></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCoords): ?>
                                <div class="klm-map" id="kpjMap" role="region" aria-label="خريطة موقع <?php echo e($name); ?>"
                                    data-lat="<?php echo e($project->latitude); ?>" data-lng="<?php echo e($project->longitude); ?>" data-name="<?php echo e($name); ?>" data-icon="<?php echo e($kind['icon']); ?>"></div>
                            <?php else: ?>
                                <div class="kpj-embed"><?php echo clean(preg_replace('/(width|height)="[^"]*"/', '', $iframe), 'cms'); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </section>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <aside class="klm__aside" aria-label="بطاقة المشروع">
                    <div class="klm-info kpj-info">
                        <span class="kpj-badge"><i class="<?php echo e($kind['icon']); ?>" aria-hidden="true"></i> <?php echo e($kind['label']); ?></span>
                        <h2 class="klm-info__title">بطاقة المشروع</h2>
                        <dl class="klm-info__list">
                            <div>
                                <dt><i class="fa-solid fa-tag" aria-hidden="true"></i> التصنيف</dt>
                                <dd><?php echo e($kind['label']); ?></dd>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($program): ?>
                                <div>
                                    <dt><i class="fa-solid fa-layer-group" aria-hidden="true"></i> المحور</dt>
                                    <dd><a href="<?php echo e(route('investments.show', $program)); ?>"><?php echo e(trim($program->title)); ?></a></dd>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div>
                                <dt><i class="fa-solid fa-map-pin" aria-hidden="true"></i> المحافظة</dt>
                                <dd>كفر الشيخ</dd>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->count()): ?>
                                <div>
                                    <dt><i class="fa-solid fa-camera" aria-hidden="true"></i> الصور</dt>
                                    <dd><?php echo e($photos->count()); ?></dd>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </dl>

                        <div class="klm-info__actions">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($directions): ?>
                                <a href="<?php echo e($directions); ?>" target="_blank" rel="noopener" class="klm-btn klm-btn--primary">
                                    <i class="fa-solid fa-diamond-turn-right" aria-hidden="true"></i><span>الاتجاهات إلى الموقع</span>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <button type="button" class="klm-btn" id="klmShare" data-title="<?php echo e($name); ?>">
                                <i class="fa-solid fa-share-nodes" aria-hidden="true"></i><span>مشاركة</span>
                            </button>
                        </div>
                        <p class="klm-info__toast" id="klmShareToast" role="status" hidden>تم نسخ الرابط</p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($isInvestment || config('app.show_hidden')) && Route::has('investment.contact')): ?>
                        
                        <div class="kpj-cta">
                            <span class="kpj-cta__icon" aria-hidden="true"><i class="fa-solid fa-headset"></i></span>
                            <p class="kpj-cta__text">في حالة الرغبة في التقدم لأي فرصة أو وجود أي استفسارات</p>
                            <a href="<?php echo e(route('investment.contact')); ?>" class="klm-btn klm-btn--gold">
                                <span>تواصل معنا من هنا</span><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <a href="<?php echo e($listUrl); ?>" class="klm-back">
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i> <?php echo e($listLabel); ?>

                    </a>
                </aside>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->isNotEmpty()): ?>
                <section class="klm-related" aria-labelledby="kpjRelatedTitle">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kpjRelatedTitle','title' => 'مشروعات أخرى','link' => $listUrl,'linkText' => $listLabel]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kpjRelatedTitle','title' => 'مشروعات أخرى','link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listUrl),'linkText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listLabel)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $attributes = $__attributesOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__attributesOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $component = $__componentOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__componentOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
                    <div class="klm-related__grid">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $k = $kinds[trim((string) $item->category)] ?? ['label' => $item->category ?: 'مشروع', 'icon' => 'fa-solid fa-diagram-project']; ?>
                            <a href="<?php echo e(route('projects.show', $item->slug)); ?>" class="klm-related__card">
                                <span class="klm-related__img">
                                    <img src="<?php echo e($item->thumbnail ? Storage::url($item->thumbnail) : asset('images/bg/projects.jpg')); ?>" alt="" loading="lazy">
                                </span>
                                <span class="klm-related__body">
                                    <small class="kpj-related__kind"><i class="<?php echo e($k['icon']); ?>" aria-hidden="true"></i> <?php echo e($k['label']); ?></small>
                                    <strong><?php echo e(\Illuminate\Support\Str::limit(trim($item->name), 90)); ?></strong>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/fslightbox@3.4.1/index.js"></script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasCoords): ?>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <script>
    (function () {
        document.querySelector('[data-open-gallery]')?.addEventListener('click', () => {
            if (window.fsLightboxInstances && fsLightboxInstances.project) fsLightboxInstances.project.open(0);
            else document.querySelector('.klm-gallery__item')?.click();
        });

        // Long descriptions: collapse with «اقرأ المزيد».
        const more = document.querySelector('.kpj-readmore__btn');
        more?.addEventListener('click', () => {
            const box = document.getElementById('kpjAbout');
            const open = box.classList.toggle('is-collapsed') === false;
            more.setAttribute('aria-expanded', open ? 'true' : 'false');
            more.querySelector('span').textContent = open ? more.dataset.less : more.dataset.more;
            if (!open) box.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        const mapEl = document.getElementById('kpjMap');
        if (mapEl && window.L) {
            const ll = [parseFloat(mapEl.dataset.lat), parseFloat(mapEl.dataset.lng)];
            const map = L.map(mapEl, { scrollWheelZoom: false }).setView(ll, 14);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>'
            }).addTo(map);
            const i = document.createElement('i');
            i.className = mapEl.dataset.icon;
            i.setAttribute('aria-hidden', 'true');
            const pin = L.divIcon({ className: 'klm-pin-wrap', html: '<span class="klm-pin kpj-pin">' + i.outerHTML + '</span>', iconSize: [40, 48], iconAnchor: [20, 46] });
            const marker = L.marker(ll, { icon: pin, title: mapEl.dataset.name }).addTo(map);
            const label = document.createElement('strong');
            label.textContent = mapEl.dataset.name.length > 40 ? mapEl.dataset.name.slice(0, 40) + '…' : mapEl.dataset.name;
            marker.bindTooltip(label, { direction: 'top', offset: [0, -44], permanent: true, className: 'klm-tip' });
        }

        const share = document.getElementById('klmShare');
        const toast = document.getElementById('klmShareToast');
        share?.addEventListener('click', async () => {
            try {
                if (navigator.share) { await navigator.share({ title: share.dataset.title, url: location.href }); return; }
                await navigator.clipboard.writeText(location.href);
                toast.hidden = false;
                setTimeout(() => { toast.hidden = true; }, 2200);
            } catch (e) { /* cancelled */ }
        });
    })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/projects/show.blade.php ENDPATH**/ ?>