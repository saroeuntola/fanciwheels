<?php

include('./admin/page/library/brand_lib.php');
include('./admin/page/library/users_lib.php');
include('./config/baseURL.php');
$auth = new User();
$brand = new Brand();
$username = $_SESSION['username'] ?? '';
$userId   = $_SESSION['user_id'] ?? null;
$brandList = $brand->getBrand();

if ($userId) {
  $userLib = new User();
  $user    = $userLib->getUserById($userId);

  if (!$user || $user['status'] == 0) {
    session_unset();
    session_destroy();
    setcookie('remember_token', '', time() - 3600, "/");

    header("Location: /");
    exit;
  }

  $profilePath = !empty($user['profile'])
    ? '/admin/page/user/user_image/' . $user['profile']
    : './image/no_profile.png';
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

function navLink($page, $label, $lang, $currentPage, $currentId)
{
  $pageMap = [
    '/' => '/',
    'services' => 'services',
    'about' => 'about',
    'faq' => 'faq',
    'contact' => 'contact'
  ];

  $targetFile = $pageMap[$page] ?? $page;
  $currentFile = basename($currentPage);

  // Handle '/' mapping for index page
  if ($currentFile === 'index.php' && $page === '/') {
    $isActive = true;
  } else {
    $isActive = ($currentFile === $targetFile);
  }

  $href = $targetFile;
  $params = ['lang' => $lang];
  if ($currentFile === 'detail.php' && $currentId) {
    $params['slug'] = $currentId;
  }
  $queryString = http_build_query($params);
  $href .= '?' . $queryString;

  $classes = 'font-medium text-white';
  if ($isActive) $classes .= 'active';

  return "<a href=\"{$href}\" class=\"{$classes}\">{$label}</a>";
}



$menu = [
  'home' => $lang === 'en' ? 'Home' : 'হোমপেজ',
  'services' => $lang === 'en' ? 'Services' : 'সেবা',
  'about' => $lang === 'en' ? 'About' : 'সম্পর্কে',
  'faq' => $lang === 'en' ? 'FAQs' : 'FAQs',
  'sign_in' => $lang === 'en' ? 'Sign In' : 'লগ ইন',
  'sign_up' => $lang === 'en' ? 'Sign Up' : 'সাইন আপ',
  'search' => $lang === 'en' ? 'Search...' : 'অনুসন্ধান করুন...',
  'contact' => $lang === 'en' ? 'Contact' : 'যোগাযোগ'
];

$languageNames = [
  'en' => 'English',
  'bn' => 'বাংলা'
];
$fullLangName = $languageNames[$lang] ?? 'Unknown Language';
?>
<style>
  #mobileProfileDropdown {
    top: 50px;
  }

  /* Add this inside your <style> tag in the navbar */





  @media (max-width: 768px) {
    .nav-link {

      padding: 7px;
      text-decoration: none;
      transition: background-color 0.3s ease, color 0.3s ease;
      border-radius: 5px;
    }

    .nav-link:hover {
      background-color: #2563eb;
      /* blue-600 */
      color: #fff;
    }

    .nav-link.active {
      background-color: #1e40af;
      /* blue-800 */
      color: #fff;
    }
  }

  /* Add this to your <style> */
  /* Add to your <style> */
  #mobileMenu {

    width: 250px;
  }

  #mobileMenu.open {
    left: 0;
    /* slide in */
  }

  /* Mobile Overlay */
  #mobileOverlay {
    display: none;

    position: fixed;
    top: 64px;
    /* leave navbar visible */
    left: 0;
    width: 100%;
    height: calc(100vh - 64px);
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 2;
    opacity: 0;
    transition: opacity 5s ease;
  }

  #mobileOverlay.show {
    display: block;
    opacity: 1;
    z-index: 2;
  }

  #logo {
    width: 115px;
    height: 23px;
    object-fit: fill;
  }

  #logo:hover {
    opacity: 0.7;
  }

  @media(min-width: 1024px) {
    #mobileOverlay {
      display: none !important;
    }

    #logo {
      width: 135px;
      height: 28px;
      object-fit: fill;
    }
  }

  /* Mobile Menu */
  #mobileMenu {
    position: fixed;
    top: 64px;
    left: -100%;

    height: calc(100vh - 64px);
    background-color: #1f2937;
    z-index: 10;
    transition: left 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 3s ease;
    opacity: 0;
  }

  #mobileMenu.open {
    left: 0;
    opacity: 1;
  }



  .nav-link:hover::after {
    transform: scaleX(1);
  }
</style>
<!-- Navbar -->
<nav class="bg-gray-800 relative shadow-2xl border-b border-white/10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="flex justify-between items-center h-16">
      <!-- Mobile Hamburger + Site Title -->
      <div class="lg:hidden flex items-center w-full justify-between">
        <div class="flex items-center gap-3">
          <button id="mobileToggle" class="text-white focus:outline-none">
            <!-- Hamburger Icon -->
            <svg id="mobileHamburger" class="w-6 h-7" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <!-- Close Icon (hidden by default) -->
            <svg id="mobileClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Site Title -->
          <h1>
            <a href="/?lang=<?= $lang ?>" class="mr-8">
              <img id="logo" src="./image/logo.png" alt="logo">
              <!-- <span class="text-lg">FancyWheel</span> -->
            </a>
          </h1>

        </div>

        <!-- Search & Profile -->
        <div class="flex items-center">
          <button id="mobileSearchBtn" class="p-0 text-white focus:outline-none"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </button>

          <!-- mobile lang -->
          <div class="relative">
            <!-- Language Button -->
            <button id="lang-btn-mobile" class="flex items-center text-white px-4 py-2 rounded-md  focus:outline-none">
              <img id="lang-flag-mobile" src="./image/flag/<?= $lang === 'en' ? 'en' : 'bn' ?>.svg" class="w-8 h-6" alt="Flag">
              <span class="ml-2 font-medium"><?= $lang === 'en' ? 'EN' : 'BN' ?></span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Language Dropdown -->
            <div id="lang-menu-mobile" class="hidden absolute mt-2 px-6 py-2 w-36 bg-gray-800 rounded-md shadow-lg z-50">
              <?php foreach ($languageNames as $code => $name): ?>
                <?php if ($code !== $lang): ?>
                  <a href="<?= buildLangUrl($code, $currentPage, $currentId) ?>" class="flex items-center justify-center gap-2 text-white hover:bg-gray-100 transition">
                    <img src="./image/flag/<?= $code ?>.svg" class="w-6 h-4" alt="<?= $name ?> Flag">
                    <p class=""><?= $name ?></p>
                  </a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>

          <?php if ($userId): ?>
            <button id="mobileProfileBtn" class="relative rounded-full0">
              <img src="<?= $profilePath ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover">
            </button>
            <div id="mobileProfileDropdown"
              class="absolute right-0 mt-2 w-56 bg-slate-800/95 backdrop-blur-lg border border-slate-700/50 text-white rounded-xl shadow-2xl hidden z-[9999] overflow-hidden">
              <div class="px-4 py-3 border-b border-slate-700/50">
                <p class="text-sm font-semibold"><?= htmlspecialchars($user['username']) ?></p>
              </div>
              <a href="/admin/page/user/profile" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50">Profile</a>
              <button onclick="window.location.href='logout'" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10">Logout</button>
            </div>
          <?php else: ?>

          <?php endif; ?>
        </div>

      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center w-full">
        <!-- Site Title -->
        <h1>
          <a href="/?lang=<?= $lang ?>" class=" mr-8">
            <img id="logo" src="./image/logo.png" alt="logo">
            <!-- <span class="text-2xl">FancyWheel</span> -->
          </a>
        </h1>

        <!-- Navigation-->
        <div class="flex items-center gap-4 ml-auto">
          <nav class="flex space-x-8 mr-2">
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

          <?php if ($userId && !empty($user)): ?>
            <div class="relative">
              <button id="profileMenuBtn" class="group flex items-center gap-2 rounded-full">
                <img src="<?= htmlspecialchars($profilePath) ?>" alt="Profile"
                  class="w-8 h-8 object-cover rounded-full border-2 border-white/30">

                <svg class="w-4 h-4 text-white group-hover:rotate-180 transition-transform duration-200"
                  fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <!-- Dropdown -->
              <div id="profileDropdown"
                class="absolute right-0 mt-2 w-56 bg-slate-800/95 backdrop-blur-lg border border-slate-700/50 text-white rounded-xl shadow-2xl hidden z-[9999] overflow-hidden">
                <p class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50">
                  <?= htmlspecialchars($user['username'] ?? 'User') ?>
                </p>
                <a href="/admin/page/user/profile" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50">Profile</a>
                <button onclick="window.location.href='logout'" class="flex items-center gap-3 px-3 py-3 text-red-400 hover:bg-red-500/10">Logout</button>
              </div>
            </div>
          <?php else: ?>
            <button
              class="rounded-md openRegisterModal px-6 py-2 shadow-lg bg-gray-700  hover:bg-slate-700/50 hover:transition hover:duration-700">
              <?= $menu['sign_up'] ?>
            </button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-4px text-white" fill="none" viewBox="0 0 1 24" stroke="currentColor">
              <line x1="0.5" y1="0" x2="0.5" y2="24" stroke="currentColor" stroke-width="1" />
            </svg>
            <button
              class="rounded-md openLoginModal px-6 py-2 shadow-lg bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700">
              <?= $menu['sign_in'] ?>
            </button>


          <?php endif; ?>

        </div>

      </div>

    </div>
  </div>
  <!-- Mobile Menu -->
  <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>
  <div id="mobileMenu" class="lg:hidden fixed top-5 left-[-100%] h-full bg-gray-800 text-white z-10 transition-left duration-300 ease-in-out">
    <div class="flex flex-col p-4 space-y-3">
      <div class="flex gap-2 items-center">
        <?php if ($userId): ?>
        <?php else: ?>
          <div class="w-full flex justify-between mb-4">
            <button
              class="openRegisterModal text-sm text-white px-4 py-3 shadow-lg rounded-md bg-gray-700  hover:bg-slate-700/50 hover:transition hover:duration-700 flex items-center">
              <?= $menu['sign_up'] ?>
            </button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-2px text-white" fill="none" viewBox="0 0 1 24" stroke="currentColor">
              <line x1="0.5" y1="0" x2="0.5" y2="24" stroke="currentColor" stroke-width="1" />
            </svg>
            <button
              class="openLoginModal text-sm text-white px-4 py-3 shadow-lg rounded-md bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700 flex items-center">
              <?= $menu['sign_in'] ?>
            </button>
          </div>
        <?php endif; ?>
      </div>
      <div class="nav-link <?= $currentPage === '/' ? 'active' : '' ?>">
        <i class="fa-solid fa-house mr-3"></i>
        <?= navLink('/', $menu['home'], $lang, $currentPage, $currentId) ?>
      </div>
      <div class="nav-link <?= $currentPage === 'services' ? 'active' : '' ?>">
        <i class="fa-solid fa-list-check mr-3"></i>
        <?= navLink('services', $menu['services'], $lang, $currentPage, $currentId) ?>
      </div>
      <div class="nav-link <?= $currentPage === 'about' ? 'active' : '' ?>">
        <i class="fa-solid fa-address-card mr-3"></i>
        <?= navLink('about', $menu['about'], $lang, $currentPage, $currentId) ?>
      </div>
      <div class="nav-link <?= $currentPage === 'fqa' ? 'active' : '' ?>">
        <i class="fa-solid fa-circle-question mr-3"></i>
        <?= navLink('faq', $menu['faq'], $lang, $currentPage, $currentId) ?>
      </div>
      <div class="nav-link <?= $currentPage === 'contact' ? 'active' : '' ?>">
        <i class="fa-solid fa-phone mr-3"></i>
        <?= navLink('contact', $menu['contact'], $lang, $currentPage, $currentId) ?>

      </div>

    </div>

  </div>
  </div>
</nav>

<!-- Search Modal (shared for Desktop & Mobile) -->
<div id="searchModal" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
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

<?php
include 'auth-form.php';
?>

<script>
  $(document).on("click", "#switchToRegister", function() {
    $("#loginAuth").fadeOut(300, function() {
      $("#registerAuth").fadeIn(300).removeClass("hidden");
    });
  });

  $(document).on("click", "#switchToLogin", function() {
    $("#registerAuth").fadeOut(300, function() {
      $("#loginAuth").fadeIn(300).removeClass("hidden");
    });
  });

  $(document).ready(function() {

    // ===== Desktop Profile Dropdown =====
    $('#profileMenuBtn').click(function(e) {
      e.stopPropagation();
      $('#profileDropdown').toggleClass('hidden');
    });

    // ===== Mobile Profile Dropdown =====
    $('#mobileProfileBtn').click(function(e) {
      e.stopPropagation();
      $('#mobileProfileDropdown').toggleClass('hidden');
    });

    // Close dropdowns when clicking outside
    $(document).click(function() {
      $('#profileDropdown').addClass('hidden');
      $('#mobileProfileDropdown').addClass('hidden');
    });

    // Close dropdowns on ESC key
    $(document).keydown(function(e) {
      if (e.key === 'Escape') {
        $('#profileDropdown').addClass('hidden');
        $('#mobileProfileDropdown').addClass('hidden');
      }
    });
  });


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
    // Mobile Toggle with overlay
    $('#mobileToggle').click(function(e) {
      e.stopPropagation();
      $('#mobileHamburger').toggleClass('hidden');
      $('#mobileClose').toggleClass('hidden');

      $('#mobileMenu').toggleClass('open');
      $('#mobileOverlay').toggleClass('show'); // fade overlay
    });

    // Close menu when clicking outside or overlay
    $(document).click(function(e) {
      if (!$(e.target).closest('#mobileMenu, #mobileToggle').length) {
        $('#mobileMenu').removeClass('open');
        $('#mobileOverlay').removeClass('show');
        $('#mobileHamburger').removeClass('hidden');
        $('#mobileClose').addClass('hidden');
      }
    });

    $('#mobileOverlay').click(function() {
      $('#mobileMenu').removeClass('open');
      $('#mobileOverlay').removeClass('show');
      $('#mobileHamburger').removeClass('hidden');
      $('#mobileClose').addClass('hidden');
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

    $('#openSearchModal, #mobileSearchBtn').click(openSearchModal);
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