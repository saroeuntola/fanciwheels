

    // Drag to scroll & arrow button scroll
    $(function () {
  const $grid = $(".post-grid");
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
    const scrollLeft = $grid.scrollLeft();

    if (scrollLeft <= 0) {
      // Scrolled to (or past) left cloned content - jump to middle copy
      $grid.scrollLeft(scrollLeft + (maxScrollLeft / 3));
    } else if (scrollLeft >= (maxScrollLeft * 2) / 3) {
      // Scrolled to (or past) right cloned content - jump back to middle copy
      $grid.scrollLeft(scrollLeft - (maxScrollLeft / 3));
    }
  });

  // Arrow buttons scroll with looping
  $("#prev-btns").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() - scrollAmount },
      300
    );
  });

  $("#next-btns").on("click", function () {
    $grid.animate(
      { scrollLeft: $grid.scrollLeft() + scrollAmount },
      300
    );
  });

  // Mouse wheel scroll horizontally
});