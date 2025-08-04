<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/fanciwheel/config/baseURL.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --candy-pink: #f472b6;
      --candy-orange: #fb923c;
      --candy-yellow: #facc15;
      --candy-green: #22c55e;
      --candy-purple: #a78bfa;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: var(--candy-yellow);
      font-size: 2.5rem;
    }

    .game-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .game-card {
      background: #1f2937;
      border: 1px solid #374151;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      transition: transform 0.2s, box-shadow 0.2s;
      display: flex;
      flex-direction: column;
    }

    .game-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.5);
    }

    .game-card img {
      width: 100%;
      height: 206px;
      object-fit: cover;
    }

    .game-content {
      padding: 16px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .game-title {
      font-size: 18px;
      margin: 0 0 10px;
      color: var(--candy-pink);
    }

    .game-desc {
      font-size: 14px;
      color: #cbd5e1;
      flex-grow: 1;
    }

    .play-btn {
      margin-top: 15px;
      padding: 10px;
      text-align: center;
      background: var(--candy-purple);
      color: white;
      border-radius: 10px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }

    .play-btn:hover {
      background: var(--candy-pink);
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 1rem;
      }
      .game-grid {
      padding: 0px 10px;
     
    }
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
      background-color: #333329;
      color: whitesmoke;
      margin: 15% auto;
      padding: 30px;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
      text-align: center;
    }

    .close-btn {
      color: #999;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close-btn:hover {
      color: #000;
    }
    #link{
      color: #00B7FF;
      font-weight: bold;
      text-decoration-line: underline;
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
}

@keyframes glowText {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

  </style>
</head>
<body id="games-grid">
  <h1><span class="animated-text">🎮 Hot Games Play Free 🎮</span></h1>
  <div class="game-grid">
    <!-- Game 1 -->
    <div class="game-card">
      <img src="./games/img/spinwheel.png" alt="Lucky Wheel">
      <div class="game-content">
        <h2 class="game-title">Lucky Wheel</h2>
        <p class="game-desc">Spin the lucky wheel and win daily prizes. Try your luck!</p>
        <a href="<?= $baseURL ?>/games/spin-wheel.php" target="_blank" class="play-btn">Play Now</a>
      </div>
    </div>

    <!-- Game 2 -->
    <div class="game-card">
      <img src="./games/img/slot.jpg" alt="Lucky Slot">
      <div class="game-content">
        <h2 class="game-title">Lucky Slot</h2>
        <p class="game-desc">Spin the reels and win big in this exciting slot machine game.</p>
        <a href="<?= $baseURL ?>/games/slot-spin.php" target="_blank" class="play-btn">Play Now</a>
      </div>
    </div>

    <!-- Game 3 -->
    <div class="game-card">
      <img src="./games/img/fish.png" alt="Fish Shooter">
      <div class="game-content">
        <h2 class="game-title">Fish Shooter</h2>
        <p class="game-desc">Shoot fish and earn rewards in this fun underwater shooter game.</p>
        <a href="<?= $baseURL ?>/games/fish-shooting.php" target="_blank" class="play-btn">Play Now</a>
      </div>
    </div>

    <!-- Game 4 - Coming Soon -->
    <div class="game-card">
      <img src="./games/img/The-Mystery-of-Jewels.jpg" alt="Match 3 Jewels">
      <div class="game-content">
        <h2 class="game-title">Match 3 Jewels</h2>
        <p class="game-desc">Match candies and jewels to clear levels and unlock new worlds.</p>
         <a href="<?= $baseURL ?>/games/mystery-of-Jewels.php" target="_blank" class="play-btn">Play Now</a>
      </div>
    </div>

    <!-- Game 5 - Coming Soon -->
    <div class="game-card">
      <img src="./games/img/Fruit-Blast.png" alt="Fruit Blast">
      <div class="game-content">
        <h2 class="game-title">Fruit Blast</h2>
        <p class="game-desc">Blast fruits in colorful combos and complete juicy puzzles!</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  <!-- Game 6 - Coming Soon -->
     <div class="game-card">
      <img src="./games/img/megajump.webp" alt="mega jump">
      <div class="game-content">
        <h2 class="game-title">Mega Jump</h2>
        <p class="game-desc">Arcade jumping fun — how high can you go?</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  <!-- Game 7 - Coming Soon -->
     <div class="game-card">
      <img src="./games/img/yummy-tales.webp" alt="yummy tales">
      <div class="game-content">
        <h2 class="game-title">Yummy Tales</h2>
        <p class="game-desc">Match fruits and feed the animals in this fun puzzle game.</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  <!-- Game 8 - Coming Soon -->
     <div class="game-card">
      <img src="./games/img/SOHO.png" alt="soho card">
      <div class="game-content">
        <h2 class="game-title">Soho</h2>
        <p class="game-desc">A fast-paced card game of strategy and sharp thinking.</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  <!-- Game 9 - Coming Soon -->
     <div class="game-card">
      <img src="./games/img/spades.jpg" alt="spades card">
      <div class="game-content">
        <h2 class="game-title">Spades</h2>
       <p class="game-desc">Classic Spades — play tricks, partner up, and win big.</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  <!-- Game 10 - Coming Soon -->
     <div class="game-card">
      <img src="./games/img/mob.webp" alt="mob big win">
      <div class="game-content">
        <h2 class="game-title">MOB Big Win</h2>
       <p class="game-desc">Join the mob, spin the reels, and chase massive jackpots.</p>
        <a href="#" class="play-btn">Play Now</a>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="comingSoonModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2>Game Looked</h2>
      <p>
  <a id="link" href="https://fancywin.city/kh/en/new-register-entry/account" target="_blank" rel="noopener noreferrer">
    Join now
  </a> 
 to unlock more games, enjoy exciting gameplay, and win big — safe, fun, and easy!
</p>

    </div>
  </div>

  <script>
    const modal = document.getElementById("comingSoonModal");
    const playButtons = document.querySelectorAll(".play-btn");
    const closeBtn = document.querySelector(".close-btn");

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
  </script>

</body>
</html>
