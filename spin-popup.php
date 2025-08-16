<style>

  .iti__country-list{
    background: black;
    width: 300px;
  }
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
    padding: 50px;
  }

  .popup {
    background-image: url(image/test3.png);
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
    background-image: url('image/inner-sw.png');
    background-size: cover;
    background-position: center;
    z-index: 0;
    transition: none;
  }
#spinCountDisplay{
  color: wheat;
  background-color:#E3DC24;
  border-radius: 50px;
  width: 50%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #333;
  font-size: 15px;
    margin-top: 120px;
    margin-left: 70px;
  
}
  #spinBtn {
    padding: 12px 30px;
    font-size: 18px;
    width: 100%;
    cursor: pointer;
    background-color:#E3DC24;
    border-radius: 25px;
  margin-top: 15px;
    color: #333;
    font-weight: bold;
  }
  #spinBtn:hover {
     background-color: #1400AD;
     transition: 500ms;
     color: white;
     
  }

  /* Result Modal */
  #popupOverlay, #popupOverlay1{
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

  #popupOverlay .popup , #popupOverlay1 .popup {
    background: black;
    padding: 30px;
    border-radius: 10px;
    max-width: 90%;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    font-size: 20px;
  }

  #popupOverlay .popup button, #popupOverlay1 .popup button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
  }

  @media (max-width: 600px) {
    #spinWheelModal .popup {
      /* full viewport height */
      border-radius: 0;
      /* remove rounded corners for full screen */
      padding: 20px;
      /* smaller padding for mobile */
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
       
    width: 340px;
    height: 340px;
    }

#spinBtn{
  margin-bottom: 30px;
}
#spinCountDisplay {
}
    /* #spinBtn,
    #closeModalBtn {
      width: 80%;
      margin: 15px auto 0 auto;
      font-size: 20px;
    } */


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
   <div id="spinCountDisplay"></div>
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
<div id="popupOverlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
  <div class="popup bg-gray-900 rounded-xl shadow-xl max-w-md w-full p-8 text-white font-sans relative lg:w-[25%] md:w-[50%]">
    <!-- Close Button (X) -->
    <button id="closePopup" aria-label="Close popup"
      class="absolute top-4 right-4 text-yellow-400 hover:text-yellow-500 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <line x1="18" y1="6" x2="6" y2="18" />
        <line x1="6" y1="6" x2="18" y2="18" />
      </svg>
    </button>

    <p id="popupMessage" class="text-center text-lg font-semibold mb-6"></p>
    <!-- Registration Form -->
    <form id="registerForm" class="space-y-6">
      <h3 class="text-sm font-bold text-yellow-400 text-center">Resigter Now! <br> New player get free 100$ to play game.</h3>
<div>
  <input
    type="text"
    id="name"
    name="name"
    required
    placeholder="Name"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>



<div>
  <input
    type="email"
    id="gmail"
    name="gmail"
    required
    placeholder="Email"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>

<div>
  <input
    type="tel"
    id="phone"
    name="phone"
    placeholder="Phone Number"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>

      <button
        type="submit"
        class="w-full bg-yellow-400 text-gray-900 font-semibold py-3 rounded-lg hover:bg-yellow-500 transition"
      >
        Login
      </button>
    </form>
  </div>
</div>


<div id="popupOverlay1" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
  <div class="popup bg-gray-900 rounded-xl shadow-xl max-w-md w-full p-8 text-white font-sans relative lg:w-[25%] md:w-[50%]">
    <!-- Close Button (X) -->
    <button id="closePopup1" aria-label="Close popup"
      class="absolute top-4 right-4 text-yellow-400 hover:text-yellow-500 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <line x1="18" y1="6" x2="6" y2="18" />
        <line x1="6" y1="6" x2="18" y2="18" />
      </svg>
    </button>
    <!-- Registration Form -->
    <form id="registerForm1" class="space-y-6">
      <h3 class="text-sm font-bold text-yellow-400 text-center">Your Spin Time is Enough! <br> Please Register to play game</h3>
<div>
  <input
    type="text"
    id="name"
    name="name"
    required
    placeholder="Name"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>

<div>
  <input
    type="email"
    id="gmail"
    name="gmail"
    required
    placeholder="Email"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>

<div>
  <input
    type="tel"
    id="phone1"
    name="phone"
    placeholder="Phone Number"
    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
  />
</div>

      <button
        type="submit"
        class="w-full bg-yellow-400 text-gray-900 font-semibold py-3 rounded-lg hover:bg-yellow-500 transition"
      >
        Login
      </button>
    
    </form>
  </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

<script>
const phoneInput = document.querySelector("#phone");
const phoneInput1 = document.querySelector("#phone1");

// First phone input
const iti = window.intlTelInput(phoneInput, {
  initialCountry: "bd",
  preferredCountries: ["bd", "in", "vn", "cn"],
  separateDialCode: true,
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
});

// Second phone input
const iti1 = window.intlTelInput(phoneInput1, {
  initialCountry: "bd",
  preferredCountries: ["bd", "in", "vn", "cn"],
  separateDialCode: true,
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
});

document.querySelector("#registerForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  // Replace phone field with full format
  phoneInput.value = iti.getNumber();

  const formData = new FormData(e.target);
  const name = formData.get("name").trim();
  const gmail = formData.get("gmail").trim();
  const phone = formData.get("phone").trim();

  if (!name || !gmail) {
    Swal.fire({
      icon: "warning",
      title: "Missing Information",
      text: "Please fill in Name and Gmail."
    });
    return;
  }

  try {
    const response = await fetch("https://fanciwheel.com/admin/page/api/create_player", {
      method: "POST",
      body: new URLSearchParams({ name, gmail, phone }),
      headers: { "Content-Type": "application/x-www-form-urlencoded" }
    });

    const data = await response.json();
    if (data.success) {
      Swal.fire({
        icon: "success",
        title: `Welcome, ${data.player.name}!`,
        text: "Registration successful.",
      }).then(() => {
        window.open("spin.php");
      });
    } else {
      Swal.fire({ icon: "error", title: "Registration Failed", text: data.message || "Failed to register." });
    }
  } catch (error) {
    Swal.fire({ icon: "error", title: "Server Error", text: "An error occurred during registration." });
    console.error(error);
  }
});

document.querySelector("#registerForm1").addEventListener("submit", async (e) => {
  e.preventDefault();

  // Replace phone1 field with full format
  phoneInput1.value = iti1.getNumber();

  const formData = new FormData(e.target);
  const name = formData.get("name").trim();
  const gmail = formData.get("gmail").trim();
  const phone = formData.get("phone1").trim(); // Notice phone1 here!

  if (!name || !gmail) {
    Swal.fire({
      icon: "warning",
      title: "Missing Information",
      text: "Please fill in Name and Gmail."
    });
    return;
  }

  try {
    const response = await fetch("https://fanciwheel.com/admin/page/api/create_player", {
      method: "POST",
      body: new URLSearchParams({ name, gmail, phone }),
      headers: { "Content-Type": "application/x-www-form-urlencoded" }
    });

    const data = await response.json();
    if (data.success) {
      Swal.fire({
        icon: "success",
        title: `Welcome, ${data.player.name}!`,
        text: "Registration successful.",
      }).then(() => {
        window.open("spin.php");
      });
    } else {
      Swal.fire({ icon: "error", title: "Registration Failed", text: data.message || "Failed to register." });
    }
  } catch (error) {
    Swal.fire({ icon: "error", title: "Server Error", text: "An error occurred during registration." });
    console.error(error);
  }
});
</script>


<script>
  const wheel = document.getElementById("wheel");
  const spinBtn = document.getElementById("spinBtn");
  const popupOverlay = $("#popupOverlay");
   const popupOverlay1 = $("#popupOverlay1");
  const popupMessage = $("#popupMessage");
  const closePopup = $("#closePopup");
    const closePopup1 = $("#closePopup1");
  const closeModalBtn = document.getElementById("closeModalBtn");

  const segmentNumbers = ["Blue", "orange", "Blue", "Yallow", "Purple", "Pink", "Green", "Yallow", "Orange", "Purple", "Pink", "$700", "Green", "Yallow", "Orange", "Blue", "yallow", "Green","Purple", "yallow", "Pink"];
  const segments = segmentNumbers.length;
  const segmentAngle = 360 / segments;

  let startTimestamp = null;
  let duration = 8000;
  let startRotation = 0;
  let targetRotation = 0;
  let animationFrameId = null;
  let winningIndex = 0;

  let spinCount = 0; 
  const maxSpins = 1;
  const spinCountDisplay = document.getElementById("spinCountDisplay");

  function updateSpinCountDisplay() {
     spinCountDisplay.textContent = `Free Spin: ${spinCount}/${maxSpins}`;
  spinCountDisplay.classList.add("spin-count");
  }

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
        popupMessage.text(`🎉 You won ${winNumber}!`);

        // Show popup with slide down animation
        popupOverlay.hide().css("display", "flex").hide().slideDown(400);
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

    if (spinCount >= maxSpins) {
      popupOverlay1.hide().css("display", "flex").hide().slideDown(400);
      spinBtn.disabled = true;
      return;
    }

    spinCount++;                // Increment spin count
    updateSpinCountDisplay();   // Update UI

    spinBtn.disabled = true;
    cancelAnimationFrame(animationFrameId);

    startTimestamp = null;
    startRotation = getCurrentRotation();

    const spins = 3; // Number of rotations per spin
    winningIndex = Math.floor(Math.random() * segments);
    targetRotation = startRotation + spins * 360 + winningIndex * segmentAngle;

    wheel.style.transition = "none";
    animationFrameId = requestAnimationFrame(animate);
  });

  closePopup.on("click", () => {
    popupOverlay.slideUp(400);
  });

  closePopup1.on("click", () => {
    popupOverlay1.slideUp(400);
  });
  closeModalBtn.addEventListener("click", () => {
    document.getElementById("spinWheelModal").style.display = "none";
  });

  // Show modal on page load
  window.addEventListener("load", () => {
    document.getElementById("spinWheelModal").style.display = "flex";
    wheel.style.transform = "rotate(0deg)";
    updateSpinCountDisplay(); // initialize display
  });
</script>
