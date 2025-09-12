<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang === 'en' ? 'Privacy Policy' : 'গোপনীয়তা নীতি' ?></title>
    <link href="./dist/output.css" rel="stylesheet">
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
        <h1 class="text-3xl font-bold mb-6">
            <?= $lang === 'en' ? 'Privacy Policy' : 'গোপনীয়তা নীতি' ?>
        </h1>

        <p class="mb-4">
            <?= $lang === 'en' ?
                'Your privacy is important to us. This policy explains what personal information we collect, how we use it, and your rights.' :
                'আপনার গোপনীয়তা আমাদের জন্য গুরুত্বপূর্ণ। এই নীতি ব্যাখ্যা করে আমরা কোন ব্যক্তিগত তথ্য সংগ্রহ করি, কিভাবে এটি ব্যবহার করি এবং আপনার অধিকার।' ?>
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">
            <?= $lang === 'en' ? 'Information We Collect' : 'আমরা যে তথ্য সংগ্রহ করি' ?>
        </h2>
        <p class="mb-4">
            <?= $lang === 'en' ?
                'We may collect information such as your name, email, and activity on our website to improve our services.' :
                'আমরা আপনার নাম, ইমেল এবং আমাদের ওয়েবসাইটে আপনার কার্যকলাপের মতো তথ্য সংগ্রহ করতে পারি যাতে আমাদের পরিষেবাগুলি উন্নত করা যায়।' ?>
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">
            <?= $lang === 'en' ? 'How We Use Information' : 'আমরা তথ্য কিভাবে ব্যবহার করি' ?>
        </h2>
        <p class="mb-4">
            <?= $lang === 'en' ?
                'We use the information to personalize your experience, improve website functionality, and send updates if you consent.' :
                'আমরা তথ্যটি ব্যবহার করি আপনার অভিজ্ঞতা ব্যক্তিগতকরণ করতে, ওয়েবসাইটের কার্যকারিতা উন্নত করতে এবং যদি আপনি সম্মত হন তবে আপডেট পাঠাতে।' ?>
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">
            <?= $lang === 'en' ? 'Cookies' : 'কুকিজ' ?>
        </h2>
        <p class="mb-4">
            <?= $lang === 'en' ?
                'Our website uses cookies to enhance user experience and track website usage.' :
                'আমাদের ওয়েবসাইট ব্যবহারকারীর অভিজ্ঞতা বাড়ানোর জন্য এবং ওয়েবসাইট ব্যবহারের ট্র্যাক করার জন্য কুকিজ ব্যবহার করে।' ?>
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">
            <?= $lang === 'en' ? 'Your Rights' : 'আপনার অধিকার' ?>
        </h2>
        <p class="mb-4">
            <?= $lang === 'en' ?
                'You have the right to access, correct, or delete your personal information. Contact us if you wish to exercise these rights.' :
                'আপনার ব্যক্তিগত তথ্য অ্যাক্সেস, সংশোধন বা মুছে ফেলার অধিকার রয়েছে। এই অধিকারগুলি ব্যবহার করতে আমাদের সাথে যোগাযোগ করুন।' ?>
        </p>

        <p class="mt-6 text-sm text-gray-500">
            <?= $lang === 'en' ? 'Last updated: September 2025' : 'শেষ আপডেট: সেপ্টেম্বর ২০২৫' ?>
        </p>
    </div>


    <?php include 'footer.php'; ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>