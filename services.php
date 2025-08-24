<?php include './admin/page/library/db.php'?>

<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
$servicesTexts = [
    'en' => [
        'title' => 'Fancywheel Casino Services',
        'subtitle' => 'Trusted Online Gaming | Real Money Wins | 24/7 Support',
        'games' => ['🎮 Variety of Casino Games', 'Fancywin offers an exciting collection of real-money games including slot machines, live dealer games, roulette, blackjack, baccarat, and poker. Our games are fair, fast, and compatible with both mobile and desktop.'],
        'payments' => ['💳 Secure Payment Methods', 'We support fast, secure deposits and withdrawals through local wallets, bank transfers, and crypto (USDT). Every transaction is encrypted for your protection. Get your winnings instantly!'],
        'support' => ['📞 24/7 Customer Support', 'Our dedicated support team is available 24/7 via live chat, email, and Telegram to help you resolve issues fast — whether it’s about gameplay, transactions, or your account.'],
        'bonuses' => ['🎁 Exclusive Bonuses & Promotions', 'New players enjoy a generous welcome bonus, and regular promotions include free spins, cashback offers, and deposit matches. With Fancywin, every day is a chance to win more.'],
        'withdrawals' => ['🔄 Instant Withdrawals', 'Fancywin ensures ultra-fast withdrawals with zero hassle. Your winnings are yours — request payouts anytime, and receive funds within minutes.']
    ],
    'bn' => [
        'title' => 'ফ্যান্সিওয়েল ক্যাসিনো সেবা',
        'subtitle' => 'নির্ভরযোগ্য অনলাইন গেমিং | রিয়েল মানি জিতুন | ২৪/৭ সাপোর্ট',
        'games' => ['🎮 বিভিন্ন ধরণের ক্যাসিনো গেম', 'ফ্যান্সিওয়েল রিয়েল মানির গেমের একটি উত্তেজনাপূর্ণ সংগ্রহ প্রদান করে, যেমন স্লট মেশিন, লাইভ ডিলার, রুলেট, ব্ল্যাকজ্যাক, ব্যাকারাট এবং পোকার। আমাদের গেমগুলো দ্রুত, সুষ্ঠু এবং মোবাইল ও ডেস্কটপের সাথে সামঞ্জস্যপূর্ণ।'],
        'payments' => ['💳 নিরাপদ পেমেন্ট পদ্ধতি', 'আমরা স্থানীয় ওয়ালেট, ব্যাংক ট্রান্সফার এবং ক্রিপ্টো (USDT) মাধ্যমে দ্রুত ও নিরাপদ জমা এবং উত্তোলন সমর্থন করি। প্রতিটি লেনদেন আপনার সুরক্ষার জন্য এনক্রিপ্ট করা হয়েছে। আপনার জয়কৃত অর্থ দ্রুত পান!'],
        'support' => ['📞 ২৪/৭ গ্রাহক সহায়তা', 'আমাদের নিবেদিত সাপোর্ট দল লাইভ চ্যাট, ইমেল এবং টেলিগ্রামের মাধ্যমে ২৪/৭ উপলব্ধ, দ্রুত সমস্যা সমাধানে সাহায্য করতে।'],
        'bonuses' => ['🎁 এক্সক্লুসিভ বোনাস এবং প্রমোশন', 'নতুন খেলোয়াড়রা উদার ওয়েলকাম বোনাস উপভোগ করেন, এবং নিয়মিত প্রমোশনগুলিতে ফ্রি স্পিন, ক্যাশব্যাক অফার এবং ডিপোজিট ম্যাচ অন্তর্ভুক্ত থাকে। ফ্যান্সিওয়েল-এ প্রতিটি দিন আরও জেতার সুযোগ।'],
        'withdrawals' => ['🔄 তাৎক্ষণিক উত্তোলন', 'ফ্যান্সিওয়েল অত্যন্ত দ্রুত উত্তোলন নিশ্চিত করে, কোনো ঝামেলা ছাড়া। আপনার জয়কৃত অর্থ আপনারই — যে কোনো সময় অর্থ উত্তোলনের অনুরোধ করুন এবং মিনিটের মধ্যে পান।']
    ]
];

$texts = $servicesTexts[$lang];
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta name="robots" content="index, follow">
      <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Primary Meta Tags -->
<title><?php echo $lang === 'en' ? 'Fancywheel - Trusted Online Casino | Big Wins, Fast Payments, 24/7 Support' : 'ফ্যান্সিহুইল - বিশ্বস্ত অনলাইন ক্যাসিনো | বড় জয়, দ্রুত অর্থপ্রদান, 24/7 সহায়তা'; ?></title>

<link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
<meta name="title" content="Fancywin - Trusted Online Casino | Big Wins, Fast Payments, 24/7 Support">
<meta name="description" content="<?php echo $lang === 'en' ? 'Play at Fancywin – the trusted online casino with secure payments, instant withdrawals, exciting bonuses, and real money wins. Join now & start winning!' : 'ফ্যান্সিউইন-এ খেলুন - নিরাপদ পেমেন্ট, তাৎক্ষণিক উত্তোলন, উত্তেজনাপূর্ণ বোনাস এবং আসল অর্থ জয়ের সাথে বিশ্বস্ত অনলাইন ক্যাসিনো। এখনই যোগদান করুন এবং জেতা শুরু করুন!'; ?>">
<meta name="keywords" content="Fancywin, online casino, win real money, fast withdrawal, secure payments, casino bonuses, slots, live dealer, 24/7 support">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="author" content="Fancywin">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://fanciwheel.com/">
<meta property="og:title" content="Fancywin - Trusted Online Casino | Big Wins, Fast Payments, 24/7 Support">
<meta property="og:description" content="Join Fancywin today and enjoy secure online gaming, fast payouts, and 24/7 customer support.">
<meta property="og:image" content="https://fancywheel.com/images/og-banner.jpg">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://fancywheel.com/">
<meta property="twitter:title" content="Fancywin - Trusted Online Casino | Big Wins, Fast Payments, 24/7 Support">
<meta property="twitter:description" content="Play real money games and withdraw instantly at Fancywin. Safe, licensed, and available 24/7.">
<meta property="twitter:image" content="https://fancywheel.com/images/og-banner.jpg">
<link rel="stylesheet" href="./dist/output.css">
</head>

<body class="bg-gray-900 text-white">
<nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php 
    include 'navbar.php';
    ?>
  </nav>
  <?php 
include 'loading.php'
?>
 <?php include 'scroll-top-button.php'; ?>
  <main class="px-6 py-12 max-w-6xl mx-auto">
    <div class="mb-5">
        <h1 class="text-3xl font-bold text-red-600"><?= $texts['title'] ?></h1>
        <p class="text-lg mt-2"><?= $texts['subtitle'] ?></p>
    </div>

    <!-- Games -->
    <section class="mb-5">
        <h2 class="text-2xl font-semibold mb-4"><?= $texts['games'][0] ?></h2>
        <p class="text-gray-300"><?= $texts['games'][1] ?></p>
    </section>

    <!-- Payments -->
    <section class="mb-5">
        <h2 class="text-2xl font-semibold mb-4"><?= $texts['payments'][0] ?></h2>
        <p class="text-gray-300"><?= $texts['payments'][1] ?></p>
    </section>

    <!-- Support -->
    <section class="mb-5">
        <h2 class="text-2xl font-semibold mb-4"><?= $texts['support'][0] ?></h2>
        <p class="text-gray-300"><?= $texts['support'][1] ?></p>
    </section>

    <!-- Bonuses -->
    <section class="mb-5">
        <h2 class="text-2xl font-semibold mb-4"><?= $texts['bonuses'][0] ?></h2>
        <p class="text-gray-300"><?= $texts['bonuses'][1] ?></p>
    </section>

    <!-- Withdrawals -->
    <section class="mb-5">
        <h2 class="text-2xl font-semibold mb-4"><?= $texts['withdrawals'][0] ?></h2>
        <p class="text-gray-300"><?= $texts['withdrawals'][1] ?></p>
    </section>
</main>

<?php
 include 'footer.php'
?>
</body>
</html>
