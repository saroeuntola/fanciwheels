
<?php 
  include './admin/page/library/banner_lib.php';
  $bannerObj = new Banner();
$banners = $bannerObj->getBanner();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Slideshow</title>
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
      width: 100vw;
      max-width: 1212px;
      height: 400px;
      max-height: 400px;
      overflow: hidden;
      margin: 30px auto;
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
   <?php if (!empty($banners)): ?>
      <?php foreach ($banners as $index => $banner): ?>
          <img class="slide-image <?= $index === 0 ? 'active' : '' ?>" 
               src="<?= './admin/page/banner/' . htmlspecialchars($banner['image']) ?>"
               alt="<?= htmlspecialchars($banner['title']) ?>" 
               class="w-full h-full object-cover">
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

<script src="js/slide_script.js"></script>
</body>
</html>
