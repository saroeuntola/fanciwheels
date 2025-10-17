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
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-your-way-from-chittagong-to-dhaka-your-ultimate-travel-guide&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=how-to-brew-bangladeshi-milk-tea-a-5-step-spin-to-sip-heaven&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=roll-from-dhaka-to-chittagong-your-ultimate-bus-counter-guide&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=dhaka-spin-into-bangladesh-s-urban-jackpot&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-the-wild-wheel-unravel-the-sundarbans-mangrove-magic&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-the-wild-wheel-unravel-the-sundarbans-mangrove-magic&lang=en'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-your-way-from-chittagong-to-dhaka-your-ultimate-travel-guide&lang=bn'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=how-to-brew-bangladeshi-milk-tea-a-5-step-spin-to-sip-heaven&lang=bn'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=roll-from-dhaka-to-chittagong-your-ultimate-bus-counter-guide&lang=bn'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=dhaka-spin-into-bangladesh-s-urban-jackpot&lang=bn'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-the-wild-wheel-unravel-the-sundarbans-mangrove-magic&lang=bn'
    ],
    [
        'loc' => 'https://www.fanciwheel.com/detail?slug=spin-the-wild-wheel-unravel-the-sundarbans-mangrove-magic&lang=bn'
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