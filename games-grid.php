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
    @media (max-width: 768px ) { 
   .game-grid {
      padding: 0px 10px;
}
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 1rem;
      }
      .game-grid {
      padding: 0px 10px;
      grid-template-columns: repeat(2, 1fr);

    }
    .game-card img {
      width: 100%;
      height: 125px;
      object-fit: cover;
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
  <div class="game-grid" id="gameGrid">
  
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
  const baseURL = "<?= $baseURL ?>";
</script>
<script src="./js/games_item.js"></script>
</body>
</html>
