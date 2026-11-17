<?php $__env->startSection('title', 'الاستعلام عن شهادة الإشراف الهندسي'); ?>

<?php echo $__env->make('syndicate::web._styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
    <main class="main-content kfs-portal">
        <?php if (isset($component)) { $__componentOriginal41b59b94795194d9da2e0c0b1158fd94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41b59b94795194d9da2e0c0b1158fd94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.page-hero','data' => ['title' => 'الاستعلام عن الإشراف الهندسي على المواقع','kicker' => 'خدمة استعلام عامة','subtitle' => 'شهادات الإشراف وإلغاء الإشراف الصادرة من نقابة المهندسين والمسجلة لدى مجالس المدن','icon' => 'fa-solid fa-helmet-safety','image' => asset('images/bg/complaint.jpg')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.page-hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'الاستعلام عن الإشراف الهندسي على المواقع','kicker' => 'خدمة استعلام عامة','subtitle' => 'شهادات الإشراف وإلغاء الإشراف الصادرة من نقابة المهندسين والمسجلة لدى مجالس المدن','icon' => 'fa-solid fa-helmet-safety','image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('images/bg/complaint.jpg'))]); ?>
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

        <div class="syn-page" dir="rtl">
            <div class="container syn-wrap">
                <section class="syn-search" data-reveal aria-labelledby="lookup-search-title">
                    <h2 id="lookup-search-title"><span class="kfs-iframe" aria-hidden="true"><i class="fas fa-search"></i></span> ابحث عن مشروع أو شهادة أو معاملة</h2>
                    <p class="syn-search__lead">أدخل <strong>الرقم القومي للمالك</strong> لعرض حالة الإشراف على مشروعاته، أو <strong>رقم الشهادة</strong> (SYN-SUP-…) للتحقق منها، أو <strong>رقم المعاملة</strong> (SYN-REQ-…) لمتابعة طلبك.</p>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <div class="syn-banner danger" role="alert"><i class="fas fa-exclamation-circle" aria-hidden="true"></i><div><?php echo e($errors->first()); ?></div></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form action="<?php echo e(route('citizen-lookup.search')); ?>" method="GET" role="search">
                        <div class="syn-search__bar">
                            <div class="syn-search__field">
                                <label for="q" class="visually-hidden">الرقم القومي أو رقم الشهادة أو رقم المعاملة</label>
                                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                <input type="text" id="q" name="q" class="syn-input" dir="ltr"
                                       value="<?php echo e($searched ?? old('q')); ?>" maxlength="40" required autocomplete="off"
                                       aria-describedby="lookup-formats"
                                       placeholder="29001011234567 / SYN-SUP-2026-000045 / SYN-REQ-2026-000123">
                            </div>
                            <button type="submit" class="syn-btn syn-btn-primary"><i class="fas fa-search" aria-hidden="true"></i> بحث</button>
                        </div>
                    </form>
                    <ul class="syn-chips" id="lookup-formats" aria-label="صيغ البحث المقبولة">
                        <li><i class="fa-solid fa-id-card" aria-hidden="true"></i> <b>الرقم القومي</b> 14 رقمًا</li>
                        <li><i class="fa-solid fa-certificate" aria-hidden="true"></i> <b>شهادة</b> <code>SYN-SUP-…</code></li>
                        <li><i class="fa-solid fa-file-signature" aria-hidden="true"></i> <b>معاملة</b> <code>SYN-REQ-…</code></li>
                    </ul>
                    <div class="syn-links">
                        <a href="<?php echo e(route('syndicate.verify.form')); ?>"><i class="fas fa-qrcode" aria-hidden="true"></i> التحقق من شهادة برمز QR</a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('syndicate.my-projects')); ?>"><i class="fas fa-hard-hat" aria-hidden="true"></i> مشروعاتي وشهاداتي</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($notFound)): ?>
                    <?php if (isset($component)) { $__componentOriginal83cc0afe61fc0b0b7055692555f7bca1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83cc0afe61fc0b0b7055692555f7bca1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.empty-state','data' => ['icon' => 'search','title' => 'لم يتم العثور على نتائج.','dataReveal' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'search','title' => 'لم يتم العثور على نتائج.','data-reveal' => true]); ?>
                        <p class="kfs-empty__text mb-0">لا توجد مشروعات أو شهادات أو معاملات مسجلة بالرقم: <span dir="ltr"><?php echo e($searched); ?></span></p>
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

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($transaction)): ?>
                    <?php $r = $transaction; ?>
                    <section class="syn-card syn-card--accent" aria-label="المعاملة" data-reveal>
                        <div class="syn-card__head">
                            <div>
                                <span class="kfs-iframe" aria-hidden="true"><i class="fa-solid fa-file-signature"></i></span>
                                <div>
                                    <h3><?php echo e($r->type_label); ?> — <span dir="ltr"><?php echo e($r->transaction_number); ?></span></h3>
                                    <span class="syn-card__meta">معاملة إشراف هندسي</span>
                                </div>
                            </div>
                            <span class="syn-badge <?php echo e(['danger' => 'danger', 'success' => 'success', 'warning' => 'warning', 'gray' => 'gray'][\Modules\Syndicate\Models\SyndicateRequest::statusColors()[$r->status] ?? ''] ?? 'info'); ?>"><?php echo e($r->status_label); ?></span>
                        </div>
                        <div class="syn-grid">
                            <div class="syn-field"><small>تاريخ التقديم</small><strong><?php echo e($r->created_at?->format('Y-m-d')); ?></strong></div>
                            <div class="syn-field"><small>المركز</small><strong><?php echo e($r->project?->center); ?></strong></div>
                            <div class="syn-field"><small>حالة المشروع</small>
                                <span class="syn-badge <?php echo e(\Modules\Syndicate\Models\Project::workStatusColors()[$r->project?->work_status] ?? 'gray'); ?>"><?php echo e($r->project?->work_status_label); ?></span></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->certificate): ?>
                                <div class="syn-field"><small>الشهادة الصادرة</small>
                                    <strong><a dir="ltr" href="<?php echo e(route('syndicate.verify.show', $r->certificate->number)); ?>"><?php echo e($r->certificate->number); ?></a></strong></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->status === 'rejected' && $r->rejection_reason): ?>
                                <div class="syn-field syn-field--full"><small>سبب الرفض</small><strong><?php echo e($r->rejection_reason); ?></strong></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($projects) && $projects->isNotEmpty()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $active = $project->activeCertificate; ?>
                        <section class="syn-card syn-card--accent" aria-label="مشروع <?php echo e($project->code); ?>" data-reveal>
                            <div class="syn-card__head">
                                <div>
                                    <span class="kfs-iframe" aria-hidden="true"><i class="fa-solid fa-building"></i></span>
                                    <div>
                                        <h3>مشروع <span dir="ltr"><?php echo e($project->code); ?></span></h3>
                                        <span class="syn-card__meta"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?php echo e($project->center); ?></span>
                                    </div>
                                </div>
                                <span class="syn-badge <?php echo e(\Modules\Syndicate\Models\Project::workStatusColors()[$project->work_status] ?? 'gray'); ?>"><?php echo e($project->work_status_label); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->isSuspended()): ?>
                                <div class="syn-banner danger" role="alert"><i class="fas fa-hand-paper" aria-hidden="true"></i>
                                    <div><strong>الأعمال موقوفة — لا يوجد مهندس مشرف</strong> منذ <?php echo e($project->suspended_at?->format('Y-m-d')); ?>. يجب إيقاف الأعمال لحين صدور شهادة إشراف جديدة.</div></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="syn-grid">
                                <div class="syn-field"><small>رقم الترخيص</small><strong><?php echo e($project->license_number ?? '-'); ?></strong></div>
                                <div class="syn-field"><small>المهندس المشرف</small><strong><?php echo e($active?->engineer_name ?? 'لا يوجد'); ?></strong></div>
                                <div class="syn-field"><small>رقم عضوية النقابة</small><strong><?php echo e($active?->engineer_syndicate_number ?? '-'); ?></strong></div>
                                <div class="syn-field"><small>شهادة الإشراف السارية</small>
                                    <strong><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($active): ?><a dir="ltr" href="<?php echo e(route('syndicate.verify.show', $active->number)); ?>"><?php echo e($active->number); ?></a><?php else: ?> - <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></strong></div>
                            </div>
                        </section>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($legacy) && $legacy->isNotEmpty()): ?>
                    <section class="syn-card" aria-labelledby="legacy-title" data-reveal>
                        <div class="syn-card__head">
                            <div>
                                <span class="kfs-iframe" aria-hidden="true"><i class="fa-solid fa-box-archive"></i></span>
                                <div><h3 id="legacy-title">شهادات إشراف مسجلة سابقاً</h3></div>
                            </div>
                        </div>
                        <div class="syn-table-wrap">
                            <table class="syn-table syn-table--stack">
                                <thead><tr><th scope="col">رقم الشهادة</th><th scope="col">نوع التدخل</th><th scope="col">المهندس</th><th scope="col">رقم الترخيص</th><th scope="col">المدينة</th></tr></thead>
                                <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $legacy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-label="رقم الشهادة" dir="ltr"><?php echo e($c->number ?? '-'); ?></td>
                                        <td data-label="نوع التدخل"><?php echo e($c->type_label); ?> <?php echo e($c->sub_type_label ? '(' . $c->sub_type_label . ')' : ''); ?></td>
                                        <td data-label="المهندس"><?php echo e($c->engineer_name); ?></td>
                                        <td data-label="رقم الترخيص"><?php echo e($c->license_number); ?></td>
                                        <td data-label="المدينة"><?php echo e($c->city); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/lookup/index.blade.php ENDPATH**/ ?>