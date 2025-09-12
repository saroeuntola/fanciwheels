<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "./admin/page/library/db.php";
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
?>

<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'bn-BD' ?>">

<head>
    <meta charset="UTF-8">
    <?php include 'head-log.php'; ?>
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang === 'en' ? 'Contact us' : 'যোগাযোগ করুন' ?> | Fancy Wheel</title>

    <link rel="icon" href="./image/PWAicon-192px.png" type="image/png">
    <meta name="description" content="Contact us for inquiries, support, or collaboration. Connect with us on Facebook, Telegram, or our website.">
    <meta name="keywords" content="Contact, Support, Facebook, Telegram,tik tok, Fancy Wheel">
    <meta name="author" content="Fancy Wheel">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-98CRLK26X1"></script>
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

    <section class="py-10 p-4 max-w-2xl mx-auto">

        <h1 class="lg:text-3xl text-2lg font-bold text-center mb-4 text-white">
            <?= $lang === 'en' ? 'Contact Us' : 'যোগাযোগ করুন' ?>
        </h1>
        <p class="text-center lg:text-lg text-sm text-gray-300 mb-6">
            <?= $lang === 'en'
                ? "Have questions or feedback? We'd love to hear from you! Fill out the form below or reach us through our social channels."
                : "আপনার প্রশ্ন বা মতামত আছে? আমরা আপনার কাছ থেকে শুনতে আগ্রহী! নিচের ফর্মটি পূরণ করুন অথবা আমাদের সামাজিক চ্যানেলের মাধ্যমে যোগাযোগ করুন।"
            ?>
        </p>

        <form id="contactForm" class="p-6 rounded-lg shadow-md space-y-4 bg-gray-800 text-white">
            <div>
                <label for="name" class="block font-medium mb-1"><?= $lang === 'en' ? 'Name' : 'নাম' ?></label>
                <input type="text" id="name" name="name"
                    class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="<?= $lang === 'en' ? 'Your Name' : 'তোমার নাম' ?>">
            </div>
            <div>
                <label for="email" class="block font-medium mb-1"> <?= $lang === 'en' ? 'Email' : 'ইমেইল' ?></label>
                <input type="email" id="email" name="email"
                    class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="<?= $lang === 'en' ? 'Your Email' : 'তোমার ইমেইল' ?>">
            </div>
            <div>
                <label for="message" class="block font-medium mb-1"><?= $lang === 'en' ? 'Message' : 'বার্তা' ?></label>
                <textarea id="message" name="message" rows="5"
                    class="w-full border border-gray-600 rounded px-3 py-2 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="<?= $lang === 'en' ? 'Your Message' : 'তোমার বার্তা' ?>"></textarea>
            </div>
            <button type="submit"
                class="text-white font-semibold px-4 py-2 rounded-full bg-gradient-to-r from-blue-600 to-purple-600">
                <?= $lang === 'en' ? 'Send Message' : 'বার্তা পাঠান' ?>
            </button>
        </form>
    </section>



    <?php include 'footer.php' ?>
    <!-- Toastr CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        document.getElementById("contactForm").addEventListener("submit", function(e) {
            e.preventDefault();

            // Get form values
            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let message = document.getElementById("message").value.trim();

            if (!name || !email || !message) {
                toastr.error("Please fill in all fields", "Error");
                return;
            }

            // Simulate successful post
            toastr.success("Your message has been sent successfully!", "Success 🎉");

            // Reset form
            document.getElementById("contactForm").reset();
        });
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>