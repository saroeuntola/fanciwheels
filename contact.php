<?php include './admin/page/library/db.php' ?>

<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
?>

<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? $lang === 'en' ? 'Contact us' : 'আমাদের সাথে যোগাযোগ করুন'?> | Fancy Wheel</title>
    <meta name="description" content="Contact us for inquiries, support, or collaboration. Connect with us on Facebook, Telegram, or our website.">
    <meta name="keywords" content="Contact, Support, Facebook, Telegram, Fancy Wheel">
    <meta name="author" content="Fancy Wheel">
    <link rel="stylesheet" href="./dist/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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

    <section class="py-10 px-4 max-w-4xl mx-auto">

        <h1 class="lg:text-3xl text-2lg font-bold text-center mb-4 text-white"><?= $lang === 'en' ? 'Contact Us' : 'আমাদের সাথে যোগাযোগ করুন' ?></h1>
        <p class="text-center lg:text-lg text-sm text-gray-300 mb-6">
            <?= $lang === 'en'
                ? "Have questions or feedback? We'd love to hear from you! Fill out the form below or reach us through our social channels."
                : "আপনার প্রশ্ন বা মতামত আছে? আমরা আপনার কাছ থেকে শুনতে আগ্রহী! নিচের ফর্মটি পূরণ করুন অথবা আমাদের সামাজিক চ্যানেলের মাধ্যমে যোগাযোগ করুন।"
            ?>
        </p>
        <form class="p-6 rounded-lg shadow-md space-y-4 bg-gray-800 text-white">
            <div>
                <label for="name" class="block font-medium mb-1"><?= $lang === 'en' ? 'Name' : 'নাম' ?></label>
                <input type="text" id="name" name="name" class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="<?= $lang === 'en' ? 'Your Name' : 'তোমার নাম' ?>">
            </div>
            <div>
                <label for="email" class="block font-medium mb-1"> <?= $lang === 'en' ? 'Email' : 'ইমেইল' ?></label>
                <input type="email" id="email" name="email" class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="<?= $lang === 'en' ? 'Your Email' : 'তোমার ইমেইল' ?>">
            </div>
            <div>
                <label for="message" class="block font-medium mb-1"><?= $lang === 'en' ? 'Message' : 'বার্তা' ?></label>
                <textarea id="message" name="message" rows="5" class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="<?= $lang === 'en' ? 'Your Massage' : 'তোমার বার্তা' ?>"></textarea>
            </div>
            <button class=" text-white font-semibold px-4 py-2 rounded-full bg-gradient-to-r from-blue-600 to-purple-600">
                <?= $lang === 'en' ? 'Send Message' : 'বার্তা পাঠান' ?>
            </button>
        </form>
    </section>

</body>

</html>