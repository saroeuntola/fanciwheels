<?php
include "./admin/page/library/game_lib.php";
include "./admin/page/library/db.php";
$gameObj = new Games();

// Get search query
$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$games = $query ? $gameObj->searchgames($query) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head-log.php' ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-900 font-sans text-gray-100">

 <nav class="w-full shadow-md sticky top-0 z-50 bg-gray-800">
    <?php include 'navbar.php'; ?>
  </nav>
<?php 
include 'loading.php'
?>
<!-- Header Banner -->
<section class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-16 text-center shadow-md">
  <div class="max-w-4xl mx-auto px-4">
    <h1 class="text-4xl font-extrabold mb-2 tracking-tight"><?= $lang === 'en' ? 'Search Results' : 'তোমার স্পিন টাইম যথেষ্ট!' ?></h1>
    <p class="text-lg font-medium">
      <?= $lang === 'en' ? 'Showing results for' : 'এর জন্য ফলাফল দেখানো হচ্ছে' ?> <span class="underline underline-offset-2"><?= htmlspecialchars($query) ?></span>
    </p>
  </div>
</section>

<main class="container max-w-7xl mx-auto px-4 md:px-[25px] lg:px-[38px] py-12">
  <?php if ($query && count($games) > 0): ?>
    <!-- Game Results Grid -->
    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($games as $g): ?>
        <div class="group relative bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 overflow-hidden">
          <!-- Image -->
          <a href="detail?id=<?= $g['id'] ?>">
            <?php if (!empty($g['image'])): ?>
              <img src="<?= './admin/page/game/' . htmlspecialchars($g['image']) ?>"
                   alt="<?= htmlspecialchars($g['name']) ?>"
                   class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
            <?php else: ?>
              <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                <span class="text-gray-400 font-medium">No Image</span>
              </div>
            <?php endif; ?>
          </a>

          <!-- Info -->
          <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-100 mb-1 group-hover:text-blue-400 transition-colors">
              <?= htmlspecialchars($g['name']) ?>
            </h3>
            <p class="text-gray-300 text-sm line-clamp-2 leading-relaxed">
              <?= htmlspecialchars($g['description']) ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php elseif ($query): ?>
    <!-- No Results -->
    <div class="text-center py-20">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-700 rounded-full mb-4">
        <i class="fas fa-search text-gray-400 text-2xl"></i>
      </div>
      <h2 class="text-xl font-semibold text-gray-300 mb-2">No post found</h2>
      <p class="text-gray-500 mb-6">We couldn’t find any matches for "<strong><?= htmlspecialchars($query) ?></strong>".</p>
      <a href="/" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">
        Back to Home
      </a>
    </div>
  <?php else: ?>
    <!-- No Query -->
    <div class="text-center py-20">
      <p class="text-lg text-gray-400"><?= $lang === 'en' ? 'Please enter a search term to see results.' : 'ফলাফল দেখতে অনুগ্রহ করে একটি অনুসন্ধান শব্দ লিখুন।' ?></p>
    </div>
  <?php endif; ?>
</main>

</body>
</html>
