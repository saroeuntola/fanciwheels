<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include "./admin/page/library/db.php";
include "./admin/page/library/game_lib.php";
$currentPage = basename($_SERVER['PHP_SELF']);

$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : null;

if (!isset($_GET['slug'])) {
  echo $lang === 'en' ? "slug not provided." : "আইডি প্রদান করা হয়নি।";
  exit;
}
$slug = trim($_GET['slug']);
$gameObj = new Games();
$game = $gameObj->getGameBySlug($slug, $lang);

$relatedGames = $gameObj->getRelatedGames($slug, $game['category_id'], 100, $lang);
$popularGames = $gameObj->getPopularGames(10, $lang);

$gameImage = $game['image'] ?? 'default.png';
$metaText = $game['meta_text'] ?? ($lang === 'en' ? 'Image' : 'ছবি');
$itemsPerPage = 6; // show 6 related games per page
$totalRelated = count($relatedGames);
$totalPages = ceil($totalRelated / $itemsPerPage);
$currentPageRelated = isset($_GET['related_page']) && is_numeric($_GET['related_page'])
  ? max(1, min($totalPages, (int)$_GET['related_page']))
  : 1;

// Slice the related games array to get only current page items
$relatedGamesPage = array_slice($relatedGames, ($currentPageRelated - 1) * $itemsPerPage, $itemsPerPage);

function trimRichText($html, $limit = 100)
{
  // Decode HTML entities like &nbsp; to real spaces
  $decoded = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

  // Remove unwanted invisible chars but keep formatting
  $decoded = preg_replace('/\x{00A0}/u', ' ', $decoded); // Convert &nbsp; to space

  // Strip tags but keep clean text for counting
  $plainText = strip_tags($decoded);

  // Trim multibyte text (Bangla/English friendly)
  if (mb_strlen($plainText, 'UTF-8') > $limit) {
    $plainText = mb_substr($plainText, 0, $limit, 'UTF-8') . '...';
  }

  // Return decoded + safely escaped (Bangla + English both fine)
  return htmlspecialchars($plainText, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn-BD' ?>">

<head>
  <meta charset="UTF-8" />
  <?php include 'head-log.php'; ?>
  <!-- Dynamic Title -->
  <title><?= htmlspecialchars($game['name']) ?></title>
  <!-- Meta Description -->
  <meta name="description" content="<?= htmlspecialchars($game['meta_desc']) ?>">
  <meta name="keywords" content="<?= htmlspecialchars($game['meta_keyword']) ?>">
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Hreflang for Multilingual Support -->
  <link rel="alternate" href="https://fanciwheel.com/?lang=en" hreflang="en" />
  <link rel="alternate" href="https://fanciwheel.com/?lang=bn" hreflang="bn" />
  <link rel="alternate" href="https://fanciwheel.com" hreflang="x-default" />
  <!-- Dynamic Favicon -->
  <?php if (!empty($gameImage)): ?>
    <link rel="icon" href="<?= htmlspecialchars('https://fanciwheel.com' . '/admin/page/game/' . $gameImage) ?>" type="image/png">
    <link rel="shortcut icon" href="<?= htmlspecialchars('https://fanciwheel.com' . '/admin/page/game/' . $gameImage) ?>" type="image/png">
  <?php else: ?>
    <link rel="icon" href="./image/PWAicon-192px.png" type="image/png">
    <link rel="shortcut icon" href="./image/PWAicon-192px.png" type="image/png">
  <?php endif; ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-98CRLK26X1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-98CRLK26X1');
  </script>
  <link href="./dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="./dist/css/all.min.css" />
  <script src="./js/all.min.js"></script>
  <script src="./js/jquery-3.6.0.min.js"></script>
  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="<?= htmlspecialchars($game['name'] ?? 'Detail') ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($game['meta_desc'] ?? 'Check out detail') ?>" />
  <meta property="og:image" content="<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>" />
  <meta property="og:url" content="https://fanciwheel.com" />
  <meta property="og:type" content="website" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($game['name'] ?? 'Detail') ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($game['meta_desc'] ?? 'Check out this detail') ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>" />
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TCJVFMSG');
  </script>
  <!-- End Google Tag Manager -->
  <!-- Google Analytics / gtag.js -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-98CRLK26X1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-98CRLK26X1');
  </script>
  <!-- Structured Data (JSON-LD) -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Website",
      "name": "<?= htmlspecialchars($game['name'] ?? 'Detail') ?>",
      "description": "<?= htmlspecialchars($game['description'] ?? 'Check out this detail') ?>",
      "image": "<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>",
      "url": "https://fanciwheel.com"
    }
  </script>
</head>
<style>
  .ql-editor ul {
    list-style-type: disc;
    /* normal bullets */
    padding-left: 2.5em;
    /* indent for bullets */
    margin: 0.5em 0;
  }

  .ql-editor a {
    color: #60a5fa;
    /* blue-400 */
    text-decoration: underline;
  }

  .ql-editor h1 {
    font-size: 25px;
  }

  .ql-editor h3 {
    font-size: 22px;
  }

  /* Small mobile */
  @media (max-width: 480px) {}


  /* Tablet portrait */
  @media (max-width: 768px) {
    .ql-editor h1 {
      font-size: 20px;
    }

    .ql-editor h3 {
      font-size: 18px;
    }
  }

  .ql-editor a:hover {
    color: #93c5fd;
    /* blue-300 */
  }

  .ql-editor ol {
    list-style-type: decimal;
    padding-left: 4.5em;
    font-size: 15px;
  }

  .ql-editor li {
    margin-bottom: 0.5em;
    /* space between items */
  }

  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .img {
    border-radius: 5px;
  }

  .group:hover .group-hover\:opacity-80 {
    opacity: 0.8;
  }

  .group:hover .group-hover\:text-blue-400 {
    color: rgb(96 165 250);
  }

  .group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
  }

  @media (max-width: 1024px) {
    .detail-page {
      padding: 25px;
    }

  }

  @media (max-width: 768px) {
    .detail-page {
      padding: 16px;
    }

    #relate-img {

      height: 185px !important;
    }
  }

  @media (max-width: 468px) {

    #relate-img {

      height: 185px !important;
    }
  }

  #relate-img {
    width: 100%;
    height: 140px;
  }

  .left-sidebar {
    max-height: 600px;
    /* Fixed height */
    overflow-y: auto;
    /* Enable vertical scrolling */
    padding-right: 2px;
    /* Space for scrollbar */
    scrollbar-width: thin;
    /* For Firefox */
    scrollbar-color: #4B5563 #1F2937;
    /* thumb color, track color (Firefox) */
    transition: all 0.3s ease-in-out;
  }

  /* Webkit browsers (Chrome, Edge, Safari) */
  .left-sidebar::-webkit-scrollbar {
    width: 3px;
  }

  .left-sidebar::-webkit-scrollbar-track {
    background: #1F2937;
    /* Tailwind-gray-800 */
    border-radius: 4px;
  }

  .left-sidebar::-webkit-scrollbar-thumb {
    background-color: #4B5563;
    /* Tailwind-gray-600 */
    border-radius: 4px;
    border: 1px solid #1F2937;
    /* Padding around thumb */
  }

  .left-sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #6B7280;
    /* Tailwind-gray-500 */
  }
</style>

<body class="bg-gray-900 text-white">
  <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
  <?php include 'scroll-top-button.php'; ?>

  <div class="max-w-7xl mx-auto detail-page lg:p-[32px]">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-8">
        <!-- post Detail -->
        <div class="bg-gray-800 rounded-2xl shadow-md p-4">
          <h1 class="text-lg lg:text-2xl sm:text-3xl font-bold text-white mb-3 leading-snug break-words">
            <?= htmlspecialchars($game['name'] ?? ($lang === 'en' ? 'Unnamed' : 'নামহীন')) ?>
          </h1>

          <img
            src="<?= './admin/page/game/' . htmlspecialchars($gameImage) ?>"
            alt="<?= htmlspecialchars($metaText) ?>"
            loading="lazy"
            class="w-full md:h-[310px] lg:h-[450px] object-fill mb-4 img" />
          <div class="text-gray-300 space-y-4 text-base leading-relaxed md:text-lg ql-editor break-words">
            <?= $game['description'] ?? ($lang === 'en' ? 'No description available.' : 'কোনো বিবরণ নেই।') ?>
          </div>
        </div>

        <!-- Related -->

        <div id="related-container">
          <?php include "related_games_partial.php"; ?>
        </div>
      </div>

      <!-- Sidebar -->
      <!-- Sidebar -->
      <div class="lg:col-span-1 space-y-8">
        <div class="bg-gray-800 rounded-2xl shadow-sm p-4">
          <h3 class="text-lg lg:text-2xl sm:text-3xl font-bold text-white mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2 5a2 2 0 012-2h2.586a1 1 0 01.707.293l1.414 1.414A2 2 0 0010 5h6a2 2 0 012 2v8a2 2 0 01-2 2h-6a2 2 0 00-1.293.293l-1.414 1.414A1 1 0 015.586 19H4a2 2 0 01-2-2V5z" />
            </svg>
            <?= $lang === 'en' ? 'Latest Posts' : 'শেষ পোস্ট' ?>
          </h3>

          <!-- Scrollable content -->
          <div class="space-y-4 left-sidebar overflow-y-auto pr-2 transition-all duration-500 ease-in-out">
            <?php foreach (array_slice($popularGames, 0, 10) as $popular): ?>
              <?php
              $popularImage = $popular['image'] ?? 'default.png';
              $popularName = $popular['name'] ?? ($lang === 'en' ? 'Latest Posts' : 'শেষ পোস্ট');

              ?>
              <div class="flex items-start space-x-3 group transform transition-all duration-500 ease-in-out hover:translate-x-1 hover:scale-[1.02]">
                <div class="flex-shrink-0 relative">
                  <!-- Spinner Overlay -->
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
                    src="<?= './admin/page/game/' . htmlspecialchars($popularImage) ?>"
                    loading="lazy"
                    alt="<?= htmlspecialchars($popularName) ?>"
                    class="w-16 h-16 object-cover rounded-lg group-hover:opacity-80 opacity-0 transition-opacity duration-700 ease-in-out"
                    onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove()" />
                </div>

                <div class="flex-1 min-w-0">
                  <a href="detail?slug=<?= $popular['slug'] ?>&lang=<?= $lang ?>"
                    class="block group-hover:text-blue-400 transition-colors duration-300 ease-in-out">
                    <h4 class="text-sm font-semibold text-white truncate">
                      <?= htmlspecialchars($popularName) ?>
                    </h4>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-2 leading-relaxed break-words">
                      <?= trimRichText($popular['description'] ?? ($lang === 'en' ? 'No description' : 'কোনো বিবরণ নেই'), 100) ?>
                    </p>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include 'footer.php'; ?>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const container = document.getElementById("related-container");

      document.addEventListener("click", async (e) => {
        const link = e.target.closest(".page-link");
        if (!link) return;

        e.preventDefault();

        const url = new URL(link.href);
        const relatedPage = url.searchParams.get("related_page");
        const slug = url.searchParams.get("slug");
        const lang = url.searchParams.get("lang");

        // Slow fade + slide out
        container.classList.add("opacity-0", "translate-y-3", "transition-all", "duration-700", "ease-in-out");

        try {
          const response = await fetch(
            `related_games_partial.php?slug=${slug}&lang=${lang}&related_page=${relatedPage}`
          );
          const html = await response.text();

          // After animation ends, replace content
          setTimeout(() => {
            container.innerHTML = html;

            // Slow fade + slide in
            container.classList.remove("translate-y-3");
            container.classList.add("opacity-100", "translate-y-0");

          }, 500); // delay to match animation
        } catch (err) {
          console.error("Error updating related content:", err);
        }
      });
    });
  </script>
</body>

</html>