
<?php if (isset($component)) { $__componentOriginala163ca60aae7ec30be728264afaa3c4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala163ca60aae7ec30be728264afaa3c4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.kfs.portal-assets','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('kfs.portal-assets'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala163ca60aae7ec30be728264afaa3c4d)): ?>
<?php $attributes = $__attributesOriginala163ca60aae7ec30be728264afaa3c4d; ?>
<?php unset($__attributesOriginala163ca60aae7ec30be728264afaa3c4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala163ca60aae7ec30be728264afaa3c4d)): ?>
<?php $component = $__componentOriginala163ca60aae7ec30be728264afaa3c4d; ?>
<?php unset($__componentOriginala163ca60aae7ec30be728264afaa3c4d); ?>
<?php endif; ?>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\modules\Syndicate/resources/views/web/_styles.blade.php ENDPATH**/ ?>