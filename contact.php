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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
        <div class="flex items-center bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto mb-10">
                <div class="max-w-md mx-auto bg-black p-5 rounded-md shadow-sm">
                    <div class="text-center">
                        <h1 class="my-3 text-3xl font-semibold text-white dark:text-gray-200">
                            Contact Us
                        </h1>
                        <p class="text-gray-400 dark:text-gray-400 mb-4">
                            Fill up the form below to send us a message.
                        </p>
                    </div>
                    <div class="m-7">
                        <form action="https://api.web3forms.com/submit" method="POST" id="form">
                            <input type="hidden" name="access_key" value="34eb21b0-5f6c-47e7-9906-da930e4f986f" />
                            <input type="hidden" name="subject" value="New Submission from FancyWheel" />
                            <input type="checkbox" name="botcheck" id="" style="display: none;" />

                            <div class="mb-6">
                                <label for="name" class="block mb-2 text-sm text-gray-200 dark:text-gray-400">Full Name</label>
                                <input type="text" name="name" id="name" placeholder="John Doe" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block mb-2 text-sm text-gray-200 dark:text-gray-400">Email Address</label>
                                <input type="email" name="email" id="email" placeholder="you@example.com" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block mb-2 text-sm text-gray-200 dark:text-gray-400">Your Message</label>

                                <textarea rows="5" name="message" id="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" required></textarea>
                            </div>
                            <div class="mb-6">
                                <button type="submit" class="w-full px-3 py-4 text-white bg-blue-600 rounded-md focus:bg-indigo-600 focus:outline-none">
                                    Send Message
                                </button>
                            </div>
                            <p class="text-base text-center text-gray-400" id="result"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>



    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJVFMSG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>
        const form = document.getElementById("form");
        const result = document.getElementById("result");

        form.addEventListener("submit", function(e) {
            const formData = new FormData(form);
            e.preventDefault();
            var object = {};
            formData.forEach((value, key) => {
                object[key] = value;
            });
            var json = JSON.stringify(object);
            result.innerHTML = "Please wait...";

            fetch("https://api.web3forms.com/submit", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json"
                    },
                    body: json
                })
                .then(async (response) => {
                    let json = await response.json();
                    if (response.status == 200) {
                        result.innerHTML = json.message;
                        result.classList.remove("text-gray-500");
                        result.classList.add("text-green-500");
                    } else {
                        console.log(response);
                        result.innerHTML = json.message;
                        result.classList.remove("text-gray-500");
                        result.classList.add("text-red-500");
                    }
                })
                .catch((error) => {
                    console.log(error);
                    result.innerHTML = "Something went wrong!";
                })
                .then(function() {
                    form.reset();
                    setTimeout(() => {
                        result.style.display = "none";
                    }, 5000);
                });
        });
    </script>
</body>

</html>