<style>
  .scroll-to-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 5;
    color: white;
    border: none;
    padding: 0;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.75rem;
    letter-spacing: 0.3px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(100px) scale(0.8);
    backdrop-filter: blur(10px);
  }

  .scroll-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
  }

  .scroll-to-top:active {
    transform: translateY(-4px) scale(1.05);
  }

  .scroll-to-top svg {
    width: 20px;
    height: 20px;
    margin-bottom: 2px;
    transition: transform 0.3s ease;
  }

  .scroll-to-top:hover svg {
    transform: translateY(-2px);
    animation: bounce 0.6s ease;
  }

  @keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
      transform: translateY(-2px);
    }

    40% {
      transform: translateY(-8px);
    }

    60% {
      transform: translateY(-4px);
    }
  }

  .scroll-to-top::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border-radius: 50%;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
    animation: rotate 3s linear infinite;
  }

  .scroll-to-top:hover::before {
    opacity: 1;
  }

  @keyframes rotate {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  /* Modern glassmorphism variant */
  .scroll-to-top.glass {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
  }

  .scroll-to-top.glass:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-8px) scale(1.1);
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.1);
  }

  @media (max-width: 768px) {
    .scroll-to-top {
      width: 50px;
      height: 50px;
      font-size: 0.65rem;
      bottom: 1.5rem;
      right: 1.5rem;
    }

    .scroll-to-top svg {
      width: 16px;
      height: 16px;
    }
  }
</style>


<button id="scrollToTopBtn" class="scroll-to-top  bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700" title="Scroll to top">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
  </svg>
  <span><?= $lang === 'en' ? ' TOP' : 'TOP' ?></span>
</button>

<script>
  const scrollToTopBtn = document.getElementById('scrollToTopBtn');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      scrollToTopBtn.classList.add('visible');
    } else {
      scrollToTopBtn.classList.remove('visible');
    }
  });
  scrollToTopBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
</script>