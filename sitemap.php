<?php
header("Content-Type: application/xml; charset=UTF-8");

$staticPages = [
    [
        'loc' => 'https://fanciwheel.com/',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://fanciwheel.com/?lang=en',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://fanciwheel.com/about?lang=en',
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://fanciwheel.com/about',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
    [
        'loc' => 'https://fanciwheel.com/services',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
    [
        'loc' => 'https://fanciwheel.com/services?lang=en',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
];

$games = [
    [
        'loc' => 'https://fanciwheel.com/detail?slug=dhaka-to-chittagong-bus-counter&lang=en'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?slug=how-to-travel-from-chittagong-to-dhaka&lang=en'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?slug=dhaka-to-chittagong-bus-counter&lang=bn'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?lang=bn&slug=how-to-travel-from-chittagong-to-dhaka'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?lang=en&slug=how-to-make-bangladeshi-milk-tea-5-steps-guide'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?slug=how-to-make-bangladeshi-milk-tea-5-steps-guide&lang=bn'
    ],
];

// Merge all pages
$allPages = array_merge($staticPages, $games);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($allPages as $page): ?>
        <url>
            <loc><?= htmlspecialchars($page['loc']) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq><?= $page['changefreq'] ?? 'weekly' ?></changefreq>
            <priority><?= $page['priority'] ?? '0.8' ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>