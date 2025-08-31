<?php
include "./admin/page/library/db.php";
include "./admin/page/library/game_lib.php";

$currentPage = basename($_SERVER['PHP_SELF']);

$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';

// Keep ID if on detail.php
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : null;

if (!isset($_GET['slug'])) {
  echo $lang === 'en' ? "slug not provided." : "আইডি প্রদান করা হয়নি।";
  exit;
}

$slug = trim($_GET['slug']);
$gameObj = new Games();
$game = $gameObj->getGameBySlug($slug, $lang);


$relatedGames = $gameObj->getRelatedGames($slug, $game['category_id'], 6, $lang);
$popularGames = $gameObj->getPopularGames(8, $lang);

$gameImage = $game['image'] ?? 'default.png';
$metaText = $game['meta_text'] ?? ($lang === 'en' ? 'Image' : 'ছবি');
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">

<head>
  <meta charset="UTF-8" />
  <?php include 'head-log.php'; ?>

  <!-- Dynamic Title -->
  <title><?= htmlspecialchars($game['name']) ?></title>

  <!-- Meta Description -->
  <meta name="description" content="<?= htmlspecialchars($game['description']) ?>">
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Dynamic Favicon -->
  <?php if (!empty($gameImage)): ?>
    <link rel="icon" href="<?= htmlspecialchars('https://fanciwheel.com' . '/admin/page/game/' . $gameImage) ?>" type="image/png">
    <link rel="shortcut icon" href="<?= htmlspecialchars('https://fanciwheel.com' . '/admin/page/game/' . $gameImage) ?>" type="image/png">
  <?php else: ?>
    <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
    <link rel="shortcut icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
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
  <!-- CSS -->
  <link href="./dist/output.css" rel="stylesheet">

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="<?= htmlspecialchars($game['name'] ?? 'Detail') ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($game['description'] ?? 'Check out detail') ?>" />
  <meta property="og:image" content="<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>" />
  <meta property="og:url" content="https://fanciwheel.com" />
  <meta property="og:type" content="website" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($game['name'] ?? 'Detail') ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($game['description'] ?? 'Check out this detail') ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>" />

  <!-- Structured Data (JSON-LD) -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog",
      "name": "<?= htmlspecialchars($game['name'] ?? 'Detail') ?>",
      "description": "<?= htmlspecialchars($game['description'] ?? 'Check out this detail') ?>",
      "image": "<?= htmlspecialchars(!empty($gameImage) ? 'https://fanciwheel.com' . '/admin/page/game/' . $gameImage : 'https://fanciwheel.com/image/default-game.png') ?>",
      "url": "https://fanciwheel.com"
    }
  </script>
</head>


<style>
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
</style>

<body class="bg-gray-900 text-white">
  <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
  <?php include 'loading.php'; ?>
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
            class="w-full h-64 md:h-[310px] lg:h-[450px] object-cover rounded-xl mb-6" />

          <div class="text-gray-300 space-y-4 text-base leading-relaxed md:text-lg">
            <?= $game['description'] ?? ($lang === 'en' ? 'No description available.' : 'কোনো বিবরণ নেই।') ?>
          </div>
        </div>

        <!-- Related Games -->
        <?php if (!empty($relatedGames)): ?>
          <div class="bg-gray-800 rounded-2xl shadow-md p-4">
            <h2 class="text-lg lg:text-2xl sm:text-3xl font-bold text-white mb-6 flex items-center">
              <svg class="w-6 h-6 mr-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 102 0zm-1 4a1 1 0 100-2 1 1 0 000 2zm0 2a1 1 0 000 2h.01a1 1 0 100-2H10z" clip-rule="evenodd" />
              </svg>
              <?= $lang === 'en' ? 'Related Content' : 'সম্পর্কিত বিষয়বস্তু' ?>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
              <?php foreach ($relatedGames as $related): ?>
                <?php
                $relatedImage = $related['image'] ?? 'default.png';
                $relatedMeta = $related['meta_text'] ?? ($lang === 'en' ? 'No image' : 'কোনো ছবি নেই');
                ?>
                <div class="group rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                  <a href="detail?slug=<?= $related['slug'] ?>&lang=<?= $lang ?>" class="block">
                    <div class="relative overflow-hidden">
                      <img
                        src="<?= './admin/page/game/' . htmlspecialchars($relatedImage) ?>"
                        alt="<?= htmlspecialchars($relatedMeta) ?>"
                        class="object-cover group-hover:scale-105 transition-transform duration-300" id="relate-img" />
                    </div>
                    <div class="">
                      <h3 class="text-lg font-semibold text-white group-hover:text-blue-400 transition-colors duration-200">
                        <?= htmlspecialchars($related['name'] ?? ($lang === 'en' ? 'No Name' : 'কোনো নাম নেই')) ?>
                      </h3>
                      <p class="text-gray-300 text-sm line-clamp-3">
                        <?= htmlspecialchars(substr(strip_tags($related['description'] ?? ($lang === 'en' ? 'No description' : 'কোনো বিবরণ নেই')), 0, 120)) . '...' ?>
                      </p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <div class="lg:col-span-1 space-y-8">
        <div class="bg-gray-800 rounded-2xl shadow-sm p-4">
          <h3 class="text-lg lg:text-2xl sm:text-3xl font-bold text-white mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M2 5a2 2 0 012-2h2.586a1 1 0 01.707.293l1.414 1.414A2 2 0 0010 5h6a2 2 0 012 2v8a2 2 0 01-2 2h-6a2 2 0 00-1.293.293l-1.414 1.414A1 1 0 015.586 19H4a2 2 0 01-2-2V5z" />
            </svg>
            <?= $lang === 'en' ? 'Popular Posts' : 'জনপ্রিয় পোস্ট' ?>
          </h3>
          <div class="space-y-4">
            <?php foreach (array_slice($popularGames, 0, 6) as $popular): ?>
              <?php
              $popularImage = $popular['image'] ?? 'default.png';
              $popularName = $popular['name'] ?? ($lang === 'en' ? 'Popular Post' : 'জনপ্রিয় পোস্ট');
              $popularDesc = $popular['description'] ?? '';
              ?>
              <div class="flex items-start space-x-3 group">
                <div class="flex-shrink-0">
                  <img
                    src="<?= './admin/page/game/' . htmlspecialchars($popularImage) ?>"
                    alt="<?= htmlspecialchars($popularName) ?>"
                    class="w-16 h-16 object-cover rounded-lg group-hover:opacity-80 transition-opacity duration-200" />
                </div>
                <div class="flex-1 min-w-0">
                  <a href="detail.php?id=<?= $popular['id'] ?>&lang=<?= $lang ?>" class="block group-hover:text-blue-400 transition-colors duration-200">
                    <h4 class="text-sm font-semibold text-white truncate">
                      <?= htmlspecialchars($popularName) ?>
                    </h4>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-2">
                      <?= htmlspecialchars(substr(strip_tags($popularDesc), 0, 80)) . '...' ?>
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
</body>

</html>