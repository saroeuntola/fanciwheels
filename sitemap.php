<?php
header("Content-Type: application/xml; charset=UTF-8");

$pages = [
    [
        'loc' => 'https://fanciwheel.com/',
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
        'loc' => 'https://fanciwheel.com/detail?id=15&lang=en',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
    [
        'loc' => 'https://fanciwheel.com/detail?id=11&lang=en',
        'changefreq' => 'weekly',
        'priority' => '0.8'
    ],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?= htmlspecialchars($page['loc']) ?></loc>
            <lastmod><?= date('Y-m-d') ?></lastmod>
            <changefreq><?= $page['changefreq'] ?></changefreq>
            <priority><?= $page['priority'] ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>