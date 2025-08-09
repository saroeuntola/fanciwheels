

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

    // Drag to scroll horizontally and arrow button scroll
$(function () {
  const $grid = $("#gameGrid");
  const scrollAmount = 390;

  // Clone content before and after for infinite loop illusion
  const originalContent = $grid.html();
  $grid.prepend(originalContent);
  $grid.append(originalContent);

  // Scroll to the original items in the middle
  const originalScrollLeft = $grid[0].scrollWidth / 3;
  $grid.scrollLeft(originalScrollLeft);

  // Handle scroll event to loop scroll position
  $grid.on("scroll", function () {
    const maxScrollLeft = $grid[0].scrollWidth;
    const viewportWidth = $grid.outerWidth();
    let scrollLeft = $grid.scrollLeft();

    if (scrollLeft <= 0) {
      // Scrolled to (or past) left cloned content - jump to middle copy
      $grid.scrollLeft(scrollLeft + (maxScrollLeft / 3));
    } else if (scrollLeft >= maxScrollLeft * 2 / 3) {
      // Scrolled to (or past) right cloned content - jump back to middle copy
      $grid.scrollLeft(scrollLeft - (maxScrollLeft / 3));
    }
  });

  // Arrow buttons scroll with looping
  $("#prev-btn").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() - scrollAmount },
      300
    );
  });

  $("#next-btn").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() + scrollAmount },
      300
    );
  });

});