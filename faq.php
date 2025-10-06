<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';

$faqData = include './language/faqs-translate.php';
$currentFaqs = $faqData[$lang] ?? $faqData['bn'];
?>

<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn-BD' ?>">

<head>
  <?php include 'head-log.php' ?>
  <!-- Googlebot (main crawler) -->
  <meta name="googlebot" content="index, follow">
  <!-- AdsBot (Google Ads crawler) -->
  <meta name="AdsBot-Google" content="index, follow">
  <!-- Google News crawler -->
  <meta name="googlebot-news" content="index, follow">
  <!-- General robots (other search engines) -->
  <meta name="robots" content="index, follow">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $lang === 'en'
      ? 'FancyWheel - Frequently Asked Questions'
      : 'FancyWheel - সচরাচর জিজ্ঞাস্য (FAQs)'; ?>
  </title>
  <!-- Hreflang for Multilingual Support -->
  <link rel="alternate" href="https://fanciwheel.com/?lang=en" hreflang="en" />
  <link rel="alternate" href="https://fanciwheel.com/?lang=bn" hreflang="bn" />
  <link rel="alternate" href="https://fanciwheel.com/" hreflang="x-default" />
  <!-- Favicon -->
  <link rel="icon" href="/image/PWAicon-192px.png" type="image/png">

  <!-- SEO Meta Tags -->
  <meta name="description" content="<?php echo $lang === 'en'
                                      ? 'Find answers to common questions about Fancy Wheel services'
                                      : 'ফ্যান্সি হুইল পরিষেবা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন'; ?>">
  <meta name="keywords" content="Bangladesh bus travel, FAQ, bus ticket booking, Dhaka bus, BD transport, Sylhet tea, milk tea Bangladesh, roadside tea stalls">
  <meta name="author" content="FancyWheel">

  <!-- Open Graph Meta Tags (for social media sharing) -->
  <meta property="og:title" content="<?php echo $lang === 'en'
                                        ? 'FancyWheel - Frequently Asked Questions'
                                        : 'FancyWheel - সচরাচর জিজ্ঞাস্য (FAQs)'; ?>">
  <meta property="og:description" content="<?php echo $lang === 'en'
                                              ? 'Find answers to common questions about Fancy Wheel services'
                                              : 'ফ্যান্সি হুইল পরিষেবা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন'; ?>">
  <meta property="og:image" content="/image/bus-tea-og.png">
  <meta property="og:url" content="https://yourdomain.com/faq">
  <meta property="og:type" content="website">

  <!-- Twitter Card Meta -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?php echo $lang === 'en'
                                        ? 'FancyWheel - Frequently Asked Questions'
                                        : 'FancyWheel - সচরাচর জিজ্ঞাস্য (FAQs)'; ?>">
  <meta name="twitter:description" content="<?php echo $lang === 'en'
                                              ? 'Find answers to common questions about Fancy Wheel services'
                                              : 'ফ্যান্সি হুইল পরিষেবা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন'; ?>">
  <meta name="twitter:image" content="/image/bus-tea-twitter.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link href="./dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="./dist/css/all.min.css" />
  <script src="./js/all.min.js"></script>
  <script src="./js/jquery-3.6.0.min.js"></script>

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

  <!-- Custom Styles -->
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    .bg {
      background-color: #1f2937;
    }

    .hero-gradient {
      background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
      position: relative;
      overflow: hidden;
    }

    .hero-gradient::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.15) 0%, transparent 50%);
    }

    .glass-card {
      backdrop-filter: blur(16px) saturate(180%);
      background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(51, 65, 85, 0.6));
      border: 1px solid rgba(148, 163, 184, 0.2);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
      transform: translateY(-2px);
      border-color: rgba(148, 163, 184, 0.4);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .faq-icon {
      background: linear-gradient(135deg, #3b82f6, #8b5cf6);
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .icon-rotate {
      transition: transform 0.3s ease;
    }

    .rotate-180 {
      transform: rotate(180deg);
    }

    .content-slide {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      max-height: 0;
      overflow: hidden;
      opacity: 0;
    }

    .content-slide.open {
      max-height: 300px;
      opacity: 1;
    }

    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }

    .shape {
      position: absolute;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      top: 20%;
      left: 10%;
      width: 80px;
      height: 80px;
      background: linear-gradient(45deg, #3b82f6, #8b5cf6);
      border-radius: 50%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      top: 60%;
      right: 15%;
      width: 60px;
      height: 60px;
      background: linear-gradient(45deg, #8b5cf6, #ec4899);
      border-radius: 30%;
      animation-delay: 2s;
    }

    .shape:nth-child(3) {
      bottom: 20%;
      left: 20%;
      width: 100px;
      height: 100px;
      background: linear-gradient(45deg, #06b6d4, #3b82f6);
      border-radius: 25%;
      animation-delay: 4s;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }

    .title-gradient {
      background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 50%, #94a3b8 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .search-container {
      position: relative;
      max-width: 500px;
      margin: 0 auto;
    }

    .search-input {
      background: rgba(30, 41, 59, 0.8);
      border: 1px solid rgba(148, 163, 184, 0.3);
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .search-input:focus {
      border-color: rgba(99, 102, 241, 0.5);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
  </style>
</head>


<body class="bg-gray-900 text-gray-300">
  <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php
    include 'navbar.php';
    ?>
  </nav>

  <?php
  include 'loading.php'
  ?>

  <?php include 'scroll-top-button.php'; ?>

  <!-- Hero Section -->
  <div class="hero-gradient py-20 relative">
    <div class="floating-shapes">
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
      <h1 class="text-3xl md:text-6xl font-bold title-gradient mb-6">
        <?= $lang === 'en' ? 'Frequently Asked Questions' : 'প্রায়শই জিজ্ঞাসিত প্রশ্ন' ?>
      </h1>
      <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
        <?= $lang === 'en'
          ? 'Find answers to common questions about Fancy Wheel services'
          : 'ফ্যান্সি হুইল পরিষেবা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন' ?>
      </p>
    </div>

  </div>

  <!-- FAQ Section -->
  <section class="py-16 px-4 max-w-4xl mx-auto" id="faq">
    <div class="space-y-6">
      <?php foreach ($currentFaqs as $index => $faq): ?>
        <div class="glass-card rounded-2xl overflow-hidden">
          <button class="w-full flex justify-between items-center p-6 text-left faq-toggle focus:outline-none">
            <div class="flex items-center space-x-4 flex-1">
              <div class="faq-icon">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <span class="font-semibold text-lg text-white leading-relaxed"><?= $faq['question'] ?></span>
            </div>
            <svg class="w-6 h-6 text-slate-400 icon-rotate ml-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="faq-content content-slide px-6 pb-6">
            <div class="pl-16">
              <div class="h-px bg-gradient-to-r from-transparent via-slate-700 to-transparent mb-4"></div>
              <p class="text-slate-300 leading-relaxed"><?= $faq['answer'] ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php
  include 'footer.php';
  ?>

  <!-- Enhanced JS Accordion Toggle -->
  <script>
    // Enhanced accordion functionality
    document.querySelectorAll(".faq-toggle").forEach(button => {
      button.addEventListener("click", () => {
        const content = button.nextElementSibling;
        const icon = button.querySelector("svg");
        const isOpen = content.classList.contains("open");

        // Close all other FAQ items
        document.querySelectorAll(".faq-content").forEach(item => {
          if (item !== content) {
            item.classList.remove("open");
            item.classList.add("hidden");
          }
        });

        document.querySelectorAll(".faq-toggle svg").forEach(item => {
          if (item !== icon) {
            item.classList.remove("rotate-180");
          }
        });

        // Toggle current item
        if (isOpen) {
          content.classList.remove("open");
          setTimeout(() => content.classList.add("hidden"), 300);
          icon.classList.remove("rotate-180");
        } else {
          content.classList.remove("hidden");
          setTimeout(() => content.classList.add("open"), 10);
          icon.classList.add("rotate-180");
        }
      });
    });
  </script>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
</body>

</html>