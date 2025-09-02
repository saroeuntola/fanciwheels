<?php
include 'admin/page/library/db.php';
?>

<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';
$aboutTexts = include './language/about-translate.php';
$currentTexts = $aboutTexts[$lang] ?? $aboutTexts['en'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'head-log.php'; ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

  <!-- Styles -->
  <link href="./dist/output.css" rel="stylesheet">

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
    <h1 class="text-3xl md:text-4xl font-bold text-red-600 mb-6"><?php echo $currentTexts['title']; ?></h1>
    <h2 class="text-2xl font-semibold text-red-600 mb-6"><?php echo $currentTexts['heading']; ?></h2>

    <!-- Introduction -->
    <p class="mb-6 leading-relaxed text-gray-300"><?php echo $currentTexts['intro']; ?></p>

    <!-- Milktea -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600 mb-2">🧋 Milktea</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['milktea']; ?></p>
    </section>

    <!-- Bus Services -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600">🚌 Bus Services</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['bus_services']; ?></p>
    </section>

    <!-- Why Choose Us -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600 mb-2">⭐ Why Choose Us</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['why_choose']; ?></p>
    </section>

    <!-- Delivery Options -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600 mb-2">🚚 Delivery Options</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['delivery_options']; ?></p>
    </section>

    <!-- Customer Support -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600">📞 Customer Support</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['customer_support']; ?></p>
    </section>

    <!-- Join Us -->
    <section class="mb-8">
      <h3 class="text-xl font-semibold text-red-600">🎉 Join Us</h3>
      <p class="text-gray-300 mb-4"><?php echo $currentTexts['join_us']; ?></p>
    </section>

    <!-- Conclusion -->
    <section>
      <p class="text-red-600"><?php echo $currentTexts['conclusion']; ?></p>
    </section>
  </div>


  <?php include 'footer.php'; ?>
</body>

</html>