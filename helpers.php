<?php
function navLink($page, $label, $lang, $currentPage, $currentId)
{
    $pageMap = [
        '/' => 'index.php',
        'services' => 'services.php',
        'about' => 'about.php',
        'faq' => 'faq.php',
        'contact' => 'contact.php'
    ];

    $targetFile = $pageMap[$page] ?? '';
    $currentFile = basename($currentPage);

    $isActive = ($currentFile === $targetFile);

    $href = $pageMap[$page] ?? $page;
    $params = ['lang' => $lang];
    if ($currentFile === 'detail.php' && $currentId) {
        $params['slug'] = $currentId;
    }
    $queryString = http_build_query($params);
    $href .= '?' . $queryString;

    $classes = $isActive
        ? 'text-white border-b-2 border-white px-3 font-medium' // Active page underline
        : 'text-white hover:border-b-2 hover:border-white px-3 font-medium transition-all duration-300'; // Hover underline

    return "<a href=\"{$href}\" class=\"{$classes}\">{$label}</a>";
}
