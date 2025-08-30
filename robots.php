<?php
// Serve robots.txt as plain text
header("Content-Type: text/plain; charset=UTF-8");

// Sitemap URL
$sitemap = "https://fanciwheel.com/sitemap.xml";

// Output robots.txt content
echo "# Sitemap\n";
echo "Sitemap: $sitemap\n\n";

// Allow all bots
echo "User-agent: *\n";
echo "Allow: /\n\n";

// Block sensitive directories
$disallow_paths = [
    "/admin/",
    "/config/",
    "/clear_cache.php",
    "/.env"
];
$disallow_extensions = [
    "*.log$",
    "*.bak$",
    "*.sql$"
];

foreach ($disallow_paths as $path) {
    echo "Disallow: $path\n";
}
foreach ($disallow_extensions as $ext) {
    echo "Disallow: $ext\n";
}
