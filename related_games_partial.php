<?php
require_once "./admin/page/library/db.php";
require_once "./admin/page/library/game_lib.php";

$lang = $_GET['lang'] ?? 'en';
$slug = $_GET['slug'] ?? '';
$currentPageRelated = isset($_GET['related_page']) ? (int)$_GET['related_page'] : 1;
$perPage = 6;

$gameObj = new Games();
$game = $gameObj->getGameBySlug($slug, $lang);
$relatedGames = $gameObj->getRelatedGames($slug, $game['category_id'], 100, $lang);

// Pagination setup
$totalItems = count($relatedGames);
$totalPages = ceil($totalItems / $perPage);
$offset = ($currentPageRelated - 1) * $perPage;
$relatedGamesPage = array_slice($relatedGames, $offset, $perPage);
?>

<div class="bg-gray-800 rounded-2xl shadow-md p-4 transition-all duration-700 ease-in-out opacity-100 translate-y-0">
    <h2 class="text-lg lg:text-2xl sm:text-3xl font-bold text-white mb-6 flex items-center">
        <svg class="w-6 h-6 mr-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 102 0zm-1 4a1 1 0 100-2 1 1 0 000 2zm0 2a1 1 0 000 2h.01a1 1 0 100-2H10z"
                clip-rule="evenodd" />
        </svg>
        <?= $lang === 'en' ? 'Related Content' : 'সম্পর্কিত বিষয়বস্তু' ?>
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <?php foreach ($relatedGamesPage as $related): ?>
            <?php
            $relatedImage = $related['image'] ?? 'default.png';
            $relatedMeta = $related['meta_text'] ?? ($lang === 'en' ? 'No image' : 'কোনো ছবি নেই');
            $plainText = html_entity_decode(strip_tags($related['description'] ?? ($lang === 'en' ? 'No description' : 'কোনো বিবরণ নেই')));
            $trimmed = mb_strimwidth($plainText, 0, 120, '...');
            ?>
            <div class="group overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 mb-4">
                <a href="detail?slug=<?= $related['slug'] ?>&lang=<?= $lang ?>" class="block">
                    <div class="relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-500 z-10" id="spinner">
                            <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </div>
                        <img
                            src="<?= './admin/page/game/' . htmlspecialchars($relatedImage) ?>"
                            loading="lazy"
                            alt="<?= htmlspecialchars($relatedMeta) ?>"
                            class="object-fill group-hover:scale-105 opacity-0 transition-opacity duration-500"
                            id="relate-img"
                            onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()" />
                    </div>
                    <div class="mt-2">
                        <h3 class="text-md font-semibold text-white group-hover:text-blue-400 transition-colors duration-200">
                            <?= htmlspecialchars($related['name'] ?? ($lang === 'en' ? 'No Name' : 'কোনো নাম নেই')) ?>
                        </h3>
                        <p class="text-gray-300 text-sm line-clamp-3 leading-relaxed break-words"><?= htmlspecialchars($trimmed) ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="flex justify-center items-center space-x-2 mt-4">
            <?php if ($currentPageRelated > 1): ?>
                <a href="?slug=<?= urlencode($slug) ?>&lang=<?= $lang ?>&related_page=1" class="page-link px-3 py-1 bg-blue-600 rounded hover:opacity-80" data-page="1"><i class="fa-solid fa-angles-left"></i></a>
                <a href="?slug=<?= urlencode($slug) ?>&lang=<?= $lang ?>&related_page=<?= $currentPageRelated - 1 ?>" class="page-link px-3 py-1 bg-gray-700 rounded" data-page="<?= $currentPageRelated - 1 ?>"><i class="fa-solid fa-arrow-left"></i></a>
            <?php endif; ?>

            <?php
            $maxPagesToShow = 4;
            $startPage = max(1, $currentPageRelated - 2);
            $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
            if ($startPage > 1) echo '<span class="px-2 py-1 text-gray-400">...</span>';
            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?slug=<?= urlencode($slug) ?>&lang=<?= $lang ?>&related_page=<?= $i ?>" class="page-link px-3 py-1 rounded <?= $i == $currentPageRelated ? 'bg-blue-600 text-white' : 'bg-gray-700 hover:bg-gray-600' ?>" data-page="<?= $i ?>"><?= $i ?></a>
            <?php endfor;
            if ($endPage < $totalPages) {
                echo '<span class="px-2 py-1 text-gray-400">...</span>';
                echo '<a href="?slug=' . urlencode($slug) . '&lang=' . $lang . '&related_page=' . $totalPages . '" class="page-link px-3 py-1 rounded bg-gray-700 hover:bg-gray-600" data-page="' . $totalPages . '">' . $totalPages . '</a>';
            }
            ?>

            <?php if ($currentPageRelated < $totalPages): ?>
                <a href="?slug=<?= urlencode($slug) ?>&lang=<?= $lang ?>&related_page=<?= $currentPageRelated + 1 ?>" class="page-link px-3 py-1 bg-gray-700 rounded hover:bg-gray-600" data-page="<?= $currentPageRelated + 1 ?>"><i class="fa-solid fa-arrow-right"></i></a>
                <a href="?slug=<?= urlencode($slug) ?>&lang=<?= $lang ?>&related_page=<?= $totalPages ?>" class="page-link px-3 py-1 bg-blue-600 rounded hover:opacity-80" data-page="<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>