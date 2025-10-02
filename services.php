<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';

$servicesTexts = [
    'en' => [
        'title' => 'Milktea & Chittagong Bus Services',
        'subtitle' => 'Fresh Milktea in Bangladesh | Comfortable Bus Rides in Chittagong',

        'milktea' => [
            '🧋 Delicious Milktea Flavors',
            'Our Milktea shop in Bangladesh serves a variety of refreshing flavors like classic milk tea, brown sugar, matcha, fruit teas, and cheese foam specials. Every cup is made fresh with high-quality ingredients.'
        ],

        'quality' => [
            '🌱 Fresh & Premium Ingredients',
            'We use organic tea leaves, fresh milk, and natural flavors to ensure a healthy and delicious experience. No compromise on taste and quality.'
        ],

        'bus_services' => [
            '🚌 Comfortable Bus Services in Chittagong',
            'Our buses in Chittagong provide reliable, safe, and affordable transportation. Whether you are traveling to the city center, nearby towns, or long-distance routes, our buses are on time and comfortable.'
        ],

        'routes' => [
            '📍 Popular Routes',
            'Our Chittagong bus routes cover major destinations including Agrabad, GEC Circle, New Market, Bahaddarhat, and the Inter-District terminals.'
        ],

        'support' => [
            '📞 Customer Support',
            'For both Milktea orders and Bus ticket inquiries, our support team is available via phone, WhatsApp, and Facebook Messenger.'
        ]
    ],

    'bn' => [
        'title' => 'মিল্ক টি ও চট্টগ্রামের বাস সার্ভিস',
        'subtitle' => 'বাংলাদেশে তাজা মিল্ক টি | আরামদায়ক চট্টগ্রাম বাস সার্ভিস',

        'milktea' => [
            '🧋 সুস্বাদু মিল্ক টি',
            'বাংলাদেশে আমাদের মিল্ক টি স্টোরে পাবেন বিভিন্ন স্বাদের মিল্ক টি – ক্লাসিক, ব্রাউন সুগার, ম্যাচা, ফলের চা এবং চিজ ফোম স্পেশাল। প্রতিটি কাপ তাজা ও মানসম্মত উপাদানে তৈরি।'
        ],

        'quality' => [
            '🌱 তাজা ও প্রিমিয়াম উপাদান',
            'আমরা ব্যবহার করি অর্গানিক চা পাতা, তাজা দুধ এবং প্রাকৃতিক ফ্লেভার, যাতে প্রতিটি পানীয় হয় স্বাস্থ্যকর ও সুস্বাদু।'
        ],

        'bus_services' => [
            '🚌 চট্টগ্রামে আরামদায়ক বাস সার্ভিস',
            'চট্টগ্রামে আমাদের বাসগুলো নিরাপদ, নির্ভরযোগ্য এবং সাশ্রয়ী পরিবহন সেবা প্রদান করে। শহরের ভেতর কিংবা দূরপাল্লার যাত্রা – সব জায়গায় সময়মতো আরামদায়ক যাতায়াত নিশ্চিত করা হয়।'
        ],

        'routes' => [
            '📍 জনপ্রিয় রুট',
            'আমাদের বাস রুটগুলোর মধ্যে রয়েছে আগ্রাবাদ, জিইসি মোড়, নিউ মার্কেট, বহদ্দারহাট এবং আন্তঃজেলা বাস টার্মিনাল।'
        ],

        'support' => [
            '📞 গ্রাহক সহায়তা',
            'মিল্ক টি অর্ডার অথবা বাস টিকিট সংক্রান্ত যেকোনো প্রশ্নের জন্য আমাদের টিম ফোন, হোয়াটসঅ্যাপ এবং ফেসবুক মেসেঞ্জারে সর্বদা প্রস্তুত।'
        ]
    ]
];


$texts = $servicesTexts[$lang];
?>

<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn-BD' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Googlebot (main crawler) -->
    <meta name="googlebot" content="index, follow">
    <!-- AdsBot (Google Ads crawler) -->
    <meta name="AdsBot-Google" content="index, follow">
    <!-- Google News crawler -->
    <meta name="googlebot-news" content="index, follow">
    <meta name="robots" content="index, follow">
    <meta name="language" content="<?= $lang === 'en' ? 'English' : 'Bangla' ?>">
    <meta name="author" content="MilkTea & Bus Services">

    <!-- Dynamic Title -->
    <title>
        <?= $lang === 'en'
            ? 'Services'
            : 'সেবা' ?>
    </title>

    <!-- Meta Description -->
    <meta name="description"
        content="<?= $lang === 'en'
                                            ? 'Enjoy fresh Milktea in Bangladesh and safe, comfortable bus rides in Chittagong. Fast delivery, tasty drinks, and reliable transport services.'
                                            : 'বাংলাদেশে তাজা মিল্ক টি উপভোগ করুন এবং চট্টগ্রামে নিরাপদ ও আরামদায়ক বাস যাত্রা। দ্রুত ডেলিভারি, সুস্বাদু পানীয়, এবং নির্ভরযোগ্য পরিবহন।' ?>">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="<?= $lang === 'en'
                                        ? 'Milktea, Bangladesh, Chittagong bus, fresh drinks, boba tea, bus routes, delivery, travel'
                                        : 'মিল্ক টি, বাংলাদেশ, চট্টগ্রাম বাস, তাজা পানীয়, বোবা চা, বাস রুট, ডেলিভারি, ভ্রমণ' ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://fanciwheel.com/">
    <meta property="og:title"
        content="<?= $lang === 'en'
                                            ? 'Milktea & Chittagong Bus Services | Fresh Drinks & Comfortable Rides'
                                            : 'মিল্ক টি ও চট্টগ্রামের বাস সার্ভিস | তাজা পানীয় ও আরামদায়ক যাত্রা' ?>">
    <meta property="og:description"
        content="<?= $lang === 'en'
                                                    ? 'Discover fresh Milktea flavors and reliable bus services in Chittagong. Order online or book your bus now!'
                                                    : 'চট্টগ্রামে তাজা মিল্ক টি এবং নির্ভরযোগ্য বাস সার্ভিস আবিষ্কার করুন। এখনই অনলাইন অর্ডার বা টিকিট বুক করুন!' ?>">
    <meta property="og:image" content="https://fanciwheel.com/images/og-milktea-bus.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://fanciwheel.com/">
    <meta name="twitter:title"
        content="<?= $lang === 'en'
                                            ? 'Milktea & Chittagong Bus Services | Fresh Drinks & Comfortable Rides'
                                            : 'মিল্ক টি ও চট্টগ্রামের বাস সার্ভিস | তাজা পানীয় ও আরামদায়ক যাত্রা' ?>">
    <meta name="twitter:description"
        content="<?= $lang === 'en'
                                                    ? 'Enjoy fresh Milktea and safe, comfortable bus rides in Chittagong. Order online or book your ride today!'
                                                    : 'চট্টগ্রামে তাজা মিল্ক টি এবং নিরাপদ, আরামদায়ক বাস যাত্রা উপভোগ করুন। এখনই অর্ডার বা বুক করুন!' ?>">
    <meta name="twitter:image" content="https://fanciwheel.com/images/og-milktea-bus.jpg">

    <!-- Favicon -->
    <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
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
        <?php
        include 'navbar.php';
        ?>
    </nav>
    <?php
    include 'loading.php'
    ?>
    <?php include 'scroll-top-button.php'; ?>
    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="mb-5">
            <h1 class="text-2xl font-bold text-gray-100"><?= $texts['title'] ?></h1>
            <p class="text-lg mt-2"><?= $texts['subtitle'] ?></p>
        </div>

        <!-- Milktea -->
        <section class="mb-5">
            <h2 class="text-lg font-semibold mb-4 text-gray-100"><?= $texts['milktea'][0] ?></h2>
            <p class="text-gray-300"><?= $texts['milktea'][1] ?></p>
        </section>

        <!-- Quality -->
        <section class="mb-5">
            <h2 class="text-lg font-semibold mb-4 text-gray-100"><?= $texts['quality'][0] ?></h2>
            <p class="text-gray-300"><?= $texts['quality'][1] ?></p>
        </section>

        <!-- Bus Services -->
        <section class="mb-5">
            <h2 class="text-lg font-semibold mb-4 text-gray-100"><?= $texts['bus_services'][0] ?></h2>
            <p class="text-gray-300"><?= $texts['bus_services'][1] ?></p>
        </section>

        <!-- Routes -->
        <section class="mb-5">
            <h2 class="text-lg font-semibold mb-4 text-gray-100"><?= $texts['routes'][0] ?></h2>
            <p class="text-gray-300"><?= $texts['routes'][1] ?></p>
        </section>

        <!-- Support -->
        <section class="mb-5">
            <h2 class="text-lg font-semibold mb-4 text-gray-100"><?= $texts['support'][0] ?></h2>
            <p class="text-gray-300"><?= $texts['support'][1] ?></p>
        </section>
    </main>


    <?php
    include 'footer.php'
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>