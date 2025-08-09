<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/fanciwheel/config/baseURL.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Game List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root {
      --candy-pink: #f472b6;
      --candy-orange: #fb923c;
      --candy-yellow: #facc15;
      --candy-green: #22c55e;
      --candy-purple: #a78bfa;
    }
/* Hide scrollbar for WebKit browsers (Chrome, Safari) */
.game-grid::-webkit-scrollbar {
  display: none;
}
.post-grid::-webkit-scrollbar {
  display: none;
}
/* Hide scrollbar for Firefox */
.game-grid, .post-grid{
  scrollbar-width: none; /* Firefox */
}

/* Hide scrollbar for IE, Edge */
.game-grid, .post-grid {
  -ms-overflow-style: none; /* IE and Edge */
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
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
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
      flex-basis: calc((100% - 40px) / 3); /* 3 items with 20px gap */
      min-width: 390px; /* prevent cards from getting too narrow */
       overflow-x: auto;
    }

    #hot-games-title{
      font-size: 40px;
      margin-bottom: 15px;
    }
    #games-header {
      margin-top: 50px;
    }

    @media (max-width: 1024px) {
      .game-card {
        flex-basis: calc((100% - 20px) / 2); /* 2 items on medium screens */
      }
      #hot-games-title{
        font-size: 30px;
      }
    }

    @media (max-width: 480px) {
      .game-card {
        flex-basis: 100%; /* 1 item full width on small/mobile */
        min-width: 100vw;
        padding: 0px 15px;
      }
      #hot-games-title{
        font-size: 25px;
        margin: 0;
        padding: 0;
      }
      #games-header {
        padding: 0 20px;
      }
      .text-scroll{
        padding: 0 18px;
      }
      .game-card {
        background: none;
        border: none;
      }
    }

    .text-scroll{
      color: darkred;
    }

    /* Arrow buttons styling */
    .arrow-btn {
      position: absolute;
      background-color: rgba(100, 100, 100, 0.7);
      border: none;
      color: white;
      font-size: 2rem;
      width: 40px;
      height: 60px;
      cursor: pointer;
      z-index: 10;
      border-radius: 6px;
      transition: background-color 0.3s ease, transform 0.15s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      user-select: none;
      left: unset; /* reset for animation */
      right: unset;
      top: 50%;
      transform: translateY(-50%);
    }

    .arrow-btn.left-0 {
      left: 20px;
      top: 112px;
    }

    .arrow-btn.right-0 {
      right: 20px;
      top: 112px;
    }

    .arrow-btn:hover {
      background-color: rgba(255, 255, 255, 0.8);
      color: black;
    }
  </style>
</head>
<body class="bg-gray-900" id="games-grid">

  <div>
    <div class="flex flex-col items-center mb-5" id="games-header">
      <!-- Title -->
      <h1 class="text-yellow-400 text-4xl md:text-5xl font-bold mb-4 text-center">
        <span class="animated-text" id="hot-games-title">Hot Games Play Free</span>
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
      <!-- Game cards injected here -->
    </div>

    <!-- Right Arrow Button -->
    <button id="next-btn" aria-label="Scroll Right" class="arrow-btn right-0">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
  </svg>
</button>
  </div>

  <!-- Modal -->
  <div id="comingSoonModal" class="modal hidden fixed inset-0 z-[1000] bg-black/60">
    <div class="modal-content bg-gray-800 text-gray-100 mx-auto mt-[15%] p-8 rounded-lg w-[90%] max-w-md text-center">
      <span class="close-btn text-gray-400 float-right text-3xl font-bold cursor-pointer hover:text-black">&times;</span>
      <h2 class="text-xl mb-4">Game Locked</h2>
      <p>
        <a id="link" href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank" rel="noopener noreferrer" class="text-cyan-400 font-bold underline">
          Join now
        </a> 
        to unlock more games, enjoy exciting gameplay, and win big — safe, fun, and easy!
      </p>
    </div>
  </div>
  <script>
      const baseURL = "<?= $baseURL ?>";
    const games_item = [
      {
        title: "Crazy Time (Evo)",
        description: "Arcade jumping fun — how high can you go?",
        image: "./games/img/time.webp",
        link: "#"
      },
      {
        title: "Super Ace Jili Slot",
        description: "Match fruits and feed the animals in this fun puzzle game.",
        image: "./games/img/Super-Ace-Jili-Slot.jpg",
        link: "#"
      },
      {
        title: "Coin Toss (KM)",
        description: "A fast-paced card game of strategy and sharp thinking.",
        image: "./games/img/coin.webp",
        link: "#"
      },
      {
        title: "Spades",
        description: "Classic Spades — play tricks, partner up, and win big.",
        image: "./games/img/pg.png",
        link: "#"
      }
    ];
  </script>
  <script src="js/script-games-grid.js"></script>
</body>
</html>
