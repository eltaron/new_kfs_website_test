<?php
    $kfsFooterLogo = !empty($settings['site_logo_footer'])
        ? Storage::url($settings['site_logo_footer'])
        : (!empty($settings['site_logo_header']) ? Storage::url($settings['site_logo_header']) : asset('logo.png'));
    $socials = [
        'facebook'  => ['fa-facebook-f', $settings['social_facebook'] ?? '', 'فيسبوك'],
        'twitter'   => ['fa-x-twitter',  $settings['social_twitter'] ?? '', 'إكس (تويتر)'],
        'instagram' => ['fa-instagram',  $settings['social_instagram'] ?? '', 'إنستجرام'],
        'youtube'   => ['fa-youtube',    $settings['social_youtube'] ?? '', 'يوتيوب'],
        'tiktok'    => ['fa-tiktok',     $settings['social_tiktok'] ?? '', 'تيك توك'],
    ];
    // Fallback to the official accounts already listed in the mobile menu when none are configured.
    if (!collect($socials)->contains(fn ($s) => !empty($s[1]))) {
        $socials['facebook'][1] = 'https://www.facebook.com/KafrelsheikhGovernorate';
        $socials['twitter'][1] = 'https://x.com/kfs_gov';
        $socials['youtube'][1] = 'https://youtube.com/@kafrelsheikhgovernorate583';
        $socials['instagram'][1] = 'https://www.instagram.com/kafr_elsheikh_gov';
    }
    $kfsFooterQuick = [
        ['fa-solid fa-file-pen', 'تقديم شكوى أو بلاغ', 'منظومة الشكاوى الحكومية', route('requests.index')],
        ['fa-solid fa-address-book', 'دليل الهاتف', 'أرقام الطوارئ والخدمات', route('directory.index')],
        ['fa-solid fa-headset', 'الدعم الفني', 'نرد عليك في أقرب وقت', route('contact.index')],
        ['fa-solid fa-map-location-dot', 'الخريطة التفاعلية', 'المراكز والخدمات على الخريطة', route('governorate.map')],
    ];
?>
<footer class="site-footer-new kfs-footer kfs-footer--rich" role="contentinfo">
    <div class="kfs-footer__top" aria-hidden="true">
        <?php if (isset($component)) { $__componentOriginal4a64e495c5d7bdd1a9e6622470f37d0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a64e495c5d7bdd1a9e6622470f37d0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.wave','data' => ['position' => 'bottom','fill' => 'var(--kfs-footer-bg, var(--kfs-dark-2))','back' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.wave'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'bottom','fill' => 'var(--kfs-footer-bg, var(--kfs-dark-2))','back' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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
    </div>
    <div class="kfs-footer__watermark" aria-hidden="true"><?php if (isset($component)) { $__componentOriginal40aff3c1f71d687ae197efb877dcec3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40aff3c1f71d687ae197efb877dcec3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.lotus','data' => ['size' => 320]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.lotus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 320]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40aff3c1f71d687ae197efb877dcec3e)): ?>
<?php $attributes = $__attributesOriginal40aff3c1f71d687ae197efb877dcec3e; ?>
<?php unset($__attributesOriginal40aff3c1f71d687ae197efb877dcec3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40aff3c1f71d687ae197efb877dcec3e)): ?>
<?php $component = $__componentOriginal40aff3c1f71d687ae197efb877dcec3e; ?>
<?php unset($__componentOriginal40aff3c1f71d687ae197efb877dcec3e); ?>
<?php endif; ?></div>
    <div class="container">
        <div class="kfs-footer__help" data-reveal>
            <div class="kfs-footer__help-intro">
                <span class="kfs-footer__help-ico" aria-hidden="true"><i class="fa-solid fa-hand-holding-heart"></i></span>
                <div>
                    <h2 class="kfs-footer__help-title">كيف يمكننا مساعدتك؟</h2>
                    <p class="kfs-footer__help-sub">وصول سريع لأهم قنوات خدمة المواطنين.</p>
                </div>
            </div>
            <ul class="kfs-footer__quick" data-stagger>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kfsFooterQuick; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($q[3]); ?>" class="kfs-footer__qitem">
                            <span class="kfs-footer__qicon" aria-hidden="true"><i class="<?php echo e($q[0]); ?>"></i></span>
                            <span class="kfs-footer__qtext"><strong><?php echo e($q[1]); ?></strong><small><?php echo e($q[2]); ?></small></span>
                            <i class="fa-solid fa-arrow-left kfs-footer__qarrow" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
        <?php if (isset($component)) { $__componentOriginale4ff900e0ffa7788f8aca44b1a37125d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4ff900e0ffa7788f8aca44b1a37125d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.heritage','data' => ['width' => 260,'light' => true,'class' => 'kfs-footer__orn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.heritage'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['width' => 260,'light' => true,'class' => 'kfs-footer__orn']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4ff900e0ffa7788f8aca44b1a37125d)): ?>
<?php $attributes = $__attributesOriginale4ff900e0ffa7788f8aca44b1a37125d; ?>
<?php unset($__attributesOriginale4ff900e0ffa7788f8aca44b1a37125d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4ff900e0ffa7788f8aca44b1a37125d)): ?>
<?php $component = $__componentOriginale4ff900e0ffa7788f8aca44b1a37125d; ?>
<?php unset($__componentOriginale4ff900e0ffa7788f8aca44b1a37125d); ?>
<?php endif; ?>
    </div>
    <div class="container">
        <div class="kfs-footer__grid" data-stagger>
            <div class="kfs-footer__brand footer-brand-col">
                <img src="<?php echo e($kfsFooterLogo); ?>" alt="شعار <?php echo e($settings['site_name'] ?? 'محافظة كفر الشيخ'); ?>" class="footer-logo-main" width="76" height="74" loading="lazy">
                <p class="footer-desc">
                    <?php echo e($settings['footer_description'] ?? 'الموقع الرسمي لمحافظة كفر الشيخ — نعمل معاً لخدمة المواطن وتحقيق التنمية المستدامة.'); ?>

                </p>
                <div class="kfs-footer__socials footer-socials">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data[1]): ?>
                            <a href="<?php echo e($data[1]); ?>" class="social-<?php echo e($name); ?>" aria-label="<?php echo e($data[2]); ?> (يفتح في نافذة جديدة)" target="_blank" rel="noopener">
                                <i class="fa-brands <?php echo e($data[0]); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <nav aria-labelledby="footerGovTitle">
                <h2 class="footer-heading" id="footerGovTitle">المحافظة</h2>
                <ul class="footer-links">
                    <li><a href="<?php echo e(route('about')); ?>"><i class="fa-solid fa-landmark-flag" aria-hidden="true"></i>عن المحافظة</a></li>
                    <li><a href="<?php echo e(route('about.governor')); ?>"><i class="fa-solid fa-feather-pointed" aria-hidden="true"></i>كلمة المحافظ</a></li>
                    <li><a href="<?php echo e(route('posts.index')); ?>"><i class="fa-solid fa-newspaper" aria-hidden="true"></i>الأخبار</a></li>
                    <li><a href="<?php echo e(route('projects.index')); ?>"><i class="fa-solid fa-building-flag" aria-hidden="true"></i>المشروعات</a></li>
                    <li><a href="<?php echo e(route('investments.index')); ?>"><i class="fa-solid fa-chart-line" aria-hidden="true"></i>الاستثمار</a></li>
                    <li><a href="<?php echo e(route('landmarks.index')); ?>"><i class="fa-solid fa-monument" aria-hidden="true"></i>السياحة</a></li>
                </ul>
            </nav>

            <nav aria-labelledby="footerServicesTitle">
                <h2 class="footer-heading" id="footerServicesTitle">الخدمات والتواصل</h2>
                <ul class="footer-links">
                    <li><a href="<?php echo e(route('services.index')); ?>"><i class="fa-solid fa-hand-holding-hand" aria-hidden="true"></i>الخدمات الإلكترونية</a></li>
                    <li><a href="<?php echo e(route('requests.index')); ?>"><i class="fa-solid fa-file-pen" aria-hidden="true"></i>الشكاوى والبلاغات</a></li>
                    <li><a href="<?php echo e(route('governorate.map')); ?>"><i class="fa-solid fa-map" aria-hidden="true"></i>الخريطة التفاعلية</a></li>
                    <li><a href="<?php echo e(route('directory.index')); ?>"><i class="fa-solid fa-address-book" aria-hidden="true"></i>دليل الهاتف</a></li>
                    <li><a href="<?php echo e(route('contact.index')); ?>"><i class="fa-solid fa-headset" aria-hidden="true"></i>تواصل معنا</a></li>
                </ul>
            </nav>

            <nav aria-labelledby="footerLinksTitle">
                <h2 class="footer-heading" id="footerLinksTitle">مواقع مهمة</h2>
                <ul class="footer-links">
                    <li><a href="https://www.egypt.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-desktop" aria-hidden="true"></i>مصر الرقمية</a></li>
                    <li><a href="https://jobs.egypt.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-briefcase" aria-hidden="true"></i>بوابة الوظائف</a></li>
                    <li><a href="https://etenders.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-file-signature" aria-hidden="true"></i>بوابة التعاقدات</a></li>
                    <li><a href="https://www.takaful.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i>التضامن الاجتماعي</a></li>
                    <li><a href="https://www.sis.gov.eg" target="_blank" rel="noopener"><i class="fa-solid fa-circle-info" aria-hidden="true"></i>الهيئة العامة للاستعلامات</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="kfs-footer__bottom footer-copyright">
        <div class="container">
            <span class="footer-copy-text">
                <?php echo clean($settings['copyright_text'] ?? 'جميع الحقوق محفوظة &copy; محافظة كفر الشيخ', "cms"); ?>

                <span class="footer-year-badge" id="footer-year"></span>
            </span>
            <div class="kfs-footer__tools">
                <button type="button" data-a11y-open><i class="fa-solid fa-universal-access" aria-hidden="true"></i> أدوات الإتاحة</button>
                <button type="button" data-voice-help><i class="fa-solid fa-microphone-lines" aria-hidden="true"></i> الأوامر الصوتية</button>
                <button type="button" data-pwa-install hidden><i class="fa-solid fa-download" aria-hidden="true"></i> تثبيت التطبيق</button>
                <button type="button" data-motion-toggle aria-pressed="false"><i class="fa-solid fa-circle-pause" aria-hidden="true"></i> <span class="lbl">إيقاف الحركة</span></button>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/includes/footer.blade.php ENDPATH**/ ?>