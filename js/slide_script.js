     $(document).ready(function () {
  let $slides = $(".slide-image");
  let $dotsContainer = $("#dots");
  let currentSlide = 0;
  let totalSlides = $slides.length;
  let slideInterval;

  // Initialize slides position
  $slides.each(function (index) {
    $(this).css({
      position: "absolute",
      top: 0,
      left: index === 0 ? 0 : "100%",
      opacity: 1,
      display: "block"
    });
  });

  // Create navigation dots
  for (let i = 0; i < totalSlides; i++) {
    $dotsContainer.append(`<button class="dot" aria-label="Go to slide ${i + 1}"></button>`);
  }
  let $dots = $(".dot");
  $dots.eq(0).addClass("active");

  function showSlide(newIndex) {
    if (newIndex === currentSlide) return;

    let $currentSlide = $slides.eq(currentSlide);
    let $nextSlide = $slides.eq(newIndex);

    // Slide direction
    let direction = newIndex > currentSlide ? "-100%" : "100%";
    // Position next slide offscreen to right or left
    $nextSlide.css({ left: direction });

    // Animate current slide out
    $currentSlide.animate({ left: direction }, 500);

    // Animate next slide in
    $nextSlide.animate({ left: 0 }, 500);

    // Update dots
    $dots.removeClass("active").eq(newIndex).addClass("active");

    currentSlide = newIndex;
  }

  function goToSlide(index) {
    let newIndex = (index + totalSlides) % totalSlides;
    showSlide(newIndex);
  }

  function nextSlide() {
    goToSlide(currentSlide + 1);
  }

  function prevSlide() {
    goToSlide(currentSlide - 1);
  }

  // Button events
  $("#nextBtn").click(nextSlide);
  $("#prevBtn").click(prevSlide);

  // Dot click events
  $dotsContainer.on("click", ".dot", function () {
    goToSlide($(this).index());
  });

  // Auto slide
  function startAutoSlide() {
    slideInterval = setInterval(nextSlide, 5000);
  }

  function stopAutoSlide() {
    clearInterval(slideInterval);
  }

  $(".slideshow-container").hover(stopAutoSlide, startAutoSlide);

  startAutoSlide();
});