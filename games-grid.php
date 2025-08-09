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
  <script src="https://cdn.tailwindcss.com"></script> <!-- in pc show 3 item -->

  <style>
    :root {
      --candy-pink: #f472b6;
      --candy-orange: #fb923c;
      --candy-yellow: #facc15;
      --candy-green: #22c55e;
      --candy-purple: #a78bfa;
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
    }
    .text-scroll{
      color: darkred;
    }
  </style>
</head>
<body class="bg-gray-900" id="games-grid">
<div class="">
<div class="flex flex-col items-center mb-5" id="games-header">
  <!-- Title -->
  <h1 class="text-yellow-400 text-4xl md:text-5xl font-bold mb-4 text-center">
    <span class="animated-text" id="hot-games-title">Hot Games Play Free</span>
  </h1>
  <P class="text-scroll">
    See Mores Scroll Left/Right 
  </P>
</div>

</div>
    <div class="relative">
      <div id="gameGrid" class="game-grid flex overflow-x-auto snap-x snap-mandatory gap-5 p-0 m-0">
        <!-- Game cards injected here -->
      </div>
    </div>
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

    const modal = document.getElementById("comingSoonModal");
    const closeBtn = document.querySelector(".close-btn");
    const container = document.getElementById("gameGrid");

    container.innerHTML = ""; // Clear existing cards

    games_item.forEach(game => {
      const card = document.createElement("div");
      card.className = "game-card mb-2 bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-200 flex flex-col snap-start";

      card.innerHTML = `
        <img src="${baseURL}${game.image}" alt="${game.title}" class="w-full h-[206px] object-cover" />
        <div class="game-content p-4 flex flex-col flex-grow">
          <h2 class="game-title text-lg mb-2 text-pink-400">${game.title}</h2>
          <p class="game-desc text-sm text-gray-300 flex-grow">${game.description}</p>
          <a href="${game.link}" target="_blank" class="play-btn mt-4 p-2 text-center bg-purple-400 text-white rounded-lg font-bold hover:bg-pink-400 transition-colors duration-300">Play Now</a>
        </div>
      `;
      container.appendChild(card);
    });

    // Modal functionality
    const playButtons = document.querySelectorAll(".play-btn");

    playButtons.forEach(btn => {
      btn.addEventListener("click", function(e) {
        const href = this.getAttribute("href");
        if (href === "#") {
          e.preventDefault();
          modal.style.display = "block";
        }
      });
    });

    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });

   // Drag to scroll horizontally
   $(function () {
  const $grid = $("#gameGrid");
  const $scrollLeftBtn = $("#prev-btn");
  const $scrollRightBtn = $("#next-btn");

  let isDown = false;
  let startX;
  let scrollLeft;

  // Mouse down
  $grid.on("mousedown", function (e) {
    isDown = true;
    $grid.addClass("active");
    startX = e.pageX - $grid.offset().left;
    scrollLeft = $grid.scrollLeft();
    e.preventDefault();
  });

  // Mouse leave or up
  $(document).on("mouseup mouseleave", function () {
    if (isDown) {
      isDown = false;
      $grid.removeClass("active");
    }
  });

  // Mouse move
  $grid.on("mousemove", function (e) {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - $grid.offset().left;
    const walk = (x - startX) * 2; // scroll speed multiplier
    $grid.scrollLeft(scrollLeft - walk);
  });

  // Button scroll with smooth animation
  const scrollAmount = 300;

  $scrollLeftBtn.on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() - scrollAmount },
      400,
      "swing"
    );
  });

  $scrollRightBtn.on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() + scrollAmount },
      400,
      "swing"
    );
  });
});

  </script>
</body>
</html>
