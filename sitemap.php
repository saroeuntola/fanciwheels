<?php
header("Content-Type: application/xml; charset=UTF-8");

// Define pages and their multilingual URLs
$pages = [
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
    [
        'loc' => 'https://fanciwheel.com/detail?id=15',
        'langs' => [
            'en' => 'https://fanciwheel.com/detail?id=15&lang=en',
            'bn' => 'https://fanciwheel.com/detail?id=15&lang=bn'
        ],
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?id=11',
        'langs' => [
            'en' => 'https://fanciwheel.com/detail?id=11&lang=en',
            'bn' => 'https://fanciwheel.com/detail?id=11&lang=bn'
        ],
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xhtml="https://www.w3.org/1999/xhtml">
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?= htmlspecialchars(current($page['langs'])) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq><?= $page['changefreq'] ?></changefreq>
            <priority><?= $page['priority'] ?></priority>

            <?php foreach ($page['langs'] as $lang => $url): ?>
                <!-- Self-referencing and alternate language -->
                <xhtml:link rel="alternate" hreflang="<?= $lang ?>" href="<?= htmlspecialchars($url) ?>" />
            <?php endforeach; ?>
        </url>
    <?php endforeach; ?>
</urlset>