<?php
    use Modules\SiteValidity\Support\SvSettings;
    $title = SvSettings::get('page_title');
    $minFee = $types->min(fn ($t) => (float) $t->fee) ?: (float) SvSettings::defaultFee();
?>
<?php $__env->startSection('title', $title . ' — ' . ($settings['site_name'] ?? 'محافظة كفر الشيخ')); ?>
<?php $__env->startSection('description', \Illuminate\Support\Str::limit(SvSettings::get('page_intro'), 160)); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e($svCssUrl); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal41b59b94795194d9da2e0c0b1158fd94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b59b94795194d9da2e0c0b1158fd94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.page-hero','data' => ['title' => $title,'kicker' => SvSettings::get('page_kicker'),'icon' => 'fa-solid fa-map-location-dot','subtitle' => SvSettings::get('page_intro'),'crumbs' => ['الخدمات الإلكترونية' => route('services.index')]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'kicker' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(SvSettings::get('page_kicker')),'icon' => 'fa-solid fa-map-location-dot','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(SvSettings::get('page_intro')),'crumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['الخدمات الإلكترونية' => route('services.index')])]); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('site-validity.apply')); ?>" class="btn-kfs-gold"><i class="fa-solid fa-file-circle-plus" aria-hidden="true"></i> تقديم طلب جديد</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('site-validity.requests.index')); ?>" class="btn-kfs-outline"><i class="fa-solid fa-list-check" aria-hidden="true"></i> طلباتي</a>
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

    <section class="sv-page">
        <div class="container">
            <div class="sv-layout">
                <div>
                    <div class="sv-card">
                        <h2 class="sv-card__title"><i class="fa-solid fa-route" aria-hidden="true"></i> خطوات الحصول على الخدمة</h2>
                        <ol class="sv-steps">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $instructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($line); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ol>
                    </div>

                    <div class="sv-card">
                        <h2 class="sv-card__title"><i class="fa-solid fa-folder-open" aria-hidden="true"></i> المستندات المطلوبة</h2>
                        <ul class="sv-checks">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><i class="fa-solid fa-circle-check" aria-hidden="true"></i><span><?php echo e($doc); ?></span></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                        <p class="sv-muted sv-small mt-3 mb-0">الصيغ المقبولة: PDF أو صورة (JPG / PNG) بحد أقصى <?php echo e((int) (config('site-validity.citizen_upload.max_kb') / 1024)); ?> ميجابايت لكل ملف.</p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($types->isNotEmpty()): ?>
                        <div class="sv-card">
                            <h2 class="sv-card__title"><i class="fa-solid fa-layer-group" aria-hidden="true"></i> أنواع الخدمة والرسوم</h2>
                            <div class="sv-types">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="sv-type">
                                        <span class="sv-type__name"><?php echo e($type->name); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->description): ?>
                                            <span class="sv-type__desc"><?php echo e($type->description); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <span class="sv-fee"><?php echo e(number_format((float) $type->fee, 2)); ?> <small>ج.م</small></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <aside class="sv-card sv-cta" aria-label="ابدأ الطلب">
                    <p class="sv-muted mb-1">الرسوم تبدأ من</p>
                    <p class="sv-cta__price mb-2"><?php echo e(number_format($minFee, 2)); ?> <small class="sv-small sv-muted">ج.م</small></p>
                    <p class="sv-small sv-muted"><?php echo e(SvSettings::get('cost_note')); ?></p>
                    <a href="<?php echo e(route('site-validity.apply')); ?>" class="sv-btn sv-btn--block mb-2">
                        <i class="fa-solid fa-file-circle-plus" aria-hidden="true"></i> تقديم طلب صلاحية موقع
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                        <p class="sv-small sv-muted mb-2">يجب تسجيل الدخول بحساب المواطن أولاً.</p>
                        <a href="<?php echo e(route('register.citizen')); ?>" class="sv-btn sv-btn--ghost sv-btn--block">
                            <i class="fa-solid fa-user-plus" aria-hidden="true"></i> إنشاء حساب جديد
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('site-validity.requests.index')); ?>" class="sv-btn sv-btn--ghost sv-btn--block">
                            <i class="fa-solid fa-list-check" aria-hidden="true"></i> متابعة طلباتي
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <hr>
                    <ul class="sv-checks sv-small">
                        <li><i class="fa-solid fa-lock" aria-hidden="true"></i><span>ملفاتك محفوظة بشكل خاص ولا يطلع عليها إلا الموظف المختص.</span></li>
                        <li><i class="fa-solid fa-bell" aria-hidden="true"></i><span>تصلك إشعارات بكل مرحلة على البوابة والبريد الإلكتروني.</span></li>
                        <li><i class="fa-solid fa-credit-card" aria-hidden="true"></i><span>السداد إلكترونياً عبر e-Finance من صفحة الطلب.</span></li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\modules/SiteValidity/resources/views/web/landing.blade.php ENDPATH**/ ?>