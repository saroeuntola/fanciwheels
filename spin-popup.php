<style>
  .popup {
    position: relative;

  }

  .close-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    line-height: 0;
    color: #333;
    transition: color 0.3s ease;
  }

  .close-icon:hover {
    color: #f00;
  }

  /* Spin Wheel Modal (no background color) */
  #spinWheelModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .popup {
    background-image: url('image/Screenshot.png');
    padding: 70px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    font-size: 20px;
  }

  .wheel-container {
    position: relative;
    width: 300px;
    height: 300px;
    margin: 0 auto;
  }

  .border-spin {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('image/t.png');
    background-size: cover;
    background-position: center;
    border: none;
    z-index: 1;
  }

  .wheel {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('image/pngwing.com.png');
    background-size: cover;
    background-position: center;
    z-index: 0;
    transition: none;
  }

  #spinBtn {
    margin-top: 100px;
    padding: 12px 30px;
    font-size: 18px;
    width: 100%;
    cursor: pointer;
    background-color: #333;
  }

  /* Result Modal */
  #popupOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;

  }

  #popupOverlay .popup {
    background: black;
    padding: 30px;
    border-radius: 10px;
    max-width: 90%;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    font-size: 20px;
  }

  #popupOverlay .popup button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
  }

  @media (max-width: 600px) {
    #spinWheelModal .popup {
      width: 100vw;
      /* full viewport width */
      height: 100vh;
      /* full viewport height */
      border-radius: 0;
      /* remove rounded corners for full screen */
      padding: 20px;
      /* smaller padding for mobile */
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .close-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    line-height: 0;
    color: #333;
    transition: color 0.3s ease;
  }

    .wheel-container {
      width: 90vw;
      /* scale wheel container for mobile */
      height: 90vw;
      /* keep it square */
    }

    #spinBtn,
    #closeModalBtn {
      width: 80%;
      margin: 15px auto 0 auto;
      font-size: 20px;
    }
  }
</style>

<body>
  <!-- Spin Wheel Modal -->
  <div id="spinWheelModal">
    <div class="popup">
      <div class="wheel-container">
        <div class="border-spin"></div>
        <div class="wheel" id="wheel"></div>
      </div>
      <button id="spinBtn">SPIN</button>
      <button id="closeModalBtn" class="close-icon" aria-label="Close modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Result Popup -->
  <div id="popupOverlay">
    <div class="popup">
      <p id="popupMessage"></p>
      <button id="closePopup">OK</button>
    </div>
  </div>
</body>

  <script>
    const wheel = document.getElementById("wheel");
    const spinBtn = document.getElementById("spinBtn");
    const popupOverlay = document.getElementById("popupOverlay");
    const popupMessage = document.getElementById("popupMessage");
    const closePopup = document.getElementById("closePopup");
    const closeModalBtn = document.getElementById("closeModalBtn");

    const segmentNumbers = ["Jackpot", "$100", "$150", "$200", "$250", "$300", "$350", "$400", "$450", "$500", "$600", "$700", "$800", "$900", "$1000", "$2000", "$3000", "$4000"];
    const segments = segmentNumbers.length;
    const segmentAngle = 360 / segments;

    let startTimestamp = null;
    let duration = 8000;
    let startRotation = 0;
    let targetRotation = 0;
    let animationFrameId = null;
    let winningIndex = 0;

    function easeOutQuart(t) {
      return 1 - Math.pow(1 - t, 4);
    }

    function animate(timestamp) {
      if (!startTimestamp) startTimestamp = timestamp;
      const elapsed = timestamp - startTimestamp;
      let progress = elapsed / duration;
      if (progress > 1) progress = 1;

      const easedProgress = easeOutQuart(progress);
      const currentRotation = startRotation + easedProgress * (targetRotation - startRotation);
      wheel.style.transform = `rotate(${currentRotation}deg)`;

      if (progress < 1) {
        animationFrameId = requestAnimationFrame(animate);
      } else {
        performWobble(currentRotation);
      }
    }

    function performWobble(baseRotation) {
      const wobbleSequence = [-5, 4, -3, 2, -1, 1, -0.5, 0];
      let index = 0;

      function doWobble() {
        if (index >= wobbleSequence.length) {
          spinBtn.disabled = false;

          const finalRotation = baseRotation + wobbleSequence[wobbleSequence.length - 1];
          const normalizedRotation = finalRotation % 360;
          const adjustedRotation = (normalizedRotation + segmentAngle / 2) % 360;
          winningIndex = Math.floor(adjustedRotation / segmentAngle);
          winningIndex = (segments - (winningIndex % segments)) % segments;

          const winNumber = segmentNumbers[winningIndex];
          popupMessage.textContent = `🎉 You won ${winNumber}!`;
          popupOverlay.style.display = "flex";
          return;
        }

        const currentWobbleRotation = baseRotation + wobbleSequence[index];
        wheel.style.transition = "transform 0.3s ease-in-out";
        wheel.style.transform = `rotate(${currentWobbleRotation}deg)`;
        index++;
        setTimeout(doWobble, 200);
      }

      doWobble();
    }

    function getCurrentRotation() {
      const style = window.getComputedStyle(wheel);
      const transform = style.getPropertyValue("transform");
      if (transform === "none") return 0;
      const values = transform.match(/matrix\(([^)]+)\)/)[1].split(", ");
      const a = parseFloat(values[0]);
      const b = parseFloat(values[1]);
      let angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
      return angle < 0 ? angle + 360 : angle;
    }

    spinBtn.addEventListener("click", () => {
      if (spinBtn.disabled) return;

      spinBtn.disabled = true;
      cancelAnimationFrame(animationFrameId);

      startTimestamp = null;
      startRotation = getCurrentRotation();

      const spins = 6;
      winningIndex = Math.floor(Math.random() * segments);
      targetRotation = startRotation + spins * 360 + winningIndex * segmentAngle;

      wheel.style.transition = "none";
      animationFrameId = requestAnimationFrame(animate);
    });

    closePopup.addEventListener("click", () => {
      popupOverlay.style.display = "none";
    });

    closeModalBtn.addEventListener("click", () => {
      document.getElementById("spinWheelModal").style.display = "none";
    });

    // Show modal on page load
    window.addEventListener("load", () => {
      document.getElementById("spinWheelModal").style.display = "flex";
      wheel.style.transform = "rotate(0deg)";
    });
  </script>