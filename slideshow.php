<?php
include './admin/page/library/banner_lib.php';
$bannerObj = new Banner();
$banners = $bannerObj->getBanner();
?>
<style>
  body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background-color: #ECEFF1;
  }

  .slideshow-container {
    position: relative;
    width: 100%;
    max-width: 1212px;
    height: 400px;
    overflow: hidden;
    margin: 85px auto 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
  }

  /* Slides */
  .slide-image {
    width: 100%;
    height: 100%;
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

  /* Navigation buttons */
  .nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    padding: 14px;
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 2;
    opacity: 80%;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: background 0.3s, transform 0.3s;
  }

  .nav-btn:hover,
  .nav-btn:focus {
    transform: translateY(-50%) scale(1.1);
    outline: none;
  }

  #prevBtn {
    left: 0.4rem;
  }

  #nextBtn {
    right: 0.4rem;
  }

  /* Dots */
  .dots-container {
    position: absolute;
    bottom: 0.5rem;
    width: 100%;
    text-align: center;
    z-index: 2;
  }

  .dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    background: rgba(255, 255, 255);
    border-radius: 50%;
    margin: 0 5px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .dot.active {
    background: #1E88E5;
  }

  /* Responsive: Large tablets */
  @media (max-width: 1024px) {
    .slideshow-container {
      width: 47.5rem;
      height: 280px;
    }

    .dots-container {
      bottom: 1rem;
    }
  }

  /* Responsive: Small tablets */
  @media (max-width: 768px) {
    .slideshow-container {
      width: 45.5rem;
      height: 275px;
    }

    .dots-container {
      bottom: 1rem;
    }
  }

  /* Responsive: Mobile */
  @media (max-width: 480px) {
    .nav-btn {
      padding: 4px;
    }

    .slideshow-container {
      width: 92.5vw;
      height: 170px;
      border-radius: 0px;
    }

    .dots-container {
      bottom: 0rem;
    }

    .dot {
      width: 6px;
      height: 6px;
      margin: 0 4px;
    }
  }

  /* Ensure images always fill the container height */
  .slideshow-container .slide-image {
    height: 100%;
    width: 100%;
    object-fit: fill;
  }
</style>

<body>
  <section class="slideshow-container max-w-7xl mx-auto" aria-label="Image slideshow">
    <div id="slide-container">
      <?php if (!empty($banners)): ?>
        <?php foreach ($banners as $index => $banner): ?>
          <img class="slide-image <?= $index === 0 ? 'active' : '' ?>"
            src="<?= './admin/page/banner/' . htmlspecialchars($banner['image']) ?>"
            alt="<?= htmlspecialchars($banner['title']) ?>"
            class="">
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-gray-500">No banners available</p>
      <?php endif; ?>
    </div>

    <button id="prevBtn" class="nav-btn" aria-label="Previous slide">
      <i class="fas fa-chevron-left" aria-hidden="true"></i>
    </button>
    <button id="nextBtn" class="nav-btn" aria-label="Next slide">
      <i class="fas fa-chevron-right" aria-hidden="true"></i>
    </button>
    <div class="dots-container" id="dots" role="tablist" aria-label="Slide navigation"></div>
  </section>
  <script type="module" src="secure_js.php?file=slide_script.js"></script>
</body>