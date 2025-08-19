<?php
include 'admin/page/library/db.php';
?>

<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'en';
$aboutTexts = include './language/about-translate.php';
$currentTexts = $aboutTexts[$lang] ?? $aboutTexts['en'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="https://fanciwheel.com/image/PWAicon-192px.png" type="image/png">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo $lang === 'en' ? 'About | Evo Hot Game & Lucky Spin ' : 'ইভো হট গেম এবং লাকি স্পিন সম্পর্কে |'; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
 <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
<?php 
include 'loading.php'
?>
<div class="max-w-4xl mx-auto px-4 py-12">
 <h1 class="text-2xl font-bold text-red-600"><?php echo $currentTexts['heading']; ?></h1>

<p class="mb-6 leading-relaxed text-gray-200"><?php echo $currentTexts['intro']; ?></p>
<p class="mb-6 leading-relaxed text-gray-200"><?php echo $currentTexts['cricket_exchange']; ?></p>
<p class="mb-6 leading-relaxed text-gray-200"><?php echo $currentTexts['cockfighting']; ?></p>

<p><strong><?php echo $currentTexts['game_list_title']; ?></strong></p>
<ul class="list-disc list-inside">
    <?php foreach ($currentTexts['game_list'] as $game) {
        echo "<li>$game</li>";
    } ?>
</ul>

<p><?php echo $currentTexts['exclusive_providers']; ?></p>
<p><?php echo $currentTexts['why_choose']; ?></p>
<p><?php echo $currentTexts['banking_options']; ?></p>
<p><?php echo $currentTexts['customer_support']; ?></p>
<p><?php echo $currentTexts['join_us']; ?></p>
<p><?php echo $currentTexts['conclusion']; ?></p>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
