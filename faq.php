<?php include './admin/page/library/db.php' ?>
<?php

$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';

// Include FAQs
$faqData = include './language/faqs-translate.php';
$currentFaqs = $faqData[$lang] ?? $faqData['bn'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'head-log.php' ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $lang === 'en' ? 'Frequently Asked Questions | FancyWin' : 'প্রায়শই জিজ্ঞাসিত প্রশ্নাবলী | ফ্যান্সিউইন'; ?></title>

  <!-- Favicon -->
  <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">

  <!-- SEO Meta Tags -->
  <meta name="description" content="<?php echo $lang === 'en' ? 'Find answers to common questions about FancyWin, your trusted online casino and sportsbook platform. ' : 'আপনার বিশ্বস্ত অনলাইন ক্যাসিনো এবং স্পোর্টসবুক প্ল্যাটফর্ম, ফ্যান্সিউইন সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন।'; ?>">
  <meta name="keywords" content="FancyWin, FAQ, online casino, sportsbook, gambling, support, help">
  <meta name="author" content="FancyWin Team">

  <!-- Open Graph Meta Tags (for social media sharing) -->
  <meta property="og:title" content="Frequently Asked Questions | FancyWin">
  <meta property="og:description" content="Explore the most common questions and answers about FancyWin’s platform, games, and security.">
  <meta property="og:image" content="https://fanciwheel.com/image/PWAicon-192px.png">
  <meta property="og:url" content="https://fanciwheel.com/faq">
  <meta property="og:type" content="website">

  <!-- Twitter Card Meta -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Frequently Asked Questions | FancyWin">
  <meta name="twitter:description" content="Explore the most common questions and answers about FancyWin’s platform, games, and security.">
  <meta name="twitter:image" content="https://fanciwheel.com/image/PWAicon-192px.png">

  <!-- Tailwind CSS -->
  <link href="./dist/output.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    .bg {
      background-color: #1f2937;
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

  <section class="py-10 px-4 max-w-4xl mx-auto" id="faq">
    <div class="mb-8">
      <h2 class="text-3xl font-bold">
        <?= $lang === 'en' ? 'Frequently Asked Questions' : 'প্রায়শই জিজ্ঞাসিত প্রশ্ন' ?>
      </h2>
    </div>

    <div class="space-y-4">
      <?php foreach ($currentFaqs as $faq): ?>
        <div class="border border-gray-200 rounded-md bg-gray-800">
          <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
            <span class="font-medium text-white"><?= $faq['question'] ?></span>
            <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div class="faq-content px-4 pb-4 hidden text-white">
            <p><?= $faq['answer'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php
  include 'footer.php';
  ?>

  <!-- JS Accordion Toggle -->
  <script>
    document.querySelectorAll(".faq-toggle").forEach(button => {
      button.addEventListener("click", () => {
        const content = button.nextElementSibling;
        const icon = button.querySelector("svg");

        content.classList.toggle("hidden");
        icon.classList.toggle("rotate-180");
      });
    });
  </script>

</body>

</html>