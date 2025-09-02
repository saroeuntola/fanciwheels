<?php
include './admin/page/library/users_lib.php';
include './admin/page/library/brand_lib.php';
include 'helpers.php';
include './config/baseURL.php';

$auth = new User();
$brand = new Brand();
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['user_id'] ?? null;
$brandList = $brand->getBrand();
$user = null;

if ($userId) {
  $userLib = new User();
  $user = $userLib->getUserByID($userId);
}

$profileImage = isset($user['profile']) && !empty($user['profile']) ? $user['profile'] : 'default.png';
$profilePath = '/admin/page/user/user_image/' . htmlspecialchars($profileImage);
$fullPath = '/admin/page/user/user_image/' . $profileImage;
if (!file_exists($fullPath)) {
  $profilePath = '/admin/page/user/user_image/default.png';
}

$currentPage = basename($_SERVER['PHP_SELF']);
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
$currentId = isset($_GET['slug']) ? trim($_GET['slug']) : null;

function buildLangUrl($langTarget, $currentPage, $currentId)
{
  $params = ['lang' => $langTarget];
  if ($currentPage === 'detail.php' && $currentId) {
    $params['slug'] = $currentId;
  }
  return $currentPage . '?' . http_build_query($params);
}

$menu = [
  'home' => $lang === 'en' ? 'Home' : 'হোমপেজ',
  'services' => $lang === 'en' ? 'Services' : 'সেবা',
  'about' => $lang === 'en' ? 'About' : 'সম্পর্কে',
  'faq' => $lang === 'en' ? 'FAQs' : 'FAQs',
  'join' => $lang === 'en' ? 'Join Now' : 'যোগদান করুন',
  'search' => $lang === 'en' ? 'Search...' : 'অনুসন্ধান করুন...',
  'contact' => $lang === 'en' ? 'Contact' : 'যোগাযোগ'
];

$languageNames = [
  'en' => 'English',
  'bn' => 'বাংলা'
];
$fullLangName = $languageNames[$lang] ?? 'Unknown Language';
?>


<!-- Navbar -->
<nav class="bg-gray-800 relative shadow-2xl border-b border-white/10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="flex justify-between items-center h-16">
      <!-- Mobile Hamburger + Site Title -->
      <div class="lg:hidden flex items-center w-full justify-between">
        <div class="flex items-center gap-3">
          <!-- Hamburger -->
          <button id="mobileToggle" class=" text-white focus:outline-none">
            <svg id="mobileHamburger" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <!-- Site Title -->
          <a href="/?lang=<?= $lang ?>" class="text-white text-lg font-bold">Fancy Wheel</a>
        </div>

        <!-- Search & Profile -->
        <div class="flex items-center">
          <button id="mobileSearchBtn" class=" text-white focus:outline-none"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg></button>

          <!-- mobile lang -->
          <div class="relative">
            <!-- Language Button -->
            <button id="lang-btn-mobile" class="flex items-center text-white px-3 py-2 rounded-md hover:bg-green-600 focus:outline-none">
              <img id="lang-flag-mobile" src="./image/flag/<?= $lang === 'en' ? 'en' : 'bn' ?>.svg" class="w-6 h-4 ml-2" alt="Flag">
              <span class="ml-2 font-medium"><?= $lang === 'en' ? 'EN' : 'BN' ?></span>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Language Dropdown -->
            <div id="lang-menu-mobile" class="hidden absolute right-0 mt-2 w-36 bg-gray-800 rounded-md shadow-lg z-50">
              <?php foreach ($languageNames as $code => $name): ?>
                <?php if ($code !== $lang): ?>
                  <a href="<?= buildLangUrl($code, $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 text-white hover:bg-gray-100 transition">
                    <img src="./image/flag/<?= $code ?>.svg" class="w-6 h-4 mr-2" alt="<?= $name ?> Flag">
                    <span><?= $name ?></span>
                  </a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <?php if ($userId): ?>
            <button id="mobileProfileBtn" class="relative p-1 rounded-full bg-white/10 border border-white/20">
              <img src="<?= $profilePath ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover">
            </button>
          <?php else: ?>
            <a href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank"
              class="text-sm text-white px-3 py-1 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 flex items-center">
              <!-- User icon SVG -->
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M12 12a5 5 0 100-10 5 5 0 000 10z" />
              </svg>

            </a>

          <?php endif; ?>

        </div>

      </div>



      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center w-full">
        <!-- Site Title -->
        <a href="/?lang=<?= $lang ?>" class="text-white text-2xl font-bold mr-8">Fancy Wheel</a>
        <!-- Navigation-->
        <div class="flex items-center gap-4 ml-auto">
          <nav class="flex space-x-6">
            <?= navLink('/', $menu['home'], $lang, $currentPage, $currentId) ?>
            <?= navLink('services', $menu['services'], $lang, $currentPage, $currentId) ?>
            <?= navLink('about', $menu['about'], $lang, $currentPage, $currentId) ?>
            <?= navLink('faq', $menu['faq'], $lang, $currentPage, $currentId) ?>
            <?= navLink('contact', $menu['contact'], $lang, $currentPage, $currentId) ?>
          </nav>

          <!-- Search -->
          <button id="openSearchModal" class="flex items-center text-white p-2 rounded-full hover:bg-white/10 transition gap-2">
            <?= $lang === 'en' ? 'Search...' : 'অনুসন্ধান...' ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>

          <!-- Language Button desktop-->
          <div class="relative">
            <button id="lang-btn-desktop" class="flex items-center text-white px-3 py-2 rounded-md hover:bg-green-600 focus:outline-none">
              <img id="lang-flag-desktop" src="./image/flag/<?= $lang === 'en' ? 'en' : 'bn' ?>.svg" class="w-6 h-4 ml-2" alt="Flag">
              <span class="ml-2 font-medium"><?= $lang === 'en' ? 'English' : 'বাংলা' ?></span>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Language Dropdown desktop -->
            <div id="lang-menu-desktop" class="hidden absolute right-0 mt-2 w-36 bg-gray-800 rounded-md shadow-lg z-50">
              <?php foreach ($languageNames as $code => $name): ?>
                <?php if ($code !== $lang): ?>
                  <a href="<?= buildLangUrl($code, $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 text-white hover:bg-gray-100 transition">
                    <img src="./image/flag/<?= $code ?>.svg" class="w-6 h-4 mr-2" alt="<?= $name ?> Flag">
                    <span><?= $name ?></span>
                  </a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Profile / Join -->
          <?php if ($userId): ?>
            <div class="relative">
              <button id="profileMenuBtn" class="group flex items-center gap-2 px-3 py-2 rounded-full bg-white/10 border border-white/20">
                <img src="<?= $profilePath ?>" alt="" class="w-8 h-8 object-cover rounded-full border-2 border-white/30">
                <span class="text-white/90 text-sm"><?= htmlspecialchars(substr($username, 0, 8)) ?></span>
                <svg class="w-4 h-4 text-white/60 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-slate-800/95 backdrop-blur-lg border border-slate-700/50 text-white rounded-xl shadow-2xl hidden z-[9999] overflow-hidden">
                <a href="<?= $baseURL ?>/admin/page/user/profile.php" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50">Profile</a>
                <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10">Logout</a>
              </div>
            </div>
          <?php else: ?>
            <a href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700"><?= $menu['join'] ?></a>
          <?php endif; ?>


        </div>

      </div>

    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="lg:hidden hidden bg-primary text-white">
    <div class="flex flex-col p-4 space-y-3">
      <?= navLink('/', $menu['home'], $lang, $currentPage, $currentId) ?>
      <?= navLink('services', $menu['services'], $lang, $currentPage, $currentId) ?>
      <?= navLink('about', $menu['about'], $lang, $currentPage, $currentId) ?>
      <?= navLink('faq', $menu['faq'], $lang, $currentPage, $currentId) ?>
      <?= navLink('contact', $menu['contact'], $lang, $currentPage, $currentId) ?>
    </div>

  </div>

</nav>


<!-- Search Modal (shared for Desktop & Mobile) -->
<div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
  <div class="bg-gray-600 w-full h-full max-w-4xl max-h-full overflow-y-auto relative p-4">
    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-4">
      <h2 class="text-xl text-white font-bold"><?= $lang === 'en' ? 'Search' : 'অনুসন্ধান' ?></h2>
      <button onclick="closeSearchModal()" class="text-white text-3xl font-bold cursor-pointer">&times;</button>
    </div>

    <!-- Search Input -->
    <div class="mt-4">
      <input type="text" id="search-box" placeholder="<?= $lang === 'en' ? 'Type to search...' : 'অনুসন্ধান করতে টাইপ করুন...' ?>"
        class="w-full px-4 py-3 rounded-md border focus:outline-none focus:ring-2 focus:ring-green-500 text-black">
    </div>

    <!-- Loading Indicator -->
    <div id="search-loading" class="hidden mt-2 text-white"><?= $lang === 'en' ? 'Loading...' : 'লোড হচ্ছে...' ?></div>
    <!-- Search Results Grid -->
    <div id="search-results" class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function() {

    // ===== Language Dropdowns =====
    function setupLangDropdown(btnSelector, menuSelector) {
      const $btn = $(btnSelector),
        $menu = $(menuSelector);

      $btn.click(function(e) {
        e.stopPropagation();
        $menu.toggleClass('hidden');
      });

      $(document).click(function() {
        $menu.addClass('hidden');
      });
    }

    setupLangDropdown('#lang-btn-desktop', '#lang-menu-desktop');
    setupLangDropdown('#lang-btn-mobile', '#lang-menu-mobile');

    // ===== Mobile Menu Toggle =====
    $('#mobileToggle').click(function() {
      $('#mobileMenu').toggleClass('hidden');
    });

    // ===== Search Modal (Shared Desktop & Mobile) =====
    const $searchModal = $('#searchModal');
    const $searchInput = $('#search-box');
    const $searchResults = $('#search-results');
    const API_URL = "<?= $apiBaseURL ?>search_api";

    function openSearchModal() {
      $searchModal.removeClass('hidden');
      $searchInput.focus();
    }

    function closeSearchModal() {
      $searchModal.addClass('hidden');
      $searchResults.empty();
    }

    // Open modal buttons
    $('#openSearchModal, #mobileSearchBtn').click(openSearchModal);

    // Close modal on clicking outside or close button
    $searchModal.click(function(e) {
      if (e.target === this) closeSearchModal();
    });
    window.closeSearchModal = closeSearchModal;

    // ===== AJAX Search =====
    function performSearch(query) {
      if (query.length < 2) {
        $('#search-loading').addClass('hidden');
        return;
      }

      $('#search-loading').removeClass('hidden');

      $.getJSON(API_URL, {
          q: query,
          lang: '<?= $lang ?>'
        })
        .done(function(data) {
          if (data.length > 0) {
            let html = '';
            data.forEach(item => {
              html += `<a href="detail?slug=${item.slug}&lang=<?= $lang ?>" class="flex flex-col items-center bg-gray-800 rounded hover:shadow-lg transition relative">
                                        <div class="absolute inset-0 flex items-center justify-center bg-gray-500 z-10" id="spinner">
                                            <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                            </svg>
                                        </div>
                  <img src="/admin/page/game/${item.image}" alt="${item.title}" class="w-full h-40 object-cover rounded mb-2 opacity-0 transition-opacity duration-500" loading="lazy" onload="this.classList.remove('opacity-0'); this.previousElementSibling.remove();">
                  <span class="text-sm font-medium mb-2">${item.title}</span>
                </a>`;
            });
            $searchResults.html(html);
          } else {
            $searchResults.html('<div class="text-center text-gray-300 col-span-full"> <?= $lang === "en" ? "No results found" : "কোন ফলাফল পাওয়া যায়নি" ?></div>');
          }
        })
        .fail(function() {
          $searchResults.html('<div class="text-center text-red-400 col-span-full">Error loading results</div>');
        })
        .always(function() {
          $('#search-loading').addClass('hidden');
        });
    }

    // Desktop search input
    $searchInput.on('keyup', function() {
      performSearch($(this).val().trim());
    });

    // Mobile search input
    $('#mobileSearchInput').on('keyup', function() {
      performSearch($(this).val().trim());
    });

    // Close mobile search modal
    $('#closeMobileSearch').click(function() {
      $('#mobileSearchModal').addClass('hidden');
      $('#mobileSearchResults').empty();
    });

    $('#mobileSearchModal').click(function(e) {
      if (e.target === this) {
        $('#mobileSearchModal').addClass('hidden');
        $('#mobileSearchResults').empty();
      }
    });

    // ===== Profile Dropdowns =====
    function setupDropdown(btnSelector, dropdownSelector) {
      const $btn = $(btnSelector),
        $dropdown = $(dropdownSelector);

      $btn.click(function(e) {
        e.stopPropagation();
        $dropdown.toggle();
      });

      $(document).click(function(e) {
        if (!$btn.is(e.target) && !$dropdown.is(e.target)) $dropdown.hide();
      });

      $(document).keydown(function(e) {
        if (e.key === 'Escape') $dropdown.hide();
      });
    }

    setupDropdown('#profileMenuBtn', '#profileDropdown');
    setupDropdown('#mobileProfileBtn', '#mobileProfileDropdown');

  });
</script>