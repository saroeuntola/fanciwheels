<?php include './admin/page/library/db.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frequently Asked Questions | FancyWin</title>
  
  <!-- Favicon -->
  <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">

  <!-- SEO Meta Tags -->
  <meta name="description" content="Find answers to common questions about FancyWin, your trusted online casino and sportsbook platform.">
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
  <script src="https://cdn.tailwindcss.com"></script>

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
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold">Frequently Asked Questions</h2>
    </div>

    <div class="space-y-4">
      <!-- FAQ Item 1 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">What is FancyWin?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>FancyWin is a leading online sportsbook and casino offering a wide range of sports betting options, casino games, and promotions.</p>
        </div>
      </div>

      <!-- FAQ Item 2 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">Is FancyWin secure and reliable?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Yes, FancyWin is fully licensed and uses advanced encryption to protect user data and transactions.</p>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">How do I create an account?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Click the "Sign Up" button on our homepage, fill in your details, and follow the instructions to activate your account.</p>
        </div>
      </div>

      <!-- FAQ Item 4 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">How can I deposit money?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Log into your account, go to the cashier section, and choose from our secure payment methods to deposit funds.</p>
        </div>
      </div>

      <!-- FAQ Item 5 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">How do I withdraw my winnings?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>You can withdraw your winnings through bank transfers, e-wallets, or other supported methods in your region.</p>
        </div>
      </div>

      <!-- FAQ Item 6 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">Are there any bonuses for new users?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Yes! New users get a welcome bonus after registering and making their first deposit. Check the promotions page for details.</p>
        </div>
      </div>

      <!-- FAQ Item 7 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">Can I play FancyWin games on mobile?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Absolutely! Our website is mobile-optimized and works on all modern smartphones and tablets.</p>
        </div>
      </div>

      <!-- FAQ Item 8 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">What games are available?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>We offer slots, live casino, sports betting, fishing games, and many more categories from top game providers.</p>
        </div>
      </div>

      <!-- FAQ Item 9 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">How do I contact support?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>You can reach our 24/7 support team through live chat, email, or Telegram for quick assistance.</p>
        </div>
      </div>

      <!-- FAQ Item 10 -->
      <div class="border border-gray-200 rounded-md bg">
        <button class="w-full flex justify-between items-center p-4 text-left faq-toggle">
          <span class="font-medium text-white">Is there a VIP program?</span>
          <svg class="w-5 h-5 text-white transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-content px-4 pb-4 hidden text-white">
          <p>Yes, FancyWin offers a VIP program with exclusive rewards, cashback offers, and priority customer service for loyal users.</p>
        </div>
      </div>
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
