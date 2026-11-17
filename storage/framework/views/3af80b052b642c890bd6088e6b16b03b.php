
<?php
    $seoSite = 'محافظة كفر الشيخ';
    $seoPlain = fn ($v) => trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $v), ENT_QUOTES | ENT_HTML5, 'UTF-8')));

    // Description: page → settings (ignored while it is still the admin placeholder) → built-in.
    $seoSettingDesc = $seoPlain($settings['site_description'] ?? '');
    $seoDefaultDesc = (mb_strlen($seoSettingDesc) >= 40 && ! str_contains($seoSettingDesc, 'وصف موجز'))
        ? $seoSettingDesc
        : 'الموقع الرسمي لمحافظة كفر الشيخ: الخدمات الإلكترونية للمواطنين، أخبار المحافظة، المشروعات القومية، فرص الاستثمار، المعالم السياحية وأرقام الطوارئ.';
    $seoDesc = \Illuminate\Support\Str::limit($seoPlain($__env->yieldContent('description')) ?: $seoDefaultDesc, 300, '…');

    // Title: «page | محافظة كفر الشيخ» unless the page title already names the governorate.
    $seoPageTitle = $seoPlain($__env->yieldContent('title'));
    $seoTitle = $seoPageTitle === ''
        ? ($seoPlain($settings['site_name'] ?? '') ?: 'الموقع الرسمي لمحافظة كفر الشيخ')
        : (str_contains($seoPageTitle, 'كفر الشيخ') ? $seoPageTitle : $seoPageTitle . ' | ' . $seoSite);

    // Share image: page → admin default (Settings) → branded 1200×630 card.
    $seoAbs = fn ($u) => \Illuminate\Support\Str::startsWith($u, ['http://', 'https://']) ? $u : url($u);
    $seoImage = trim($__env->yieldContent('og_image'));
    $seoIsDefaultImage = $seoImage === '';
    if ($seoIsDefaultImage) {
        $seoImage = !empty($settings['og_default_image']) ? Storage::url($settings['og_default_image']) : asset('images/og/kfs-share.jpg');
    }
    $seoImage = $seoAbs($seoImage);
    $seoType = trim($__env->yieldContent('og_type')) ?: 'website';

    // Canonical: path only, keeping ?page=N (paginated lists are distinct pages).
    $seoPage = (int) request()->query('page', 1);
    $seoCanonical = url()->current() . ($seoPage > 1 ? '?page=' . $seoPage : '');

    // Private / transactional pages are kept out of search engines.
    $seoNoindex = trim($__env->yieldContent('robots')) === 'noindex' || request()->is(
        'login', 'logout', 'register*', 'password*', 'forgot-password', 'reset-password*', 'two-factor*',
        'payments*', 'efinance*', 'receipts*', 'dashboard*', 'citizen*', 'account*', 'secure-files*',
        'store/cart*', 'store/checkout*', 'store/orders*', 'store/wishlist*', 'store/sell*',
        'syndicate*', 'erp-governorate*', 'admin*', 'search*', 'wait', 'services/success*'
    );

    $seoTwitter = ltrim((string) parse_url((string) ($settings['social_twitter'] ?? ''), PHP_URL_PATH), '/');
?>
<title><?php echo e($seoTitle); ?></title>
<meta name="description" content="<?php echo e($seoDesc); ?>" />
<meta name="robots" content="<?php echo e($seoNoindex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1'); ?>" />
<link rel="canonical" href="<?php echo e($seoCanonical); ?>" />
<link rel="alternate" href="<?php echo e($seoCanonical); ?>" hreflang="ar" />
<link rel="alternate" href="<?php echo e($seoCanonical); ?>" hreflang="x-default" />
<meta name="author" content="<?php echo e($seoSite); ?>" />


<meta property="og:site_name" content="<?php echo e($seoSite); ?>" />
<meta property="og:locale" content="ar_EG" />
<meta property="og:type" content="<?php echo e($seoType); ?>" />
<meta property="og:title" content="<?php echo e($seoTitle); ?>" />
<meta property="og:description" content="<?php echo e($seoDesc); ?>" />
<meta property="og:url" content="<?php echo e($seoCanonical); ?>" />
<meta property="og:image" content="<?php echo e($seoImage); ?>" />
<meta property="og:image:secure_url" content="<?php echo e($seoImage); ?>" />
<meta property="og:image:alt" content="<?php echo e($seoPageTitle ?: $seoSite); ?>" />
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seoIsDefaultImage && empty($settings['og_default_image'])): ?>
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<meta name="twitter:card" content="summary_large_image" />
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seoTwitter): ?>
    <meta name="twitter:site" content="<?php echo e('@' . $seoTwitter); ?>" />
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<meta name="twitter:title" content="<?php echo e($seoTitle); ?>" />
<meta name="twitter:description" content="<?php echo e($seoDesc); ?>" />
<meta name="twitter:image" content="<?php echo e($seoImage); ?>" />
<meta name="twitter:image:alt" content="<?php echo e($seoPageTitle ?: $seoSite); ?>" />


<?php
    $seoSameAs = collect(['social_facebook', 'social_twitter', 'social_instagram', 'social_youtube', 'social_tiktok'])
        ->map(fn ($k) => trim((string) ($settings[$k] ?? '')))->filter(fn ($u) => \Illuminate\Support\Str::startsWith($u, 'http'))->values()->all();
    $seoOrg = [
        '@context' => 'https://schema.org',
        '@type' => 'GovernmentOrganization',
        '@id' => url('/') . '#organization',
        'name' => $seoSite,
        'alternateName' => ['Kafr El Sheikh Governorate', 'محافظة كفرالشيخ'],
        'url' => url('/'),
        'logo' => asset('logo.png'),
        'image' => asset('images/og/kfs-share.jpg'),
        'areaServed' => ['@type' => 'AdministrativeArea', 'name' => 'كفر الشيخ', 'containedInPlace' => ['@type' => 'Country', 'name' => 'مصر']],
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'كفر الشيخ', 'addressCountry' => 'EG'],
        'sameAs' => $seoSameAs,
    ];
?>
<script type="application/ld+json"><?php echo json_encode($seoOrg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->routeIs('home') && Route::has('search')): ?>
    <script type="application/ld+json"><?php echo json_encode([
        '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'name' => $seoSite,
        'url' => url('/'),
        'inLanguage' => 'ar',
        'publisher' => ['@id' => url('/') . '#organization'],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => ['@type' => 'EntryPoint', 'urlTemplate' => route('search') . '?query={search_term_string}'],
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php echo $__env->yieldPushContent('seo'); ?>
<?php /**PATH D:\xamp\htdocs\محافظة\kfs new website\kfs_website_test\resources\views/includes/seo.blade.php ENDPATH**/ ?>