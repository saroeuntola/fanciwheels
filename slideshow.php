<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cold Slideshow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #ECEFF1;
    }

    .slideshow-container {
      position: relative;
      width: 79vw; /* Use viewport width, more natural */
      max-width: 1280px; /* max width for bigger screens */
      height: 400px;
      max-height: 400px;
      overflow: hidden;
      background-color: #B3E5FC;
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

<section class="slideshow-container" aria-label="Image slideshow">
  <div id="slide-container">
    <img class="slide-image active" src="./image/banner7.jpg" alt="Banner 1" />
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
  const slides = document.querySelectorAll('.slide-image');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const dotsContainer = document.getElementById('dots');
  let currentSlide = 0;
  const totalSlides = slides.length;

  // Create dots with accessibility
  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('button');
    dot.classList.add('dot');
    dot.setAttribute('role', 'tab');
    dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
    dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
    dot.addEventListener('click', () => goToSlide(i));
    dotsContainer.appendChild(dot);
  }

  const dots = dotsContainer.querySelectorAll('.dot');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
      dots[i].classList.toggle('active', i === index);
      dots[i].setAttribute('aria-selected', i === index ? 'true' : 'false');
    });
  }

  function goToSlide(index) {
    currentSlide = (index + totalSlides) % totalSlides;
    showSlide(currentSlide);
  }

  function nextSlide() {
    goToSlide(currentSlide + 1);
  }

  function prevSlide() {
    goToSlide(currentSlide - 1);
  }

  nextBtn.addEventListener('click', nextSlide);
  prevBtn.addEventListener('click', prevSlide);

  let autoSlide = setInterval(nextSlide, 5000);

  document.querySelector('.slideshow-container').addEventListener('mouseenter', () => {
    clearInterval(autoSlide);
  });

  document.querySelector('.slideshow-container').addEventListener('mouseleave', () => {
    autoSlide = setInterval(nextSlide, 5000);
  });

  showSlide(currentSlide);
</script>

</body>
</html>
