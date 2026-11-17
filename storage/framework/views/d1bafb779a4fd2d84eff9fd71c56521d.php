<?php $__env->startSection('title', 'المشروعات القومية | محافظة كفر الشيخ'); ?>
<?php $__env->startSection('description', 'المشروعات القومية والتنموية في محافظة كفر الشيخ وتوزيعها الجغرافي على المراكز.'); ?>

<?php
    $mapData = $projects->getCollection()
        ->filter(fn ($p) => $p->latitude && $p->longitude && $p->slug)
        ->map(fn ($p) => [
            'id' => $p->id,
            'name' => trim($p->name),
            'lat' => (float) $p->latitude,
            'lng' => (float) $p->longitude,
            'url' => route('projects.show', $p->slug),
            'thumb' => $p->thumbnail ? Storage::url($p->thumbnail) : null,
        ])->values();
    $plain = fn ($html, $n) => \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags(preg_replace('/<(br|\/p|\/div|\/li|\/h\d)[^>]*>/i', ' ', (string) $html)), ENT_QUOTES | ENT_HTML5, 'UTF-8'))), $n);
    $totalImages = $projects->getCollection()->sum('images_count') + $projects->getCollection()->filter(fn ($p) => $p->thumbnail)->count();
    $programs = collect([
        ['projects.hay-karima', 'fa-solid fa-hand-holding-heart', 'مبادرة حياة كريمة', $programCounts['حياة كريمة'] ?? null, 'تطوير قرى الريف المصري'],
        ['investments.index', 'fa-solid fa-chart-line', 'الاستثمار والفرص', ($programCounts['استثماري'] ?? 0) + ($programCounts['صناعي'] ?? 0), 'فرص استثمارية ومناطق صناعية'],
        ['governorate.map', 'fa-solid fa-map-location-dot', 'الخريطة التفاعلية', null, 'كل المشروعات والمعالم على خريطة واحدة'],
    ])->filter(fn ($p) => Route::has($p[0]));
?>

<?php $__env->startPush('css'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mapData->isNotEmpty()): ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/kfs-pages-info.css')); ?>?v=<?php echo e(@filemtime(public_path('css/kfs-pages-info.css'))); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <main class="kpi">
        <?php if (isset($component)) { $__componentOriginal41b59b94795194d9da2e0c0b1158fd94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b59b94795194d9da2e0c0b1158fd94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.page-hero','data' => ['title' => 'المشروعات القومية','kicker' => 'مشروعات المحافظة','icon' => 'fa-solid fa-flag','subtitle' => 'مشروعات تنموية كبرى تُنفَّذ على أرض كفر الشيخ — تعرّف عليها وعلى مواقعها.','image' => asset('images/bg/projects.jpg')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'المشروعات القومية','kicker' => 'مشروعات المحافظة','icon' => 'fa-solid fa-flag','subtitle' => 'مشروعات تنموية كبرى تُنفَّذ على أرض كفر الشيخ — تعرّف عليها وعلى مواقعها.','image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('images/bg/projects.jpg'))]); ?>
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

        <div class="container kpi__wrap">
            
            <section class="kpi-figs" aria-label="أرقام المشروعات">
                <div class="kpi-fig"><strong><?php echo e($projects->total()); ?></strong><span>مشروعاً قومياً</span></div>
                <div class="kpi-fig"><strong><?php echo e($mapData->count()); ?></strong><span>محدد على الخريطة</span></div>
                <div class="kpi-fig"><strong><?php echo e($totalImages); ?></strong><span>صورة توثيقية</span></div>
            </section>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->isNotEmpty()): ?>
                <section class="kprj-list" aria-label="قائمة المشروعات">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $photos = $project->images_count + ($project->thumbnail ? 1 : 0); ?>
                        <article class="kprj <?php echo e($loop->odd ? '' : 'kprj--alt'); ?>">
                            <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="kprj__media" tabindex="-1" aria-hidden="true">
                                <img src="<?php echo e($project->thumbnail ? Storage::url($project->thumbnail) : asset('images/bg/projects.jpg')); ?>" alt="" loading="lazy">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos > 1): ?>
                                    <span class="kprj__photos"><i class="fa-solid fa-images"></i> <?php echo e($photos); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </a>
                            <div class="kprj__body">
                                <div class="kprj__chips">
                                    <span class="kpi-chip"><i class="fa-solid fa-flag" aria-hidden="true"></i> مشروع قومي</span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->is_highlighted): ?>
                                        <span class="kpi-chip kpi-chip--gold"><i class="fa-solid fa-star" aria-hidden="true"></i> مميز</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->latitude && $project->longitude): ?>
                                        <button type="button" class="kpi-chip kpi-chip--btn" data-focus-project="<?php echo e($project->id); ?>">
                                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i> على الخريطة
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <h2 class="kprj__title"><a href="<?php echo e(route('projects.show', $project->slug)); ?>"><?php echo e(trim($project->name)); ?></a></h2>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->description): ?>
                                    <p class="kprj__text"><?php echo e($plain($project->description, 240)); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="kpi-btn">
                                    <span>تفاصيل المشروع</span><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </section>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->hasPages()): ?>
                    <div class="pagination-wrapper"><?php echo e($projects->links()); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal83cc0afe61fc0b0b7055692555f7bca1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.empty-state','data' => ['icon' => 'box','title' => 'لا توجد مشروعات منشورة حالياً']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'box','title' => 'لا توجد مشروعات منشورة حالياً']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1)): ?>
<?php $attributes = $__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1; ?>
<?php unset($__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal83cc0afe61fc0b0b7055692555f7bca1)): ?>
<?php $component = $__componentOriginal83cc0afe61fc0b0b7055692555f7bca1; ?>
<?php unset($__componentOriginal83cc0afe61fc0b0b7055692555f7bca1); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mapData->isNotEmpty()): ?>
                <section class="kprj-map" aria-labelledby="kprjMapTitle">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kprjMapTitle','title' => 'المشروعات على الخريطة','subtitle' => 'اختر مشروعاً لعرض موقعه.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kprjMapTitle','title' => 'المشروعات على الخريطة','subtitle' => 'اختر مشروعاً لعرض موقعه.']); ?>
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
                    <div class="kprj-map__grid">
                        <ul class="kprj-map__list" id="kprjList">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $mapData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><button type="button" data-focus-project="<?php echo e($p['id']); ?>"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?php echo e($p['name']); ?></button></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                        <div class="kprj-map__canvas" id="kprjMap" role="region" aria-label="خريطة المشروعات القومية"></div>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($programs->isNotEmpty()): ?>
                <section aria-labelledby="kprjMoreTitle">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kprjMoreTitle','title' => 'برامج ومشروعات أخرى']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kprjMoreTitle','title' => 'برامج ومشروعات أخرى']); ?>
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
                    <div class="kpi-links">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$route, $icon, $title, $count, $desc]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route($route)); ?>" class="kpi-link">
                                <span class="kpi-link__icon" aria-hidden="true"><i class="<?php echo e($icon); ?>"></i></span>
                                <span class="kpi-link__body"><strong><?php echo e($title); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($count): ?><small class="kpi-link__count"><?php echo e($count); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></strong><small><?php echo e($desc); ?></small></span>
                                <i class="fa-solid fa-arrow-left kpi-link__go" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mapData->isNotEmpty()): ?>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script type="application/json" id="kprjData"><?php echo json_encode($mapData, 15, 512) ?></script>
        <script>
        (function () {
            const points = JSON.parse(document.getElementById('kprjData').textContent);
            const map = L.map('kprjMap', { scrollWheelZoom: false });
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>'
            }).addTo(map);
            const icon = L.divIcon({ className: 'kprj-pin-wrap', html: '<span class="kprj-pin"><i class="fa-solid fa-flag" aria-hidden="true"></i></span>', iconSize: [36, 44], iconAnchor: [18, 42], popupAnchor: [0, -38] });
            const markers = {};
            points.forEach(p => {
                const box = document.createElement('div'); box.className = 'kprj-pop';
                if (p.thumb) { const img = document.createElement('img'); img.src = p.thumb; img.alt = ''; box.append(img); }
                const a = document.createElement('a'); a.href = p.url; a.textContent = p.name; box.append(a);
                markers[p.id] = L.marker([p.lat, p.lng], { icon, title: p.name }).addTo(map).bindPopup(box);
            });
            map.fitBounds(L.latLngBounds(points.map(p => [p.lat, p.lng])).pad(0.25), { maxZoom: 12 });

            document.querySelectorAll('[data-focus-project]').forEach(btn => btn.addEventListener('click', () => {
                const m = markers[btn.dataset.focusProject];
                if (!m) return;
                document.getElementById('kprjMap').scrollIntoView({ behavior: 'smooth', block: 'center' });
                map.flyTo(m.getLatLng(), 14, { duration: .8 });
                setTimeout(() => m.openPopup(), 850);
                document.querySelectorAll('#kprjList button').forEach(b => b.classList.toggle('is-active', b.dataset.focusProject === btn.dataset.focusProject));
            }));
        })();
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/projects/index.blade.php ENDPATH**/ ?>