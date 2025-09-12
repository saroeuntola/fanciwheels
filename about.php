<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';
$aboutTexts = include './language/about-translate.php';
$currentTexts = $aboutTexts[$lang] ?? $aboutTexts['en'];
?>

<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn-BD' ?>">

<head>
  <?php include 'head-log.php'; ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Googlebot (main crawler) -->
  <meta name="googlebot" content="index, follow">
  <!-- AdsBot (Google Ads crawler) -->
  <meta name="AdsBot-Google" content="index, follow">
  <!-- Google News crawler -->
  <meta name="googlebot-news" content="index, follow">
  <!-- General robots (other search engines) -->
  <meta name="robots" content="index, follow">
  <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
  <!-- Dynamic Title -->
  <title><?php echo htmlspecialchars($currentTexts['title']); ?></title>

  <!-- Meta Description -->
  <meta name="description" content="<?php echo htmlspecialchars($currentTexts['intro']); ?>">

  <!-- Keywords (optional, can update based on content) -->
  <meta name="keywords" content="Milktea, Chittagong bus services, Bangladesh, delivery, safe bus, fresh Milktea">

  <!-- Language & Author -->
  <meta name="language" content="<?php echo $lang === 'en' ? 'English' : 'Bengali'; ?>">
  <meta name="author" content="Milktea & Chittagong Bus Services">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($currentTexts['title']); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($currentTexts['intro']); ?>">
  <meta property="og:url" content="https://fanciwheel.com/about.php?lang=<?php echo $lang; ?>">
  <meta property="og:image" content="https://fanciwheel.com/images/about-og.jpg">

  <!-- Twitter Card -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="<?php echo htmlspecialchars($currentTexts['title']); ?>">
  <meta property="twitter:description" content="<?php echo htmlspecialchars($currentTexts['intro']); ?>">
  <meta property="twitter:image" content="https://fanciwheel.com/images/about-og.jpg">

  <link href="./dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="./dist/css/all.min.css" />
  <script src="./js/all.min.js"></script>
  <script src="./js/jquery-3.6.0.min.js"></script>

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

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-98CRLK26X1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-98CRLK26X1');
  </script>

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://fanciwheel.com/",
      "name": "Fancy Wheel",
      "alternateName": "fanciwheel.com",
      "logo": "https://fanciwheel.com/image/PWAicon-192px.png",
    }
  </script>
</head>

<body class="bg-gray-900 text-white">
  <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
  <?php
  include 'loading.php'
  ?>
  <?php include 'scroll-top-button.php'; ?>


  <div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Heading -->
    <h1 class="text-2xl md:text-4xl font-bold text-gray-100 mb-6"><?php echo $currentTexts['title']; ?></h1>
    <h2 class="text-lg font-semibold text-gray-100 mb-6"><?php echo $currentTexts['heading']; ?></h2>

    <!-- Introduction -->
    <p class="mb-6 leading-relaxed text-gray-300"><?php echo $currentTexts['intro']; ?></p>

    <!-- Milktea -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100 mb-2">🧋<?= $lang === 'en' ? 'Milktea' : 'দুধ চা' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['milktea']; ?></p>
    </section>

    <!-- Bus Services -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100">🚌<?= $lang === 'en' ? 'Bus Services' : 'বাস পরিষেবা' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['bus_services']; ?></p>
    </section>

    <!-- Why Choose Us -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100 mb-2">⭐<?= $lang === 'en' ? 'Why Choose Us' : 'কেন আমাদের নির্বাচন করেছে' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['why_choose']; ?></p>
    </section>

    <!-- Delivery Options -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100 mb-2">🚚<?= $lang === 'en' ? 'Delivery Options' : 'ডেলিভারি বিকল্প' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['delivery_options']; ?></p>
    </section>

    <!-- Customer Support -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100">📞<?= $lang === 'en' ? 'Customer Support' : 'গ্রাহক সহায়তা' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['customer_support']; ?></p>
    </section>

    <!-- Join Us -->
    <section class="mb-8">
      <h3 class="text-lg font-semibold text-gray-100">🎉<?= $lang === 'en' ? 'Customer Support' : 'গ্রাহক সহায়তা' ?></h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['join_us']; ?></p>
    </section>

    <!-- Conclusion -->
    <section>
      <p class="text-gray-100"><?php echo $currentTexts['conclusion']; ?></p>
    </section>
  </div>


  <?php include 'footer.php'; ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
</body>

</html>