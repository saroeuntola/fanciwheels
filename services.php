<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';

$servicesTexts = [
    'en' => [
        'title' => 'Services',
        'subtitle' => 'At Fancy Wheel, we’re spinning up something special for our community of Crazy Time enthusiasts, Chittagong explorers, and milk tea lovers! While we’re still fine-tuning our offerings (think of it as waiting for the perfect multiplier on the wheel), here’s a sneak peek at the exciting services we’re developing to make your experience even more thrilling:',

        'list1' => [
            '<strong>Crazy Time Strategy Workshops:</strong> Get ready to level up your game with our upcoming interactive online sessions! Led by seasoned Crazy Time players, these workshops will break down winning strategies, bonus round tactics, and bankroll management tips. It’s like having a backstage pass to the wheel – without the glittery game show suit.'
        ],

        'list2' => [
            '<strong>Chittagong Insider Tours:</strong>We’re crafting exclusive, curated tours of Chittagong’s hottest spots, from hidden milk tea stalls to breathtaking cultural landmarks like Foy’s Lake and the Zia Memorial Museum. Perfect for locals and visitors alike, these tours will blend adventure, history, and, of course, a refreshing cup of dudh cha or bubble tea.',

        ],

        'list3' => [
            '<strong>Milk Tea Tasting Events:</strong> Calling all tea aficionados! We’re brewing plans for virtual and in-person milk tea tasting events, where you can sample Chittagong’s finest blends, learn about the art of tea-making, and discover new flavors. Think of it as a bonus round for your taste buds, complete with tapioca pearls and spicy cha gossip.',

        ],

        'list4' => [
            '<strong>Community Forum Membership:</strong>Our vibrant forums are already buzzing, but we’re working on a premium membership tier packed with exclusive content, like expert Crazy Time webinars, insider Chittagong travel guides, and milk tea recipe e-books. Join the inner circle and spin, sip, and explore like a VIP!'
        ],

    ],

    'bn' => [
        'title' => 'সেবা',
        'subtitle' => 'Fancy Wheel-এ, আমরা Crazy Time প্রেমিকদের, চট্টগ্রাম ভ্রমণকারীদের এবং দুধ চা প্রেমীদের জন্য বিশেষ কিছু পরিকল্পনা করছি! আমরা আমাদের সেবাগুলো আরও নিখুঁত করতে কাজ করছি (ধরে নিন এটি হলো চাকার পারফেক্ট মাল্টিপ্লায়ারের জন্য অপেক্ষা করা), তবে এখানে কিছু আগাম ঝলক যা আপনার অভিজ্ঞতাকে আরও রোমাঞ্চকর করবে:',

        'list1' => [
            '<strong>Crazy Time কৌশল কর্মশালা:</strong> আমাদের আসন্ন ইন্টারঅ্যাক্টিভ অনলাইন সেশনে আপনার খেলার দক্ষতা বাড়ানোর জন্য প্রস্তুত হন! অভিজ্ঞ Crazy Time খেলোয়াড়রা এই কর্মশালায় জেতার কৌশল, বোনাস রাউন্ড ট্যাকটিক, এবং ব্যাঙ্করোল ম্যানেজমেন্ট টিপস শেয়ার করবেন। এটি এমন যেমন একটি ব্যাকস্টেজ পাস পাবেন – কিন্তু ঝলমলে গেম শো স্যুট ছাড়া।'
        ],

        'list2' => [
            '<strong>চট্টগ্রাম ইনসাইডার টুর:</strong> আমরা চট্টগ্রামের সবচেয়ে আকর্ষণীয় জায়গাগুলোর এক্সক্লুসিভ, কিউরেটেড ট্যুর তৈরি করছি, লুকানো দুধ চা স্টল থেকে শুরু করে Foy’s Lake এবং Zia Memorial Museum-এর মতো সাংস্কৃতিক স্থান পর্যন্ত। স্থানীয় এবং পর্যটকদের জন্য উপযুক্ত, এই ট্যুরগুলো অ্যাডভেঞ্চার, ইতিহাস এবং অবশ্যই একটি রিফ্রেশিং কাপ দুধ চা বা বুবল টি মিলিয়ে দেবে।',
        ],

        'list3' => [
            '<strong>মিল্ক টি টেস্টিং ইভেন্ট:</strong> সব চা প্রেমীদের জন্য! আমরা ভার্চুয়াল এবং ইন-পার্সন মিল্ক টি টেস্টিং ইভেন্টের পরিকল্পনা করছি, যেখানে আপনি চট্টগ্রামের সেরা ব্লেন্ডগুলো স্বাদ নিতে পারবেন, চা বানানোর কলা শিখতে পারবেন, এবং নতুন ফ্লেভার আবিষ্কার করতে পারবেন। এটি আপনার স্বাদবোধের জন্য একটি বোনাস রাউন্ডের মতো, সাথে থাকবে ট্যাপিওকা পার্লস এবং চা সম্পর্কিত গসিপ।',
        ],

        'list4' => [
            '<strong>কমিউনিটি ফোরাম সদস্যপদ:</strong> আমাদের জীবন্ত ফোরামগুলো ইতিমধ্যেই ব্যস্ত, তবে আমরা একটি প্রিমিয়াম সদস্যপদ তৈরি করছি যেখানে থাকবে এক্সক্লুসিভ কন্টেন্ট, যেমন Crazy Time বিশেষজ্ঞদের ওয়েবিনার, চট্টগ্রাম ভ্রমণ গাইড, এবং মিল্ক চা রেসিপি ই-বুক। আভ্যন্তরীণ সার্কেলে যোগ দিন এবং স্পিন করুন, চা পান করুন এবং VIP-এর মতো অন্বেষণ করুন!'
        ],
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
        content="<?= $texts['subtitle'] ?>">

    <!-- Meta Keywords -->
    <meta name="keywords"
        content="<?= $lang === 'en'
                        ? 'spin game, fancy wheel, Milktea, Bangladesh, Chittagong bus, fresh drinks, boba tea, bus routes, delivery, travel'
                        : 'spin game, fancy wheel, Milktea, Bangladesh, Chittagong bus, fresh drinks, boba tea, bus routes, delivery, travel, মিল্ক টি, বাংলাদেশ, চট্টগ্রাম বাস, তাজা পানীয়, বোবা চা, বাস রুট, ডেলিভারি, ভ্রমণ' ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://fanciwheel.com/">
    <meta property="og:title"
        content="<?= $texts['title'] ?>">
    <meta property="og:description"
        content="<?= $texts['subtitle'] ?>">
    <meta property="og:image" content="https://fanciwheel.com/images/og-milktea-bus.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://fanciwheel.com/">
    <meta name="twitter:title"
        content="<?= $texts['title'] ?>">
    <meta name="twitter:description"
        content="<?= $texts['subtitle'] ?>">
    <meta name="twitter:image" content="https://fanciwheel.com/images/og-milktea-bus.jpg">
    <link rel="alternate" href="https://fanciwheel.com/?lang=en" hreflang="en" />
    <link rel="alternate" href="https://fanciwheel.com/?lang=bn" hreflang="bn" />
    <link rel="alternate" href="https://fanciwheel.com/" hreflang="x-default" />
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

<style>
    .list-text {
        margin-left: 20px;
    }
</style>

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
            <p class=" mt-2"><?= $texts['subtitle'] ?></p>
        </div>
        <section class="mb-5">
            <ul class="list-disc list-outside text-gray-100 space-y-3 leading-relaxed list-text">
                <li><?= $texts['list1'][0] ?></li>
                <li><?= $texts['list2'][0] ?></li>
                <li><?= $texts['list3'][0] ?></li>
                <li><?= $texts['list4'][0] ?></li>
            </ul>
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