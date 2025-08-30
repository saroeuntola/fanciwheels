<?php
include './admin/page/library/db.php';
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="robots" content="index, follow">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-site-verification" content="KQ_ffol2MIoJcfrqSEKOfToxbgsEPcFj3STGCvUen5U" />
  <?php include 'head-log.php' ?>
  <?php
  include 'header.php'
  ?>
  <!-- Title for search engines -->
  <title>
    <?php
    echo $lang === 'en'
      ? 'Fancy Wheel | Most Beautiful Places in Bangladesh to Visit'
      : 'Fancy Wheel | Most Beautiful Places in Bangladesh to Visit';
    ?>
  </title>

  <!-- Meta Description for SEO -->
  <meta name="description" content="<?php
                                    echo $lang === 'en'
                                      ? 'Explore the most beautiful places in Bangladesh, including Cox\'s Bazar, Sundarbans, Saint Martin\'s Island, Sajek Valley, Rangamati, Bandarban, and Kuakata.'
                                      : 'Explore the most beautiful places in Bangladesh, including Cox\'s Bazar, Sundarbans, Saint Martin\'s Island, Sajek Valley, Rangamati, Bandarban, and Kuakata.';
                                    ?>">

  <!-- Optional minimal keywords (safe, not overstuffed) -->
  <meta name="keywords" content="<?php
                                  echo $lang === 'en'
                                    ? 'most beautiful places in Bangladesh, Bangladesh travel, tourist places, Cox\'s Bazar, Sundarbans, Sajek Valley, Saint Martin\'s Island'
                                    : 'most beautiful places in Bangladesh, Bangladesh travel, tourist places, Cox\'s Bazar, Sundarbans, Sajek Valley, Saint Martin\'s Island';
                                  ?>">

  <link rel="icon" href="https://img.f369w.com/fw/h5/assets/images/icons/PWAicon-192px.png?v=1753166904845"
    type="image/png">
  <!-- Canonical URL -->
  <link rel="canonical" href="https://fanciwheel.com" />

  <!-- Open Graph (for Facebook, LinkedIn, etc.) -->
  <meta property="og:title" content="Popular Cities in Bangladesh Tour - Explore Top Destinations!" />
  <meta property="og:description"
    content="Plan your Bangladesh tour with highlights on Dhaka, Chittagong, Sylhet, and other must-see cities. Get travel guides and tips now." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://fanciwheel.com" />
  <meta property="og:image" content="https://fanciwheel.com/" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Popular Cities in Bangladesh Tour - Explore Top Destinations!" />
  <meta name="twitter:description"
    content="Explore the best cities in Bangladesh for your next trip. Travel guides, tips, and more." />
  <meta name="twitter:image" content="https://fanciwheel.com" />
  <link href="./dist/output.css" rel="stylesheet">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog post",
      "name": "Fancy Wheel",
      "url": "https://fanciwheel.com",
      "logo": "https://fanciwheel.com/image/PWAicon-192px.png"
    }
  </script>

  <!-- Google tag (gtag.js) -->
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

<style>
  /* Line clamp utilities */
  .line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Custom scrollbar for select */
  select::-webkit-scrollbar {
    width: 8px;
  }

  select::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
  }

  select::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
  }

  select::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }

  /* Enhanced hover effects */
  .group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
  }

  /* Smooth transitions */
  * {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
  }

  /* Backdrop blur fallback */
  @supports not (backdrop-filter: blur(12px)) {
    .backdrop-blur-sm {
      background-color: rgba(255, 255, 255, 0.8);
    }
  }

  /* Loading animation for images */
  img {
    transition: opacity 0.3s ease;
  }

  img:not([src]) {
    opacity: 0;
  }

  /* Focus styles for accessibility */
  select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
  }

  /* Custom animation for shine effect */
  @keyframes shine {
    0% {
      transform: translateX(-200%) skewX(-12deg);
    }

    100% {
      transform: translateX(200%) skewX(-12deg);
    }
  }

  /* Gradient animations */
  @keyframes gradient-x {

    0%,
    100% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }
  }

  .animate-gradient-x {
    background-size: 200% 200%;
    animation: gradient-x 3s ease infinite;
  }
</style>

<body class="bg-gray-900 text-white">
  <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
  <?php include 'loading.php'; ?>
  <?php include 'slideshow.php'; ?>
  <?php include 'key-frame.php'; ?>
  <?php include 'scroll-top-button.php'; ?>
  <!-- Cards Section -->
  <div class="max-w-7xl mx-auto lg:px-[35px] md:px-[24px] mt-6">
    <?php include 'card.php'; ?>
  </div>
  <div class="max-w-7xl mx-auto lg:px-[35px] md:px-[24px]">
    <?php include 'games-grid.php' ?>
  </div>
  <div class="mb-12">
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'spin-popup.php'; ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>