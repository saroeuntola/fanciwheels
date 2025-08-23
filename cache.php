<?php
if (function_exists('opcache_reset')) { opcache_reset(); echo "✅ OPcache cleared<br>"; }
session_start();
session_unset();
session_destroy();
echo "✅ PHP sessions cleared<br>";

header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
echo "✅ Browser cache headers sent<br>";

echo "<br>All cache cleared!";
