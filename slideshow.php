<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cold Slideshow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #ECEFF1;
    }

    .slideshow-container {
      position: relative;
      width: 100vw; /* Use viewport width, more natural */
      max-width: 1212px; /* max width for bigger screens */
      height: 400px;
      max-height: 400px;
      overflow: hidden;
      margin: 30px auto; /* center horizontally */
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 15px;
    }

    .slide-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: opacity 0.7s ease-in-out, transform 0.7s ease-in-out;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      z-index: 0;
    }

    .slide-image.active {
      opacity: 1;
      z-index: 1;
    }

    .nav-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.8);
      border: none;
      padding: 12px;
      border-radius: 50%;
      color: #263238;
      font-size: 1.2rem;
      cursor: pointer;
      z-index: 2;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: background 0.3s, transform 0.3s;
    }

    .nav-btn:hover,
    .nav-btn:focus {
      background: rgba(255, 255, 255, 1);
      transform: translateY(-50%) scale(1.1);
      outline: none;
    }

    #prevBtn {
      left: 1rem;
    }

    #nextBtn {
      right: 1rem;
    }

    .dots-container {
      position: absolute;
      bottom: 1rem;
      width: 100%;
      text-align: center;
      z-index: 2;
    }

    .dot {
      display: inline-block;
      width: 10px;
      height: 10px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      margin: 0 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .dot.active {
      background: #B3E5FC;
    }

       @media (max-width: 1024px) {
        .slideshow-container {
        width: 95vw;
        height: 300px;
      }
    }
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .slideshow-container {
        width: 91vw;
        height: 300px;
      }
    }
        @media (max-width: 800px) {
      .slideshow-container {
        width: 90vw;
        height: 300px;
      }
    }

    @media (max-width: 480px) {
      .slideshow-container {
        height: 240px;
         width: 93.5vw;
      }
    }
  </style>
</head>
<body>

<section class="slideshow-container max-w-7xl mx-auto" aria-label="Image slideshow">
  <div id="slide-container">
    <img class="slide-image" src="./image/banner7.jpg" alt="Banner 1" />
    <img class="slide-image" src="./image/banner5.webp" alt="Banner 2" />
    <img class="slide-image" src="./image/banner3.avif" alt="Banner 3" />
  </div>

  <button id="prevBtn" class="nav-btn" aria-label="Previous slide">
    <i class="fas fa-chevron-left" aria-hidden="true"></i>
  </button>
  <button id="nextBtn" class="nav-btn" aria-label="Next slide">
    <i class="fas fa-chevron-right" aria-hidden="true"></i>
  </button>

  <div class="dots-container" id="dots" role="tablist" aria-label="Slide navigation"></div>
</section>

<script>
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

</script>


</body>
</html>
