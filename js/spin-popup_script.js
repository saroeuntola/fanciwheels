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