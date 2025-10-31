<?php
ob_start();
header('Content-Type: application/xml; charset=utf-8');

// Base URL
$baseUrl = "https://fanciwheel.com";

// Include your database and post class
require_once __DIR__ . '/admin/page/library/db.php';
require_once __DIR__ . '/admin/page/library/game_lib.php';

$postLib = new Games();
$posts = [];
try {
    $posts = $postLib->getGames();
} catch (Exception $e) {
    $posts = [];
}

// Static pages
$pages = [
    ['slug' => '', 'priority' => 1.0],
    ['slug' => '?lang=en', 'priority' => 1.0],
    ['slug' => '/about', 'priority' => 0.8],
    ['slug' => '/about?lang=en', 'priority' => 1.0],
    ['slug' => '/services', 'priority' => 0.8],
    ['slug' => '/services?lang=en', 'priority' => 0.8],
];

ob_end_clean();

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    $today = date('Y-m-d');

    // Add static pages
    foreach ($pages as $page):
    ?>
        <url>
            <loc><?= htmlspecialchars(rtrim($baseUrl, '/') . '/' . ltrim($page['slug'], '/')) ?></loc>
            <lastmod><?= $today ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority><?= $page['priority'] ?></priority>
        </url>
    <?php endforeach; ?>

    <?php
    // Add dynamic posts
    foreach ($posts as $post):
        foreach (['en', 'bn'] as $lang):
            $slug = urlencode($post['slug']);
    ?>
            <url>
                <loc><?= htmlspecialchars("$baseUrl/detail?slug=$slug&lang=$lang") ?></loc>
                <lastmod><?= $today ?></lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
    <?php
        endforeach;
    endforeach;
    ?>
</urlset>
<?php ob_end_flush(); ?>