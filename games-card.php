<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
$isLoggedIn = isset($_SESSION['user_id']);
$allGames = include './language/games-translate.php';
$games_item = $allGames[$lang] ?? $allGames['en'];
?>

<style>
  :root {
    --candy-pink: #f472b6;
    --candy-orange: #fb923c;
    --candy-yellow: #facc15;
    --candy-green: #22c55e;
    --candy-purple: #a78bfa;
  }

  .modal-content {
    margin-top: 17rem;
  }

  /* Hide scrollbar for WebKit browsers (Chrome, Safari) */
  .game-grid::-webkit-scrollbar {
    display: none;
  }

  .post-grid::-webkit-scrollbar {
    display: none;
  }

  /* Hide scrollbar for Firefox */
  .game-grid,
  .post-grid {
    scrollbar-width: none;
    /* Firefox */
  }

  /* Hide scrollbar for IE, Edge */
  .game-grid,
  .post-grid {
    -ms-overflow-style: none;
    /* IE and Edge */
  }

  .animated-text {
    background: linear-gradient(90deg, #facc15, #fb923c, #a78bfa, #22c55e, #f472b6);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: glowText 5s ease-in-out infinite;
    display: inline-block;
    font-weight: bold;
    letter-spacing: 2px;
    margin-top: 30px;
  }

  @keyframes glowText {
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

  .game-grid::-webkit-scrollbar {
    height: 8px;
  }

  .game-grid::-webkit-scrollbar-thumb {
    background: var(--candy-purple);
    border-radius: 4px;
  }

  /* Responsive card widths using flex-basis */
  .game-card {
    flex-shrink: 0;
    flex-grow: 0;
    flex-basis: calc((100% - 40px) / 3);
    /* 3 items with 20px gap */
    min-width: 390px;
    /* prevent cards from getting too narrow */
    overflow-x: auto;
  }

  #hot-games-title {
    font-size: 30px;
  }

  #games-header {
    margin-top: 50px;
  }

  @media (max-width: 1024px) {
    .game-card {
      flex-basis: calc((100% - 20px) / 2);
      /* 2 items on medium screens */
    }

    #hot-games-title {
      font-size: 30px;
    }
  }

  @media (max-width: 480px) {
    .game-card {
      flex-basis: 100%;
      /* 1 item full width on small/mobile */
      min-width: 100vw;
      padding: 0px 15px;
    }

    #hot-games-title {
      font-size: 18px;
      margin: 0;
      padding: 0;
    }

    #games-header {
      padding: 0 20px;
    }

    .text-scroll {
      padding: 0 18px;
    }

    .game-card {
      background: none;
      border: none;
    }

  }

  .text-scroll {
    color: darkred;
  }



  /* Arrow buttons styling */
  .arrow-btn {
    position: absolute;

    border: none;
    color: white;
    font-size: 2rem;
    width: 40px;
    height: 60px;
    cursor: pointer;
    opacity: 80%;
    z-index: 10;
    border-radius: 6px;
    transition: background-color 0.3s ease, transform 0.15s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    left: unset;
    /* reset for animation */
    right: unset;
    top: 50%;
    transform: translateY(-50%);
  }

  .arrow-btn.left-0 {
    left: 8px;
    top: 112px;
  }

  .arrow-btn.right-0 {
    right: 8px;
    top: 112px;
  }
</style>

<div>
  <div class="flex flex-col mb-4" id="games-header">
    <!-- Title -->
    <h1 class="font-bold text-center">
      <span class="animated-text" id="hot-games-title"><?= $lang === 'bn' ? 'হট গেম বিনামূল্যে খেলুন' : ' Hot Games Play Free' ?></span>
    </h1>
  </div>
</div>

<div class="relative">
  <!-- Left Arrow Button -->
  <button id="prev-btn" aria-label="Scroll Left" class="arrow-btn left-0">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
  </button>

  <div id="gameGrid" class="game-grid flex overflow-x-auto snap-x snap-mandatory gap-5 p-0 m-0">
    <?php foreach ($games_item as $game): ?>
      <div class="game-card mb-2 bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-200 flex flex-col snap-start">
        <img src="<?= $game['image'] ?>" alt="<?= htmlspecialchars($game['title']) ?>" class="w-full h-[206px] object-fill" loading="lazy">
        <div class="game-content p-4 flex flex-col flex-grow">


          <h3 class="text-lg font-bold mb-2"><?= htmlspecialchars($game['title']) ?></h3>
          <p class="game-desc text-sm text-gray-300 flex-grow mb-2"><?= htmlspecialchars($game['description']) ?></p>
          <button
            class="openRegisterModal play-btn p-2 text-center text-white rounded-md font-bold w-full bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700"
            data-link="<?= $isLoggedIn ? 'https://fancywin.city/bd/bn' : '' ?>">
            <?= $lang === 'en' ? 'Play Now' : 'খেলা লক' ?>
          </button>
        </div>


      </div>
    <?php endforeach; ?>
  </div>

  <!-- Right Arrow Button -->
  <button id="next-btn" aria-label="Scroll Right" class="arrow-btn right-0">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </button>
</div>

<!-- Modal -->
<div id="comingSoonModal"
  class="modal fixed inset-0 z-[1000] bg-black/60 hidden opacity-0 transition-opacity duration-500 p-4">

  <div class="modal-content bg-gray-800 text-gray-100 p-6 m-auto rounded-lg max-w-md w-full relative transform scale-95 transition-transform duration-500">
    <!-- Close Button -->
    <span class="close-btn absolute top-0 right-3 text-gray-400 text-3xl font-bold cursor-pointer hover:text-white">&times;</span>

    <!-- Modal Title -->
    <h2 class="text-xl mb-4 text-center">
      <?= $lang === 'en' ? 'Game Locked' : 'খেলা লক' ?>
    </h2>

    <!-- Modal Body -->
    <p>
      <button id="link" onclick="window.open('https://fancywin.city/bd/bn/new-register-entry/account', '_blank')"
        rel="noopener noreferrer"
        class="text-cyan-400 font-bold underline">
        <?= $lang === 'en' ? 'Join now' : 'এখন নিবন্ধন করুন' ?>
      </button>
      <?= $lang === 'en'
        ? 'to play games, enjoy exciting gameplay, and win big, safe, fun, and easy!'
        : 'গেম খেলতে, উত্তেজনাপূর্ণ গেমপ্লে উপভোগ করতে এবং বড়, নিরাপদ, মজাদার এবং সহজে জিততে এখনই যোগ দিন!' ?>
    </p>
  </div>
</div>


<script>
  const modal = document.getElementById("comingSoonModal");
  const closeBtn = document.querySelector(".close-btn");
  const container = document.getElementById("gameGrid");
  $(function() {
    $(".openRegisterModal").click(function(e) {
      e.preventDefault();
      const link = $(this).attr("data-link");
      if (link && link.trim() !== "") {
        if (typeof closeAuthModal === "function") {
          closeAuthModal();
        }

        window.open(link, "_blank");
        return;
      }
      if (typeof openAuthModal === "function") {
        openAuthModal(false);
      }
    });
  });
  
  $(function() {

    const $grid = $("#gameGrid");
    const scrollAmount = 390;

    const originalContent = $grid.html();
    $grid.prepend(originalContent);
    $grid.append(originalContent);


    const originalScrollLeft = $grid[0].scrollWidth / 3;
    $grid.scrollLeft(originalScrollLeft);

    $grid.on("scroll", function() {
      const maxScrollLeft = $grid[0].scrollWidth;
      const viewportWidth = $grid.outerWidth();
      let scrollLeft = $grid.scrollLeft();

      if (scrollLeft <= 0) {
        $grid.scrollLeft(scrollLeft + (maxScrollLeft / 3));
      } else if (scrollLeft >= maxScrollLeft * 2 / 3) {

        $grid.scrollLeft(scrollLeft - (maxScrollLeft / 3));
      }
    });

    $("#prev-btn").on("click", function() {
      $grid.animate({
          scrollLeft: $grid.scrollLeft() - scrollAmount
        },
        300
      );
    });

    $("#next-btn").on("click", function() {
      $grid.animate({
          scrollLeft: $grid.scrollLeft() + scrollAmount
        },
        300
      );
    });

  });
</script>