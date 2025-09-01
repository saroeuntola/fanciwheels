<?php
function navLink($page, $label, $lang, $currentPage, $currentId)
{
    $pageMap = [
        '/' => '/',
        'services' => 'services',
        'about' => 'about',
        'faq' => 'faq'
    ];

    $targetFile = $pageMap[$page] ?? '';
    $currentFile = basename($currentPage);

    $isActive = ($currentFile === $targetFile);

    $href = $page;
    $params = ['lang' => $lang];
    if ($currentFile === 'detail' && $currentId) {
        $params['slug'] = $currentId;
    }
    $queryString = http_build_query($params);
    $href .= '?' . $queryString;

    $classes = $isActive
        ? 'inline-block text-white underline underline-offset-4 decoration-2'
        : 'inline-block text-white hover:underline hover:underline-offset-4 hover:decoration-2';

    return "<a href=\"{$href}\" class=\"{$classes} px-3 font-medium\">{$label}</a>";
}
