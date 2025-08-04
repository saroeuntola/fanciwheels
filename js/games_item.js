const games_item = [
   {
    title: "MOB Big Win",
    description: "Join the mob, spin the reels, and chase massive jackpots.",
    image: "./games/img/mob.webp",
    link: "#"
  },
  {
    
    title: "Lucky Wheel",
    description: "Spin the lucky wheel and win daily prizes. Try your luck!",
    image: "./games/img/spinwheel.png",
    link: baseURL + "/games/spin-wheel.php"
  },
  {
    title: "Lucky Slot",
    description: "Spin the reels and win big in this exciting slot machine game.",
    image: "./games/img/slot.jpg",
    link: baseURL + "/games/slot-spin.php"
  },
  {
    title: "Fish Shooter",
    description: "Shoot fish and earn rewards in this fun underwater shooter game.",
    image: "./games/img/fish.png",
    link: baseURL + "/games/fish-shooting.php"
  },
  {
    title: "Match 3 Jewels",
    description: "Match candies and jewels to clear levels and unlock new worlds.",
    image: "./games/img/The-Mystery-of-Jewels.jpg",
    link: baseURL + "/games/mystery-of-Jewels.php"
  },
  {
    title: "Fruit Blast",
    description: "Blast fruits in colorful combos and complete juicy puzzles!",
    image: "./games/img/Fruit-Blast.png",
    link: "#"
  },
  {
    title: "Mega Jump",
    description: "Arcade jumping fun — how high can you go?",
    image: "./games/img/megajump.webp",
    link: "#"
  },
  {
    title: "Yummy Tales",
    description: "Match fruits and feed the animals in this fun puzzle game.",
    image: "./games/img/yummy-tales.webp",
    link: "#"
  },
  {
    title: "Soho",
    description: "A fast-paced card game of strategy and sharp thinking.",
    image: "./games/img/SOHO.png",
    link: "#"
  },
  {
    title: "Spades",
    description: "Classic Spades — play tricks, partner up, and win big.",
    image: "./games/img/spades.jpg",
    link: "#"
  }
];

const modal = document.getElementById("comingSoonModal");
  const closeBtn = document.querySelector(".close-btn");
  const container = document.getElementById("gameGrid");

  // 1. Render game cards
  games_item.forEach(game => {
    const card = document.createElement("div");
    card.className = "game-card";
    card.innerHTML = `
      <img src="${game.image}" alt="${game.title}">
      <div class="game-content">
        <h2 class="game-title">${game.title}</h2>
        <a href="${game.link}" target="_blank" class="play-btn">Play Now</a>
      </div>
    `;
    container.appendChild(card);
  });

  // 2. Add modal functionality AFTER cards are in the DOM
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