<?php
header("Content-Type: application/xml; charset=UTF-8");

$staticPages = [
    [
        'loc' => 'https://fanciwheel.com/',
        'langs' => [
            'en' => 'https://fanciwheel.com/?lang=en',
            'bn' => 'https://fanciwheel.com/?lang=bn'
        ],
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => 'https://fanciwheel.com/about',
        'langs' => [
            'en' => 'https://fanciwheel.com/about?lang=en',
            'bn' => 'https://fanciwheel.com/about?lang=bn'
        ],
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
    [
        'loc' => 'https://fanciwheel.com/services',
        'langs' => [
            'en' => 'https://fanciwheel.com/services?lang=en',
            'bn' => 'https://fanciwheel.com/services?lang=bn'
        ],
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
];

$games = [
    [
        'slug' => 'dhaka',
        'langs' => [
            'en' => 'https://fanciwheel.com/detail?slug=dhaka&lang=en',
            'bn' => 'https://fanciwheel.com/detail?slug=dhaka&lang=bn'
        ]
    ],
    [
        'slug' => 'sundarbans',
        'langs' => [
            'en' => 'https://fanciwheel.com/detail?slug=sundarbans&lang=en',
            'bn' => 'https://fanciwheel.com/detail?slug=sundarbans&lang=bn'
        ]
    ],
];

// Merge all pages
$allPages = array_merge($staticPages, $games);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <?php foreach ($allPages as $page): ?>
        <url>
            <loc><?= htmlspecialchars(current($page['langs'])) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq><?= $page['changefreq'] ?? 'weekly' ?></changefreq>
            <priority><?= $page['priority'] ?? '0.8' ?></priority>

            <?php foreach ($page['langs'] as $lang => $url): ?>
                <!-- Self-referencing and alternate language -->
                <xhtml:link rel="alternate" hreflang="<?= $lang ?>" href="<?= htmlspecialchars($url) ?>" />
            <?php endforeach; ?>
        </url>
    <?php endforeach; ?>
</urlset>