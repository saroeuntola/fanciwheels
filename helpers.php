<?php
function navLink($page, $label, $lang, $currentPage, $currentId)
{
    $href = $page;
    $params = [];

    if ($currentPage === 'detail.php' && $currentId) {
        $params['slug'] = $currentId;
    }

    $params['lang'] = $lang;
    $queryString = http_build_query($params);
    $href .= '?' . $queryString;

    // Determine active page correctly
    $active = '';
    $pageMap = [
        '/' => 'index.php',
        'services' => 'services.php',
        'about' => 'about.php',
        'faq' => 'faq.php'
    ];

    if (isset($pageMap[$page]) && $pageMap[$page] === $currentPage) {
        $active = 'active';
    }

    return <<<HTML
<a href="{$href}" class="nav-link relative text-white/90 hover:text-white transition-all duration-300 {$active}">
    <span class="relative z-10">{$label}</span>
</a>
HTML;
}
