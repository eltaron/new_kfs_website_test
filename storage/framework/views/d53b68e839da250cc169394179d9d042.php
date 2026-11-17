<?php $__env->startPush('css'); ?>
    <link rel="stylesheet"
        href="<?php echo e(asset('css/kfs-home-search.css')); ?>?v=<?php echo e(@filemtime(public_path('css/kfs-home-search.css'))); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($guideCategories->isNotEmpty()): ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        // Hidden-from-admin e-services resolve to null, so every guarded link disappears.
        $kfsRoute = fn(string $name, array $params = []) => \App\Support\EServices::visible($name)
            ? route($name, $params)
            : null;
        $kfsImg = fn($path, $fallback = 'images/kfs.png') => $path ? Storage::url($path) : asset($fallback);
        $kfsLogoUrl = !empty($settings['site_logo_header'])
            ? Storage::url($settings['site_logo_header'])
            : asset('logo.png');
        $kfsPlain = fn($html, $limit = 140) => \Illuminate\Support\Str::limit(
            trim(
                preg_replace(
                    '/\s+/u',
                    ' ',
                    html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                ),
            ),
            $limit,
        );
        $kfsText = fn($key, $default) => trim(strip_tags((string) ($settings[$key] ?? ''))) ?: $default;

        // E-services quick links (static; every entry is guarded by Route::has).
        $kfsQuick = collect([
            [
                'services.index',
                'fa-solid fa-hand-holding-hand',
                'دليل الخدمات',
                'كل الخدمات الحكومية وشروطها ومستنداتها',
                null,
            ],
            ['requests.index', 'fa-solid fa-file-pen', 'الشكاوى والبلاغات', 'قدّم شكواك أو بلاغك وتابع حالتها', null],
            // «الخدمات الجغرافية» card: removed from production, shown only in the test copy.
            config('app.show_hidden')
                ? ['gis.index', 'fa-solid fa-map-location-dot', 'الخدمات الجغرافية', 'خدمات المساحة والمواقع والتراخيص', null]
                : ['__none__', '', '', '', null],
            [
                'site-validity.landing',
                'fa-solid fa-ruler-combined',
                'طلب صلاحية الموقع',
                'معاينة ورفع مساحي وملف نهائي إلكترونياً',
                null,
            ],
            ['citizen-lookup', 'fa-solid fa-helmet-safety', 'الإشراف الهندسي', 'استعلام عن شهادات الإشراف', null],
            [
                'exam-results.index',
                'fa-solid fa-graduation-cap',
                'نتائج الامتحانات',
                'استعلم عن نتيجتك برقم الجلوس',
                null,
            ],
            ['emergency.create', 'fa-solid fa-truck-medical', 'بلاغ طوارئ', 'أبلغ عن حالة طارئة فوراً', 'danger'],
            ['estidama.index', 'fa-solid fa-seedling', 'برنامج استدامة', 'برامج تدريب وتعلّم معتمدة', null],
            ['market.home', 'fa-solid fa-store', 'متجر ذوي الهمم', 'منتجات أبناء المحافظة', null],
            ['tour-bookings.create', 'fa-solid fa-route', 'حجز رحلة سياحية', 'للشركات والمجموعات', null],
            ['directory.index', 'fa-solid fa-phone-volume', 'دليل الهاتف', 'أرقام الطوارئ والجهات الخدمية', null],
            ['suggestions.create', 'fa-solid fa-lightbulb', 'تقديم مقترح', 'شاركنا أفكارك لتطوير الخدمات', null],
            [
                'surveys.service.create',
                'fa-solid fa-star-half-stroke',
                'تقييم الخدمات',
                'رأيك يساعدنا على التحسين',
                null,
            ],
        ])
            ->map(
                fn($q) => [
                    'url' => $kfsRoute($q[0]),
                    'icon' => $q[1],
                    'title' => $q[2],
                    'desc' => $q[3],
                    'tone' => $q[4],
                ],
            )
            ->filter(fn($q) => $q['url'])
            ->values();

        $kfsHasMarket = (bool) $kfsRoute('market.home');
        $kfsPlanUrl = $kfsRoute('investment.plans.index');
    ?>

    <main class="main-content kfs-home">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'تم بنجاح',
                    text: <?php echo e(json_encode(session('success'))); ?>,
                    confirmButtonText: 'حسناً'
                });
            </script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <section class="kfs-hs" aria-label="البوابة الرسمية — أبرز الموضوعات">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroSlides->isNotEmpty()): ?>
                <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="7000">
                    <div class="carousel-inner">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide->media_type == 'video'): ?>
                                    <video class="kfs-hs__media" autoplay muted loop playsinline
                                        poster="<?php echo e(asset('images/video_placeholder.png')); ?>" aria-hidden="true">
                                        <source src="<?php echo e(Storage::url($slide->media_path)); ?>" type="video/mp4">
                                    </video>
                                <?php else: ?>
                                    <img src="<?php echo e(Storage::url($slide->media_path)); ?>" class="kfs-hs__media" alt=""
                                        <?php if(!$loop->first): ?> loading="lazy" <?php endif; ?>>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="kfs-hs__shade" aria-hidden="true"></div>
                                <div class="kfs-hs__content">
                                    <div class="container">
                                        <div class="kfs-hs__text kfs-hero-anim">
                                            <span
                                                class="kfs-hs__badge"><?php echo e($slide->badge_text ?? ($slide->link_url ? 'رؤية وطنية' : 'محافظة كفرالشيخ')); ?></span>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->first): ?>
                                                <h1 class="kfs-hs__title"><?php echo e($slide->title); ?></h1>
                                            <?php else: ?>
                                                <h2 class="kfs-hs__title"><?php echo e($slide->title); ?></h2>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <p class="kfs-hs__lead">
                                                <?php echo e($slide->description ? \Illuminate\Support\Str::limit($slide->description, 150) : 'نعمل معاً لخدمة المواطن وتحقيق التنمية المستدامة'); ?>

                                            </p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide->link_url): ?>
                                                <div class="kfs-hs__actions">
                                                    <a href="<?php echo e($slide->link_url); ?>" class="btn-modern-gold">
                                                        <span><?php echo e($slide->link_text ?? 'استكشف الآن'); ?></span>
                                                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroSlides->count() > 1): ?>
                        <div class="kfs-hs__dots">
                            <div class="container">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" data-bs-target="#heroCarousel"
                                        data-bs-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->first ? 'active' : ''); ?>"
                                        aria-label="الشريحة <?php echo e($loop->iteration); ?>"
                                        <?php if($loop->first): ?> aria-current="true" <?php endif; ?>></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <div class="kfs-hs__arrows">
                            <div class="container">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
                                    aria-label="الشريحة السابقة"><i class="fa-solid fa-chevron-right"
                                        aria-hidden="true"></i></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
                                    aria-label="الشريحة التالية"><i class="fa-solid fa-chevron-left"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php else: ?>
                <div class="carousel-item active d-block">
                    <img src="<?php echo e(asset('images/places/i3.png')); ?>" class="kfs-hs__media" alt="">
                    <div class="kfs-hs__shade" aria-hidden="true"></div>
                    <div class="kfs-hs__content">
                        <div class="container">
                            <div class="kfs-hs__text kfs-hero-anim">
                                <span class="kfs-hs__badge">الموقع الرسمي</span>
                                <h1 class="kfs-hs__title">محافظة كفرالشيخ</h1>
                                <p class="kfs-hs__lead">خدماتك الحكومية ومعلومات محافظتك في مكان واحد — أرض الماء والزراعة
                                    والتنمية.</p>
                                <div class="kfs-hs__actions">
                                    <a href="<?php echo e(route('services.index')); ?>" class="btn-modern-gold"><span>الخدمات
                                            الإلكترونية</span><i class="fa-solid fa-chevron-left"
                                            aria-hidden="true"></i></a>
                                    <a href="<?php echo e(route('about')); ?>" class="btn-kfs-outline on-dark">اكتشف المحافظة</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php
                $kfsSuggest = collect([
                    ['services.index', 'fa-solid fa-hand-holding-hand', 'دليل الخدمات', 'صفحة'],
                    ['posts.index', 'fa-solid fa-newspaper', 'الأخبار', 'صفحة'],
                    ['projects.index', 'fa-solid fa-diagram-project', 'المشروعات القومية', 'صفحة'],
                    ['investments.index', 'fa-solid fa-chart-line', 'الاستثمار', 'صفحة'],
                    ['landmarks.index', 'fa-solid fa-monument', 'السياحة والمعالم', 'صفحة'],
                    ['governorate.map', 'fa-solid fa-map-location-dot', 'الخريطة التفاعلية', 'صفحة'],
                    ['about', 'fa-solid fa-landmark-flag', 'عن المحافظة', 'صفحة'],
                    ['about.governor', 'fa-solid fa-feather-pointed', 'كلمة المحافظ', 'صفحة'],
                    ['contact.index', 'fa-solid fa-headset', 'تواصل معنا', 'صفحة'],
                ])
                    ->map(fn($q) => ['t' => $q[2], 'u' => $kfsRoute($q[0]), 'i' => $q[1], 'k' => $q[3]])
                    ->concat(
                        $kfsQuick->map(
                            fn($q) => [
                                't' => $q['title'],
                                'u' => $q['url'],
                                'i' => $q['icon'],
                                'k' => 'خدمة إلكترونية',
                                'd' => $q['desc'],
                            ],
                        ),
                    )
                    ->concat(
                        $services->map(
                            fn($svc) => [
                                't' => trim(
                                    strip_tags($svc->title ?: trim($svc->title_line_1 . ' ' . $svc->title_line_2)),
                                ),
                                'u' => $svc->publicUrl(),
                                'i' => $svc->icon ?: 'fa-solid fa-file-lines',
                                'k' => 'خدمة',
                            ],
                        ),
                    )
                    ->filter(fn($q) => $q['u'] && $q['t'])
                    ->unique('u')
                    ->values();
                $kfsExamples = [
                    'رخصة بناء',
                    'نتائج الامتحانات',
                    'تقديم شكوى',
                    'المعالم السياحية',
                    'دليل الهاتف',
                    'الفرص الاستثمارية',
                ];
                $kfsPopular = $kfsQuick->reject(fn($q) => $q['title'] === 'دليل الخدمات')->take(5);
            ?>
            <div class="khs">
                <div class="container">
                    <form action="<?php echo e(route('search')); ?>" method="GET" class="khs__panel" role="search" id="khsForm"
                        autocomplete="off">
                        <div class="khs__top">
                            <label for="khsInput" class="khs__q">
                                <span class="khs__q-icon" aria-hidden="true"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>
                                بماذا يمكننا مساعدتك اليوم؟
                            </label>
                        </div>

                        <div class="khs__field">
                            <i class="fa-solid fa-magnifying-glass khs__field-icon" aria-hidden="true"></i>
                            <input type="search" name="query" id="khsInput" class="khs__input"
                                placeholder="ابحث عن خدمة، خبر، مشروع، رقم هاتف…"
                                data-examples="<?php echo e(json_encode($kfsExamples, JSON_UNESCAPED_UNICODE)); ?>" role="combobox"
                                aria-expanded="false" aria-controls="khsList" aria-autocomplete="list">
                            <button type="button" class="khs__clear" id="khsClear" hidden aria-label="مسح"><i
                                    class="fa-solid fa-xmark" aria-hidden="true"></i></button>
                            <button type="submit" class="khs__submit">
                                <span>ابحث</span><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                            </button>
                            <ul class="khs__list" id="khsList" role="listbox" aria-label="اقتراحات" hidden></ul>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsPopular->isNotEmpty()): ?>
                            <div class="khs__popular">
                                <span class="khs__popular-label"><i class="fa-solid fa-fire" aria-hidden="true"></i>
                                    الأكثر طلباً:</span>
                                <div class="khs__chips">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kfsPopular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e($q['url']); ?>" class="khs__chip"><i class="<?php echo e($q['icon']); ?>"
                                                aria-hidden="true"></i> <?php echo e($q['title']); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </form>
                </div>
            </div>
            <script type="application/json" id="khsData"><?php echo json_encode($kfsSuggest, 15, 512) ?></script>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($settings['secondary_hero_title'])): ?>
            <section class="kfs-sec kfs-sec--tight kfs-sec--flush-b" id="values-section"
                aria-labelledby="kfsValuesTitle">
                <div class="container">
                    <div class="kfs-values" data-reveal>
                        <div>
                            <h2 class="kfs-values__title" id="kfsValuesTitle"><?php echo clean($settings['secondary_hero_title'], 'cms'); ?></h2>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($settings['secondary_hero_description'])): ?>
                                <p class="kfs-values__text"><?php echo clean($settings['secondary_hero_description'], 'cms'); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <a href="<?php echo e($settings['secondary_hero_button_link'] ?? '#'); ?>" class="btn-kfs">
                                <span><?php echo e($kfsText('secondary_hero_button_text', 'قراءة المزيد')); ?></span><i
                                    class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="kfs-values__mark" aria-hidden="true"><img src="<?php echo e($kfsLogoUrl); ?>" alt=""
                                width="92" height="92" loading="lazy"></div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->isNotEmpty()): ?>
            <section class="kfs-sec" id="events-section" aria-labelledby="kfsEventsTitle">
                <div class="container">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsEventsTitle','subtitle' => $kfsText('events_subtitle', 'تابع آخر الفعاليات والقرارات الرسمية.')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsEventsTitle','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('events_subtitle', 'تابع آخر الفعاليات والقرارات الرسمية.'))]); ?>
                        <?php echo e($kfsText('events_title', 'أهم الأحداث')); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($events->count() > 1): ?>
                             <?php $__env->slot('tools', null, []); ?> 
                                <button type="button" class="kfs-navbtn kfs-events-prev" aria-label="الحدث السابق"><i
                                        class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
                                <button type="button" class="kfs-navbtn kfs-events-next" aria-label="الحدث التالي"><i
                                        class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
                             <?php $__env->endSlot(); ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <div class="kfs-slider" data-reveal>
                        <div class="swiper kfs-events-swiper">
                            <div class="swiper-wrapper">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo e(route('posts.show', $event->slug)); ?>" class="kfs-event">
                                            <span class="kfs-card__media">
                                                <img src="<?php echo e($kfsImg($event->thumbnail)); ?>" alt=""
                                                    loading="lazy">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->published_at): ?>
                                                    <time class="kfs-date"
                                                        datetime="<?php echo e($event->published_at->toDateString()); ?>">
                                                        <b><?php echo e($event->published_at->format('d')); ?></b><span><?php echo e($event->published_at->translatedFormat('F Y')); ?></span>
                                                    </time>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </span>
                                            <span class="kfs-card__body">
                                                <span><span class="kfs-badge kfs-badge--gold"><i
                                                            class="fa-regular fa-calendar" aria-hidden="true"></i>
                                                        فعالية</span></span>
                                                <span class="kfs-card__title"><?php echo e($event->title); ?></span>
                                                <span class="kfs-card__more">التفاصيل <i class="fa-solid fa-arrow-left"
                                                        aria-hidden="true"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <section class="kfs-sec kfs-sec--alt" aria-labelledby="kfsNewsTitle">
            <div class="container">
                <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsNewsTitle','subtitle' => $kfsText('news_subtitle', 'تحديثات يومية لأهم أخبار المحافظة.'),'link' => route('posts.index'),'linkText' => $kfsText('news_view_all_link_text', 'عرض كل الأخبار')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsNewsTitle','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('news_subtitle', 'تحديثات يومية لأهم أخبار المحافظة.')),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('posts.index')),'link-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('news_view_all_link_text', 'عرض كل الأخبار'))]); ?>
                    <?php echo e($kfsText('news_title', 'آخر الأخبار')); ?>

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

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newsCategories->isNotEmpty()): ?>
                    <nav aria-label="تصنيفات الأخبار">
                        <ul class="kfs-chips">
                            <li><a href="<?php echo e(route('posts.index')); ?>" class="kfs-chip">الكل</a></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $newsCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('posts.index', ['category' => $cat->slug])); ?>"
                                        class="kfs-chip"><?php echo e($cat->name); ?> <span
                                            class="kfs-chip__count"><?php echo e($cat->posts_count); ?></span></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredNews || $latestNews->isNotEmpty()): ?>
                    <div class="kfs-news-layout <?php echo e($featuredNews && $latestNews->isNotEmpty() ? '' : 'is-single'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredNews): ?>
                            <a href="<?php echo e(route('posts.show', $featuredNews->slug)); ?>" class="kfs-news kfs-news--feature"
                                data-reveal>
                                <span class="kfs-card__media">
                                    <img src="<?php echo e($kfsImg($featuredNews->thumbnail)); ?>" alt="" loading="lazy">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredNews->published_at): ?>
                                        <time class="kfs-date"
                                            datetime="<?php echo e($featuredNews->published_at->toDateString()); ?>"><b><?php echo e($featuredNews->published_at->format('d')); ?></b><span><?php echo e($featuredNews->published_at->translatedFormat('F Y')); ?></span></time>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                                <span class="kfs-card__body">
                                    <span><span
                                            class="kfs-badge"><?php echo e($featuredNews->category->name ?? 'أخبار'); ?></span></span>
                                    <span class="kfs-card__title"><?php echo e($featuredNews->title); ?></span>
                                    <span class="kfs-card__text"><?php echo e($kfsPlain($featuredNews->content, 220)); ?></span>
                                    <span class="kfs-card__more">اقرأ الخبر <i class="fa-solid fa-arrow-left"
                                            aria-hidden="true"></i></span>
                                </span>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($latestNews->isNotEmpty()): ?>
                            <div class="kfs-news-layout__side" data-stagger>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('posts.show', $news->slug)); ?>"
                                        class="kfs-news <?php echo e($featuredNews ? 'kfs-news--row' : ''); ?>">
                                        <span class="kfs-card__media"><img src="<?php echo e($kfsImg($news->thumbnail)); ?>"
                                                alt="" loading="lazy"></span>
                                        <span class="kfs-card__body">
                                            <span class="kfs-card__meta">
                                                <span class="kfs-badge"><?php echo e($news->category->name ?? 'أخبار'); ?></span>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->published_at): ?>
                                                    <time datetime="<?php echo e($news->published_at->toDateString()); ?>"><i
                                                            class="fa-regular fa-calendar" aria-hidden="true"></i>
                                                        <?php echo e($news->published_at->translatedFormat('d F Y')); ?></time>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </span>
                                            <span class="kfs-card__title"><?php echo e($news->title); ?></span>
                                            <span class="kfs-card__text"><?php echo e($kfsPlain($news->content, 120)); ?></span>
                                            <span class="kfs-card__more">اقرأ المزيد <i class="fa-solid fa-arrow-left"
                                                    aria-hidden="true"></i></span>
                                        </span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal83cc0afe61fc0b0b7055692555f7bca1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.empty-state','data' => ['icon' => 'docs','title' => 'لا توجد أخبار منشورة بعد','compact' => true,'text' => 'ستظهر هنا آخر أخبار المحافظة وقراراتها فور نشرها.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'docs','title' => 'لا توجد أخبار منشورة بعد','compact' => true,'text' => 'ستظهر هنا آخر أخبار المحافظة وقراراتها فور نشرها.']); ?>
                        <a href="<?php echo e(route('posts.index')); ?>" class="btn-kfs-outline">أرشيف الأخبار</a>
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
            </div>
        </section>

        
        <section class="kfs-sec" id="services-section" aria-labelledby="kfsSvcTitle">
            <div class="container">
                <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsSvcTitle','subtitle' => $kfsText(
                    'services_subtitle',
                    'أنجز معاملاتك الحكومية من أي مكان — اختر الخدمة وابدأ مباشرة.',
                ),'link' => route('services.index'),'linkText' => $kfsText('services_view_all_link_text', 'عرض جميع الخدمات')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsSvcTitle','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText(
                    'services_subtitle',
                    'أنجز معاملاتك الحكومية من أي مكان — اختر الخدمة وابدأ مباشرة.',
                )),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('services.index')),'link-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('services_view_all_link_text', 'عرض جميع الخدمات'))]); ?>
                    <?php echo e($kfsText('services_title', 'خدمات المحافظة')); ?>

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

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->isNotEmpty()): ?>
                    <div class="kfs-grid kfs-grid--3 mb-4" data-stagger>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($service->publicUrl()); ?>"
                                <?php if($service->opensExternally()): ?> target="_blank" rel="noopener" <?php endif; ?>
                                class="kfs-svc kfs-svc--feature">
                                <span class="kfs-svc__icon" aria-hidden="true"><i
                                        class="<?php echo e($service->icon ?: 'fa-solid fa-file-lines'); ?>"></i></span>
                                <span class="kfs-svc__body">
                                    <span class="kfs-svc__title">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->title_line_1 || $service->title_line_2): ?>
                                            <?php echo e(trim(strip_tags($service->title_line_1 . ' ' . $service->title_line_2))); ?>

                                        <?php else: ?>
                                            <?php echo e(strip_tags($service->title)); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->description): ?>
                                        <span class="kfs-svc__desc"><?php echo e($kfsPlain($service->description, 110)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="kfs-card__more">ابدأ الخدمة <i class="fa-solid fa-arrow-left"
                                            aria-hidden="true"></i></span>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsQuick->isNotEmpty()): ?>
                    <div class="kfs-grid kfs-grid--4" data-stagger>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kfsQuick; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($q['url']); ?>"
                                class="kfs-svc <?php echo e($q['tone'] ? 'kfs-svc--' . $q['tone'] : ''); ?>">
                                <span class="kfs-svc__icon" aria-hidden="true"><i
                                        class="<?php echo e($q['icon']); ?>"></i></span>
                                <span class="kfs-svc__body">
                                    <span class="kfs-svc__title"><?php echo e($q['title']); ?></span>
                                    <span class="kfs-svc__desc"><?php echo e($q['desc']); ?></span>
                                </span>
                                <span class="kfs-card__more">ابدأ الخدمة <i class="fa-solid fa-arrow-left"
                                        aria-hidden="true"></i></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($landmarks->isNotEmpty()): ?>
            <?php
                $kfsTourFeature = $landmarks->first();
                $kfsTourRest = $landmarks->slice(1, 4);
                $kfsTourMore = max(0, $landmarks->count() - 5);
            ?>
            <section class="kfs-sec kfs-tourx" aria-labelledby="kfsTourTitle">
                <div class="kfs-tourx__pattern" aria-hidden="true"></div>
                <div class="container position-relative">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsTourTitle','dark' => true,'eyebrow' => 'سياحة وتراث','subtitle' => $kfsText(
                        'tourism_subtitle',
                        'اكتشف أبرز المواقع التاريخية والطبيعية التي تميز محافظة كفرالشيخ.',
                    ),'link' => route('landmarks.index'),'linkText' => $kfsText('tourism_view_all_link_text', 'استكشف كل المعالم')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsTourTitle','dark' => true,'eyebrow' => 'سياحة وتراث','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText(
                        'tourism_subtitle',
                        'اكتشف أبرز المواقع التاريخية والطبيعية التي تميز محافظة كفرالشيخ.',
                    )),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('landmarks.index')),'link-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('tourism_view_all_link_text', 'استكشف كل المعالم'))]); ?>
                        <?php echo e($kfsText('tourism_title', 'أهم المعالم السياحية في المحافظة')); ?>

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

                    <div class="kfs-tourx__grid" data-stagger>
                        
                        <article class="kfs-tourx__card kfs-tourx__card--feature" data-reveal>
                            <img src="<?php echo e($kfsImg($kfsTourFeature->thumbnail)); ?>" alt="" loading="lazy">
                            <div class="kfs-tourx__body">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsTourFeature->address): ?>
                                    <span class="kfs-tourx__loc"><i class="fa-solid fa-location-dot"
                                            aria-hidden="true"></i>
                                        <?php echo e(\Illuminate\Support\Str::limit($kfsTourFeature->address, 60)); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <h3 class="kfs-tourx__title">
                                    <a href="<?php echo e(route('landmarks.show', $kfsTourFeature)); ?>"
                                        class="kfs-tourx__link"><?php echo e($kfsTourFeature->name); ?></a>
                                </h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsPlain($kfsTourFeature->details, 170)): ?>
                                    <p class="kfs-tourx__excerpt"><?php echo e($kfsPlain($kfsTourFeature->details, 170)); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="kfs-tourx__actions">
                                    <span class="kfs-tourx__cta">اكتشف المكان <i class="fa-solid fa-arrow-left"
                                            aria-hidden="true"></i></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsTourFeature->latitude && $kfsTourFeature->longitude): ?>
                                        <a class="kfs-tourx__map"
                                            href="https://www.google.com/maps?q=<?php echo e($kfsTourFeature->latitude); ?>,<?php echo e($kfsTourFeature->longitude); ?>"
                                            target="_blank" rel="noopener">
                                            <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i> على الخريطة
                                            <span class="visually-hidden">(يفتح في نافذة جديدة)</span>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </article>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kfsTourRest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $landmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="kfs-tourx__card" data-reveal>
                                <img src="<?php echo e($kfsImg($landmark->thumbnail)); ?>" alt="" loading="lazy">
                                <div class="kfs-tourx__body">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($landmark->address): ?>
                                        <span class="kfs-tourx__loc"><i class="fa-solid fa-location-dot"
                                                aria-hidden="true"></i>
                                            <?php echo e(\Illuminate\Support\Str::before($landmark->address, ' - ')); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <h3 class="kfs-tourx__title">
                                        <a href="<?php echo e(route('landmarks.show', $landmark)); ?>"
                                            class="kfs-tourx__link"><?php echo e($landmark->name); ?></a>
                                    </h3>
                                </div>
                                <span class="kfs-tourx__arrow" aria-hidden="true"><i
                                        class="fa-solid fa-arrow-left"></i></span>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="kfs-tourx__foot" data-reveal>
                        <p class="kfs-tourx__count">
                            <strong><?php echo e($landmarks->count()); ?></strong>
                            <span><?php echo e($landmarks->count() > 10 ? 'معلمًا' : 'معالم'); ?> سياحية وتاريخية في
                                انتظارك<?php echo e($kfsTourMore ? ' — وغيرها ' . $kfsTourMore . ' في دليل المعالم' : ''); ?></span>
                        </p>
                        <div class="kfs-tourx__btns">
                            <a href="<?php echo e(route('landmarks.index')); ?>" class="kfs-tourx__btn kfs-tourx__btn--gold">
                                <i class="fa-solid fa-compass" aria-hidden="true"></i> دليل المعالم
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\App\Support\EServices::visible('tour-bookings.create')): ?>
                                <a href="<?php echo e(route('tour-bookings.create')); ?>" class="kfs-tourx__btn">
                                    <i class="fa-solid fa-route" aria-hidden="true"></i> احجز رحلة
                                </a>
                            <?php elseif(\App\Support\EServices::visible('tour-bookings.index')): ?>
                                <a href="<?php echo e(route('tour-bookings.index')); ?>" class="kfs-tourx__btn">
                                    <i class="fa-solid fa-route" aria-hidden="true"></i> احجز رحلة
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($settings['tourism_tagline_image'])): ?>
                        <div class="text-center mt-4" data-reveal>
                            <img src="<?php echo e(Storage::url($settings['tourism_tagline_image'])); ?>"
                                alt="كل مكان ليه حكاية مختلفة" class="img-fluid kfs-tourx__tagline" loading="lazy"
                                onerror="this.parentNode.remove()" />
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($investments->isNotEmpty()): ?>
            <section class="kfs-sec" aria-labelledby="kfsInvTitle">
                <div class="container">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsInvTitle','subtitle' => $kfsText('investment_subtitle', 'اكتشف أبرز الفرص الاستثمارية.'),'link' => route('investments.index'),'linkText' => $kfsText('investment_view_all_link_text', 'عرض الفرص الاستثمارية')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsInvTitle','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('investment_subtitle', 'اكتشف أبرز الفرص الاستثمارية.')),'link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('investments.index')),'link-text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('investment_view_all_link_text', 'عرض الفرص الاستثمارية'))]); ?>
                        <?php echo e($kfsText('investment_title', 'الاستثمار في المحافظة')); ?>

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
                    <div class="kfs-grid kfs-grid--2" data-stagger>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $investments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('investments.show', $investment)); ?>" class="kfs-inv">
                                <span class="kfs-card__media"><img src="<?php echo e($kfsImg($investment->thumbnail)); ?>"
                                        alt="" loading="lazy"></span>
                                <span class="kfs-card__body">
                                    <span><span class="kfs-badge kfs-badge--gold"><i class="fa-solid fa-chart-line"
                                                aria-hidden="true"></i> فرصة استثمارية</span></span>
                                    <span class="kfs-card__title"><?php echo e($investment->title); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($investment->description): ?>
                                        <span class="kfs-card__text"><?php echo e($kfsPlain($investment->description, 120)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="kfs-card__more">تفاصيل الفرصة <i class="fa-solid fa-arrow-left"
                                            aria-hidden="true"></i></span>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nationalProjects->isNotEmpty()): ?>
            <section class="kfs-sec kfs-sec--alt" aria-labelledby="kfsProjTitle">
                <div class="container">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsProjTitle','title' => 'المشروعات القومية','subtitle' => 'مشروعات التنمية ومبادرة حياة كريمة في مراكز المحافظة.','link' => route('projects.index'),'linkText' => 'عرض كل المشروعات']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsProjTitle','title' => 'المشروعات القومية','subtitle' => 'مشروعات التنمية ومبادرة حياة كريمة في مراكز المحافظة.','link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('projects.index')),'link-text' => 'عرض كل المشروعات']); ?>
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
                    <div class="kfs-grid kfs-grid--3" data-stagger>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nationalProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('projects.show', $project)); ?>" class="kfs-media">
                                <span class="kfs-card__media"><img src="<?php echo e($kfsImg($project->thumbnail)); ?>"
                                        alt="" loading="lazy"></span>
                                <span class="kfs-card__body">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->category): ?>
                                        <span><span
                                                class="kfs-badge <?php echo e($project->category === 'حياة كريمة' ? 'kfs-badge--olive' : ''); ?>"><?php echo e($project->category); ?></span></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="kfs-card__title"><?php echo e($project->name); ?></span>
                                    <span class="kfs-card__more">تفاصيل المشروع <i class="fa-solid fa-arrow-left"
                                            aria-hidden="true"></i></span>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsPlanUrl): ?>
            <section class="kfs-sec" aria-labelledby="kfsPlanTitle">
                <div class="container">
                    <div class="kfs-plan" data-reveal>
                        <div class="kfs-plan__body">
                            <span class="kfs-badge kfs-badge--gold">خارطة التنمية</span>
                            <h2 class="kfs-plan__title" id="kfsPlanTitle">مشروعات الخطة الاستثمارية لمحافظة كفرالشيخ</h2>
                            <p class="kfs-plan__text">اطّلع على الخطة الاستثمارية السنوية للمحافظة والتقارير الموثقة للعام
                                الحالي والأعوام السابقة — رؤية وطنية لتحسين البنية التحتية والخدمات وتوطين التنمية المستدامة
                                في كافة المراكز.</p>
                            <a href="<?php echo e($kfsPlanUrl); ?>" class="btn-kfs-gold"><span>استكشاف الخطة الكاملة</span><i
                                    class="fa-solid fa-arrow-left" aria-hidden="true"></i></a>
                        </div>
                        <div class="kfs-plan__media"
                            style="background-image: url('<?php echo e(asset('images/bg/investment-plan.jpg')); ?>');"
                            aria-hidden="true">
                            <span class="kfs-plan__logo"><img src="<?php echo e(asset('images/egypt-vision.png')); ?>"
                                    alt="" loading="lazy"></span>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($achievements->isNotEmpty()): ?>
            <section class="kfs-sec kfs-sec--alt" aria-labelledby="kfsAchTitle">
                <div class="container">
                    <div class="row g-4 g-lg-5 align-items-center">
                        <div class="col-lg-6">
                            <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsAchTitle','class' => 'mb-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsAchTitle','class' => 'mb-2']); ?><?php echo e($kfsText('achievements_title', 'إنجازات الدولة')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $attributes = $__attributesOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__attributesOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $component = $__componentOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__componentOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($settings['achievements_description'])): ?>
                                <p class="text-muted mb-0"><?php echo clean($settings['achievements_description'], 'cms'); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <ul class="kfs-checklist" data-stagger>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><i class="fa-solid fa-check"
                                            aria-hidden="true"></i><span><?php echo e($achievement->title); ?></span></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="kfs-ach__media" data-reveal>
                                <img src="<?php echo e($featuredNews && $featuredNews->thumbnail ? Storage::url($featuredNews->thumbnail) : asset('images/image1.png')); ?>"
                                    alt="صورة من إنجازات المحافظة" loading="lazy">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mainAchievementVideo && $mainAchievementVideo->value): ?>
                                    <a href="<?php echo e($mainAchievementVideo->value); ?>" target="_blank" rel="noopener"
                                        class="kfs-ach__play" aria-label="تشغيل فيديو الإنجازات (يفتح في نافذة جديدة)"><i
                                            class="fa-solid fa-play" aria-hidden="true"></i></a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partners->isNotEmpty()): ?>
            <section class="kfs-sec" aria-labelledby="kfsAppsTitle">
                <div class="container">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsAppsTitle','subtitle' => $kfsText('apps_subtitle', '') ?: null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsAppsTitle','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsText('apps_subtitle', '') ?: null)]); ?><?php echo e($kfsText('apps_title', 'مواقع تهمك')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $attributes = $__attributesOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__attributesOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0022f190c341a3369cd359d722b3ef7)): ?>
<?php $component = $__componentOriginale0022f190c341a3369cd359d722b3ef7; ?>
<?php unset($__componentOriginale0022f190c341a3369cd359d722b3ef7); ?>
<?php endif; ?>
                    <div class="kfs-apps" data-reveal>
                        <div class="kfs-apps__list" role="tablist" aria-label="المواقع والتطبيقات">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="kfs-apps__tab" role="tab"
                                    id="kfsAppTab<?php echo e($loop->index); ?>" aria-controls="kfsAppPanel<?php echo e($loop->index); ?>"
                                    aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>"
                                    tabindex="<?php echo e($loop->first ? '0' : '-1'); ?>">
                                    <span><?php echo e($partner->name); ?></span><i class="fa-solid fa-chevron-left"
                                        aria-hidden="true"></i>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="kfs-apps__panel" role="tabpanel" id="kfsAppPanel<?php echo e($loop->index); ?>"
                                    aria-labelledby="kfsAppTab<?php echo e($loop->index); ?>"
                                    <?php if (! ($loop->first)): ?> hidden <?php endif; ?>>
                                    <div class="kfs-apps__img"><img src="<?php echo e($kfsImg($partner->image)); ?>" alt=""
                                            loading="lazy"></div>
                                    <div class="kfs-apps__text">
                                        <h3><?php echo e($partner->name); ?></h3>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partner->description): ?>
                                            <p><?php echo e($partner->description); ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partner->link): ?>
                                            <a href="<?php echo e($partner->link); ?>" target="_blank" rel="noopener"
                                                class="btn-kfs"><span>زيارة الموقع الإلكتروني</span><i
                                                    class="fa-solid fa-arrow-up-right-from-square"
                                                    aria-hidden="true"></i></a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statistics->isNotEmpty()): ?>
            <?php
                $kfsStatLead = $statistics->first();
                $kfsStatRest = $statistics->slice(1);
            ?>
            <section class="kfs-sec kfs-numx" aria-labelledby="kfsStatsTitle">
                <div class="kfs-numx__bg" aria-hidden="true">
                    <svg class="kfs-numx__waves" viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false">
                        <path d="M0 210 C240 170 480 250 720 210 S1200 170 1440 210" />
                        <path d="M0 245 C240 205 480 285 720 245 S1200 205 1440 245" />
                        <path d="M0 280 C240 240 480 320 720 280 S1200 240 1440 280" />
                    </svg>
                </div>
                <div class="container position-relative">
                    <div class="kfs-numx__layout">
                        <div class="kfs-numx__intro" data-reveal>
                            <span class="kfs-numx__eyebrow"><i class="fa-solid fa-chart-simple" aria-hidden="true"></i>
                                بيانات ومؤشرات رسمية</span>
                            <h2 class="kfs-numx__title" id="kfsStatsTitle">
                                <?php echo e($kfsText('stats_title', 'المحافظة في أرقام')); ?></h2>
                            <p class="kfs-numx__sub">
                                <?php echo e($kfsText('stats_subtitle', 'نظرة سريعة على أبرز مؤشرات محافظة كفرالشيخ: السكان والمساحة والخدمات والتنمية.')); ?>

                            </p>

                            
                            <div class="kfs-numx__lead">
                                <span class="kfs-numx__lead-ico" aria-hidden="true"><i
                                        class="<?php echo e($kfsStatLead->icon_class); ?>"></i></span>
                                <div class="kfs-numx__lead-num">
                                    <span class="kfs-count" data-count="<?php echo e($kfsStatLead->number); ?>"
                                        data-decimals="0"><?php echo e(number_format($kfsStatLead->number)); ?></span>
                                </div>
                                <p class="kfs-numx__lead-label"><?php echo e($kfsStatLead->title); ?></p>
                                <svg class="kfs-numx__spark" viewBox="0 0 220 60" aria-hidden="true" focusable="false">
                                    <path class="kfs-numx__spark-area"
                                        d="M0 52 L30 46 L60 48 L90 36 L120 38 L150 24 L180 26 L220 8 L220 60 L0 60Z" />
                                    <path class="kfs-numx__spark-line"
                                        d="M0 52 L30 46 L60 48 L90 36 L120 38 L150 24 L180 26 L220 8" />
                                </svg>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statistics->max('updated_at')): ?>
                                <p class="kfs-numx__note">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    آخر تحديث للبيانات:
                                    <?php echo e(\Illuminate\Support\Carbon::parse($statistics->max('updated_at'))->locale('ar')->translatedFormat('j F Y')); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsStatRest->isNotEmpty()): ?>
                            <ul class="kfs-numx__grid" role="list" data-stagger>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kfsStatRest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="kfs-numx__tile" data-reveal>
                                        <span class="kfs-numx__ico" aria-hidden="true"><i
                                                class="<?php echo e($stat->icon_class); ?>"></i></span>
                                        <span class="kfs-numx__num"><span class="kfs-count"
                                                data-count="<?php echo e($stat->number); ?>"
                                                data-decimals="0"><?php echo e(number_format($stat->number)); ?></span></span>
                                        <span class="kfs-numx__label"><?php echo e($stat->title); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($guideCategories->isNotEmpty()): ?>
            <section class="kfs-sec" aria-labelledby="kfsGuideTitle">
                <div class="container">
                    <?php if (isset($component)) { $__componentOriginale0022f190c341a3369cd359d722b3ef7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0022f190c341a3369cd359d722b3ef7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.section-title','data' => ['id' => 'kfsGuideTitle','subtitle' => 'أماكن الخدمات والمرافق على الخريطة — اختر تصنيفاً لعرضه.','link' => $kfsRoute('governorate.map'),'linkText' => 'الخريطة التفاعلية الكاملة']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.section-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'kfsGuideTitle','subtitle' => 'أماكن الخدمات والمرافق على الخريطة — اختر تصنيفاً لعرضه.','link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($kfsRoute('governorate.map')),'link-text' => 'الخريطة التفاعلية الكاملة']); ?>
                        <?php echo e($kfsText('city_guide_title', 'دليل العاصمة')); ?>

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
                    <div class="kfs-guide" data-reveal>
                        <div class="kfs-guide__side">
                            <ul class="kfs-guide__cats" aria-label="تصنيفات دليل المدينة">
                                <li><button type="button" class="kfs-guide__cat" data-category-id="all"
                                        aria-pressed="true">
                                        <span class="kfs-guide__ico"><i class="fa-solid fa-map-location-dot"
                                                aria-hidden="true"></i></span><span>عرض الكل</span>
                                        <span class="kfs-guide__count"><?php echo e($allLocations->count()); ?></span></button></li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $guideCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><button type="button" class="kfs-guide__cat"
                                            data-category-id="<?php echo e($category->id); ?>" aria-pressed="false">
                                            <span class="kfs-guide__ico"><i class="<?php echo e($category->icon_class); ?>"
                                                    aria-hidden="true"></i></span><span><?php echo e($category->name); ?></span>
                                            <span
                                                class="kfs-guide__count"><?php echo e($category->locations_count ?? $category->locations->count()); ?></span></button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                        <div id="interactiveMap" class="kfs-guide__map" role="region" aria-label="خريطة دليل المدينة">
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsHasMarket): ?>
            <section class="kfs-sec kfs-sec--tight" aria-labelledby="kfsMktTitle">
                <div class="container">
                    <div class="kfs-promo" data-reveal>
                        <span class="kfs-promo__icon" aria-hidden="true"><i
                                class="fa-solid fa-hand-holding-heart"></i></span>
                        <div>
                            <h2 id="kfsMktTitle">متجر ذوي الهمم</h2>
                            <p>منتجات يدوية وإبداعات أصيلة من أبناء المحافظة من ذوي الهمم — كل طلب منك دعمٌ مباشر لهم.</p>
                        </div>
                        <div class="kfs-promo__actions">
                            <a href="<?php echo e(route('market.home')); ?>" class="btn-kfs"><span>تسوّق الآن</span><i
                                    class="fa-solid fa-arrow-left" aria-hidden="true"></i></a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kfsRoute('market.sell')): ?>
                                <a href="<?php echo e($kfsRoute('market.sell')); ?>" class="btn-kfs-outline">انضم كبائع</a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <section class="kfs-sec kfs-sec--tight pt-0" aria-labelledby="kfsLinksTitle">
            <div class="container">
                <h2 class="h5 mb-3" id="kfsLinksTitle">بوابات حكومية مهمة</h2>
                <ul class="kfs-links">
                    <li><a href="https://www.egypt.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-desktop"
                                aria-hidden="true"></i>بوابة مصر الرقمية</a></li>
                    <li><a href="https://jobs.egypt.gov.eg" target="_blank" rel="noopener"><i
                                class="fa-solid fa-briefcase" aria-hidden="true"></i>بوابة الوظائف الحكومية</a></li>
                    <li><a href="https://etenders.gov.eg" target="_blank" rel="noopener"><i
                                class="fa-solid fa-file-signature" aria-hidden="true"></i>بوابة التعاقدات العامة</a></li>
                    <li><a href="https://www.takaful.gov.eg" target="_blank" rel="noopener"><i
                                class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i>التضامن الاجتماعي</a></li>
                    <li><a href="https://www.sis.gov.eg" target="_blank" rel="noopener"><i
                                class="fa-solid fa-circle-info" aria-hidden="true"></i>الهيئة العامة للاستعلامات</a></li>
                </ul>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/kfs-home-search.js')); ?>?v=<?php echo e(@filemtime(public_path('js/kfs-home-search.js'))); ?>" defer>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rtl = (document.documentElement.getAttribute('dir') || 'rtl') === 'rtl';
            var calm = function() {
                return !(window.KFSMotion && window.KFSMotion.ok && window.KFSMotion.ok());
            };

            // Events + tourism sliders (no autoplay — calm by default).
            if (window.Swiper) {
                if (document.querySelector('.kfs-events-swiper')) {
                    new Swiper('.kfs-events-swiper', {
                        slidesPerView: 1.12,
                        spaceBetween: 16,
                        speed: calm() ? 0 : 450,
                        watchOverflow: true,
                        navigation: {
                            nextEl: '.kfs-events-next',
                            prevEl: '.kfs-events-prev'
                        },
                        breakpoints: {
                            576: {
                                slidesPerView: 2,
                                spaceBetween: 20
                            },
                            992: {
                                slidesPerView: 3,
                                spaceBetween: 24
                            }
                        },
                        a11y: {
                            prevSlideMessage: 'السابق',
                            nextSlideMessage: 'التالي'
                        }
                    });
                }
            }

            // Partner apps: accessible tabs (click + arrow keys).
            var tabs = Array.prototype.slice.call(document.querySelectorAll('.kfs-apps__tab'));

            function selectTab(t, focus) {
                tabs.forEach(function(x) {
                    var on = x === t;
                    x.setAttribute('aria-selected', on ? 'true' : 'false');
                    x.tabIndex = on ? 0 : -1;
                    var p = document.getElementById(x.getAttribute('aria-controls'));
                    if (p) p.hidden = !on;
                });
                if (focus) t.focus();
            }
            tabs.forEach(function(t, i) {
                t.addEventListener('click', function() {
                    selectTab(t);
                });
                t.addEventListener('keydown', function(e) {
                    var next = {
                        ArrowDown: 1,
                        ArrowUp: -1,
                        ArrowLeft: rtl ? 1 : -1,
                        ArrowRight: rtl ? -1 : 1
                    } [e.key];
                    if (next) {
                        e.preventDefault();
                        selectTab(tabs[(i + next + tabs.length) % tabs.length], true);
                    }
                });
            });
        });
    </script>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($guideCategories->isNotEmpty()): ?>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (!document.getElementById('interactiveMap') || typeof L === 'undefined') return;
                const locations = <?php echo json_encode($allLocations, 15, 512) ?>;
                const map = L.map('interactiveMap', {
                    scrollWheelZoom: false
                }).setView([31.1143, 30.9416], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    maxZoom: 19
                }).addTo(map);

                const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (c) => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [c]));
                const markers = {};
                const all = [];
                locations.forEach(location => {
                    if (!location.latitude || !location.longitude) return;
                    const icon = L.divIcon({
                        className: 'custom-leaflet-icon',
                        html: `<i class="${esc(location.city_guide_category ? location.city_guide_category.icon_class : 'fa-solid fa-location-dot')}"></i>`,
                        iconSize: [30, 30],
                    });
                    const marker = L.marker([location.latitude, location.longitude], {
                            icon: icon
                        })
                        .addTo(map)
                        .bindPopup(
                            `<div class="popup-title">${esc(location.name)}</div>
                            <a class="popup-link" href="https://maps.google.com/?q=${encodeURIComponent(location.latitude + ',' + location.longitude)}" target="_blank" rel="noopener">عرض على خرائط جوجل</a>`
                            );
                    (markers[location.city_guide_category_id] = markers[location.city_guide_category_id] || [])
                    .push(marker);
                    all.push(marker);
                });
                if (all.length) {
                    map.fitBounds(L.featureGroup(all).getBounds().pad(0.15));
                }

                document.querySelectorAll('.kfs-guide__cat').forEach(button => {
                    button.addEventListener('click', function() {
                        document.querySelectorAll('.kfs-guide__cat').forEach(btn => btn.setAttribute(
                            'aria-pressed', 'false'));
                        this.setAttribute('aria-pressed', 'true');
                        const id = this.dataset.categoryId;
                        all.forEach(m => map.removeLayer(m));
                        (id === 'all' ? all : (markers[id] || [])).forEach(m => m.addTo(map));
                    });
                });
            });
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/home/index.blade.php ENDPATH**/ ?>