<?php

if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✅ OPcache cleared!<br>";
} else {
    echo "⚠️ OPcache not enabled.<br>";
}

session_start();
session_unset();
session_destroy();
echo "✅ PHP sessions cleared!<br>";


$cacheDir = __DIR__ . '/cache'; //
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) unlink($file);
    }
    echo "✅ File cache cleared!<br>";
} else {
    echo "⚠️ No cache folder found.<br>";
}

header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
echo "✅ Browser cache headers sent!<br>";

echo "<br>All cache cleared!";
