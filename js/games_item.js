const games_item = [
  {
    title: "Crazy Time (Evo)",
    description: "Arcade jumping fun — how high can you go?",
    image: "./games/img/time.webp",
    link: "#"
  },
  {
    title: "Super Ace jili Slot",
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