<?php
include './admin/page/library/users_lib.php';
include './admin/page/library/brand_lib.php';
include $_SERVER['DOCUMENT_ROOT'] . '/fanciwheel/config/baseURL.php';
include 'helpers.php'; 
$auth = new User();
$brand = new Brand();
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['user_id'] ?? null;

$brandList = $brand->getBrand();
$user = null;

// Get user
if ($userId) {
  $userLib = new User();
  $user = $userLib->getUserByID($userId);
}

$profileImage = isset($user['profile']) && !empty($user['profile']) ? $user['profile'] : 'default.png';
$profilePath = $baseURL . '/admin/page/user/user_image/' . htmlspecialchars($profileImage);

$fullPath = $_SERVER['DOCUMENT_ROOT'] . '/admin/page/user/user_image/' . $profileImage;
if (!file_exists($fullPath)) {
  $profilePath = $baseURL . '/admin/page/user/user_image/default.png';
}

$currentPage = basename($_SERVER['PHP_SELF']);
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en','bn']) ? $_GET['lang'] : 'bn';
$currentId = isset($_GET['id']) ? intval($_GET['id']) : null;

function buildLangUrl($langTarget, $currentPage, $currentId) {
    $params = ['lang' => $langTarget];
    if ($currentPage === 'detail.php' && $currentId) {
        $params['id'] = $currentId;
    }
    return $currentPage . '?' . http_build_query($params);
}

$menu = [
    'home' => $lang === 'en' ? 'Home' : 'হোমপেজ',
    'services' => $lang === 'en' ? 'Services' : 'সেবা',
    'about' => $lang === 'en' ? 'About' : 'সম্পর্কে',
    'faq' => $lang === 'en' ? 'FAQs' : 'FAQs',
    'join' => $lang === 'en' ? 'Join Now' : 'যোগদান করুন',
    'search' => $lang === 'en' ? 'Search...' : 'অনুসন্ধান করুন...'
];
?>
<style>
  /* #header-bar {
    background-color: #8F1FFF;
  } */
</style>

<link rel="stylesheet" href="./admin/page/assets/css/navbar.css">
  <link href="./dist/output.css" rel="stylesheet">
<!-- Modern Navbar with Glassmorphism Effect -->
<nav id="header-bar" class="py-2 relative bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 backdrop-blur-md shadow-2xl border-b border-white/10">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,rgba(255,255,255,0.1)_1px,transparent_0)] bg-[size:20px_20px] opacity-20"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="flex justify-between items-center h-16">

      <div class="flex-shrink-0">
        <a href="<?= $lang==='en' ? '/?lang=en' : '/?lang=bn' ?>" class="group relative">
          <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent transition-all duration-300 group-hover:scale-105">
            FancyWheel
          </span>
          <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-lg opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
        </a>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-8">

   <nav class="flex space-x-6">
     <?php
    echo navLink('/', $menu['home'], $lang, $currentPage, $currentId);
    echo navLink('services', $menu['services'], $lang, $currentPage, $currentId);
    echo navLink('about', $menu['about'], $lang, $currentPage, $currentId);
    echo navLink('faq', $menu['faq'], $lang, $currentPage, $currentId);
  ?>
</nav>

        <!-- Modern Search Bar -->
        <form action="search.php" method="GET" class="relative group">
          <div class="search-bar">
              <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
           <input type="text" name="q" placeholder="<?= $menu['search'] ?>" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <button type="submit" class="search-icon">🔍</button>
          </div>
        </form>

        <div class="relative ml-auto">
  <!-- Button showing current language -->
  <button id="langBtn" class="flex items-center relative group px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
    <img id="currentFlag" src="<?= $lang==='en' ? './image/flag/en.svg' : './image/flag/bn.svg' ?>" class="w-5 h-5 mr-2" alt="Flag">
    <span id="currentLang"><?= strtoupper($lang) ?></span>
    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div id="langMenu" class="hidden absolute right-0 mt-2 bg-gray-800 text-white rounded-lg shadow-lg w-32 z-50">
    <a href="<?= buildLangUrl('en', $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 hover:bg-gray-700">
      <img src="./image/flag/en.svg" class="w-5 h-5 mr-2" alt="EN"> EN
    </a>
    <a href="<?= buildLangUrl('bn', $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 hover:bg-gray-700">
      <img src="./image/flag/bn.svg" class="w-5 h-5 mr-2" alt="BN"> BN
    </a>
  </div>
</div>
<script>
const langBtn = document.getElementById('langBtn');
const langMenu = document.getElementById('langMenu');

langBtn.addEventListener('click', () => {
  langMenu.classList.toggle('hidden');
});
</script>

        <!-- Desktop Profile -->
        <?php if ($userId): ?>
          <div class="relative">
            <button id="profileMenuBtn" class="group flex items-center gap-2 px-3 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
              <img src="<?= $profilePath ?>"
                alt=""
                title="<?= htmlspecialchars($username) ?>"
                class="w-8 h-8 object-cover rounded-full border-2 border-white/30 group-hover:border-white/60 transition-all duration-300">
              <span class="text-white/90 text-sm font-medium group-hover:text-white transition-colors duration-300"><?= htmlspecialchars(substr($username, 0, 8)) ?></span>
              <svg class="w-4 h-4 text-white/60 group-hover:text-white transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-slate-800/95 backdrop-blur-lg border border-slate-700/50 text-white rounded-xl shadow-2xl hidden z-[9999] overflow-hidden">
              <div class="py-1">
                <a href="<?= $baseURL ?>/admin/page/user/profile.php" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50 transition-all duration-200">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <span>Profile</span>
                </a>
                <div class="border-t border-slate-700/50 my-1"></div>
                <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>
        <?php else: ?>
          <a href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank" class="relative group px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
            <span class="relative z-10 font-medium"><?= $lang === 'en' ? 'Join Now' : 'যোগদান করুন'  ?></span>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
          </a>
        <?php endif; ?>
      </div>

      <!-- Mobile Toggle + Profile -->
      <div class="lg:hidden flex items-center gap-3 relative">
        <?php if ($userId): ?>
          <button id="mobileProfileBtn" class="relative p-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-all duration-300 focus:outline-none">
            <img src="<?= $profilePath ?>"
              alt="Profile"
              title="<?= htmlspecialchars($username) ?>"
              class="w-8 h-8 object-cover rounded-full border-2 border-white/30">
          </button>
          <!-- Mobile Profile Dropdown -->
          <div id="mobileProfileDropdown" class="absolute right-12 top-12 w-48 bg-slate-800/95 backdrop-blur-lg border border-slate-700/50 text-white rounded-xl shadow-2xl hidden z-[9999] overflow-hidden">
            <div class="py-1">
              <a href="<?= $baseURL ?>/admin/page/user/profile.php" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-700/50 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
              </a>
              <div class="border-t border-slate-700/50 my-1"></div>
              <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
              </a>
            </div>
          </div>
        <?php else: ?>

              <div class="relative ml-auto">
  <!-- Button showing current language -->
  <button id="langBtn1" class="flex items-center relative group px-4 py-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
    <img id="currentFlag" src="<?= $lang==='en' ? './image/flag/en.svg' : './image/flag/bn.svg' ?>" class="w-5 h-5 mr-2" alt="Flag">
    <span id="currentLang"><?= strtoupper($lang) ?></span>
    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
    </svg>
 
  </button>

  <!-- Dropdown menu -->
  <div id="langMenu1" class="hidden absolute right-0 mt-2 bg-gray-800 text-white rounded-lg shadow-lg w-32 z-50">
    <a href="<?= buildLangUrl('en', $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 hover:bg-gray-700">
      <img src="./image/flag/en.svg" class="w-5 h-5 mr-2" alt="EN"> EN
    </a>
    <a href="<?= buildLangUrl('bn', $currentPage, $currentId) ?>" class="flex items-center px-3 py-2 hover:bg-gray-700">
      <img src="./image/flag/bn.svg" class="w-5 h-5 mr-2" alt="BN"> বাংলা
    </a>
  </div>
</div>

<script>
const langBtn1 = document.getElementById('langBtn1');
const langMenu1 = document.getElementById('langMenu1');

langBtn1.addEventListener('click', () => {
  langMenu1.classList.toggle('hidden');
});
</script>
          <a href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank" class="text-white/90 hover:text-white rounded-full hover:bg-white/10 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </a>

      

        <?php endif; ?>
        <!-- Modern Hamburger Toggle -->
        <button onclick="toggleMenu()" class="relative p-2 text-white focus:outline-none group" aria-label="Toggle Menu">
          <div class="absolute inset-0 bg-white/10 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
          <svg id="hamburgerIcon" class="w-6 h-6 relative z-10 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Modern Mobile Menu -->
  <div id="mobileMenu" class="lg:hidden hidden bg-slate-900/95 backdrop-blur-lg border-t border-white/10">
    <div class="px-4 py-6 space-y-3">
     <div class="flex flex-col gap-4 ms-4 mb-4">
        <?php
    echo navLink('/', $menu['home'], $lang, $currentPage, $currentId);
    echo navLink('services', $menu['services'], $lang, $currentPage, $currentId);
    echo navLink('about', $menu['about'], $lang, $currentPage, $currentId);
    echo navLink('faq', $menu['faq'], $lang, $currentPage, $currentId);
  ?>
    
     </div>
   
      <form action="search.php" method="GET" class="relative group">
        <div class="search-bar">
              <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
            <input type="text" name="q" placeholder="<?= $lang === 'en' ? 'Search...' : 'অনুসন্ধান করুন...' ?>" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <button type="submit" class="search-icon">🔍</button>
          </div>
      </form>
    </div>
  </div>
</nav>
<!-- JavaScript for Navbar Interactions -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function() {
    // Toggle mobile menu with rotation animation on hamburger icon
    $('#hamburgerIcon').on('click', function() {
      $('#mobileMenu').stop(true, true).fadeToggle(250);
      $(this).toggleClass('rotate-90');
    });

    // Function to close dropdown if clicking outside or on escape key
    function setupDropdown(toggleBtnSelector, dropdownSelector) {
      const $btn = $(toggleBtnSelector);
      const $dropdown = $(dropdownSelector);

      if ($btn.length && $dropdown.length) {
        $btn.on('click', function(e) {
          e.stopPropagation();
          $dropdown.stop(true, true).fadeToggle(200);
        });

        // Click outside closes dropdown
        $(document).on('click', function(e) {
          if (!$btn.is(e.target) && $btn.has(e.target).length === 0 &&
            !$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
            $dropdown.stop(true, true).fadeOut(200);
          }
        });

        // Escape key closes dropdown
        $(document).on('keydown', function(e) {
          if (e.key === 'Escape' && $dropdown.is(':visible')) {
            $dropdown.stop(true, true).fadeOut(200);
          }
        });
      }
    }

    // Setup dropdowns
    setupDropdown('#profileMenuBtn', '#profileDropdown');
    setupDropdown('#mobileProfileBtn', '#mobileProfileDropdown');

    // Search input focus/blur ring effect
    const $searchInput = $('input[name="q"]');
    $searchInput.on('focus', function() {
      $(this).parent().addClass('ring-2 ring-purple-500');
    });
    $searchInput.on('blur', function() {
      $(this).parent().removeClass('ring-2 ring-purple-500');
    });

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
      e.preventDefault();
      const target = $($(this).attr('href'));
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500);
      }
    });
  });
</script>


<style>
  /* Custom gradient animations */
  @keyframes gradient-shift {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  .animate-gradient {
    background-size: 200% 200%;
    animation: gradient-shift 4s ease infinite;
  }

  /* Enhanced focus styles */
  .focus-visible:focus {
    outline: 2px solid #8b5cf6;
    outline-offset: 2px;
  }

  /* Smooth transitions for all interactive elements */
  * {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
  }

  /* Enhanced hover effects */
  .hover-lift:hover {
    transform: translateY(-2px);
  }

  /* Backdrop blur fallback */
  @supports not (backdrop-filter: blur(12px)) {
    .backdrop-blur-md {
      background-color: rgba(30, 41, 59, 0.8);
    }

    .backdrop-blur-lg {
      background-color: rgba(30, 41, 59, 0.9);
    }
  }
</style>