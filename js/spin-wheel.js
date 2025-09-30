const API_BASE = window.APP_CONFIG?.API_URL || "";
$("#phoneInput").on("input", function () {
  let val = $(this).val();

  // Remove all characters except digits and '+'
  val = val.replace(/[^\d+]/g, "");

  // Ensure '+' is only at the start
  if (val.indexOf("+") > 0) {
    val = val.replace(/\+/g, "");
    val = "+" + val;
  }

  $(this).val(val);
});
// Use jQuery for consistency
const selectedCountry = $("#selectedCountry");
const countryList = $("#countryList");

// Toggle country dropdown
selectedCountry.on("click", function () {
  countryList.toggle();
});

// Select a country from the list
countryList.on("click", "li", function () {
  const code = $(this).data("code");
  const flag = $(this).data("flag");

  selectedCountry.find("span").text(code);
  selectedCountry.find("img").attr("src", flag);

  countryList.hide();
});

const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spinBtn");
const popupOverlay = $("#popupOverlay");
const popupOverlay1 = $("#popupOverlay1");
const popupMessage = $("#popupMessage");
const closePopup = $("#closePopup");
const closePopup1 = $("#closePopup1");
const closeModalBtn = document.getElementById("closeModalBtn");
const phoneInput = $("#phoneInput");
const claimBtn = $("#popupLink");
const segmentNumbers = [
  "2",
  "Crazy Time",
  "1",
  "2",
  "Jili Slots",
  "5",
  "1",
  "KM Slots",
];

const segments = segmentNumbers.length;
const segmentAngle = 360 / segments;
let startTimestamp = null;
let duration = 8000;
let startRotation = 0;
let targetRotation = 0;
let animationFrameId = null;
let winningIndex = 0;
const lang = "<?= $lang ?>";
const translations = {
  en: {
    freeSpin: "Free Spin",
    winMessage: "You won",
    congratulations: "Congratulations!",
    claim: "Claim Now",
  },
  bn: {
    freeSpin: "ফ্রি স্পিন",
    winMessage: "আপনি জিতেছেন",
    congratulations: "অভিনন্দন!",
    claim: "এখনই দাবি করুন",
  },
};

let spinCount = 0;
let maxSpins = 2;
const spinCountDisplay = document.getElementById("spinCountDisplay");

function updateSpinCountDisplay() {
  const text = `${translations[lang].freeSpin}: ${spinCount}/${maxSpins}`;
  spinCountDisplay.textContent = text;
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
  const currentRotation =
    startRotation + easedProgress * (targetRotation - startRotation);
  wheel.style.transform = `rotate(${currentRotation}deg)`;

  if (progress < 1) {
    animationFrameId = requestAnimationFrame(animate);
  } else {
    performWobble(currentRotation);
  }
}

const winConfig = {
  "Crazy Time": {
    win: {
      en: "bonus 500tk on Crazy Time",
      bn: "ক্রেজি টাইম-এ ৫০০ টাকা বোনাস",
    },
    // hit: "20%",
    link: "https://bit.ly/500EvoReg",
  },
  "KM Slots": {
    win: {
      en: "bonus 300tk on KM Slots & Table",
      bn: "৩০০ টাকা কেএম স্লটস এবং টেবিল",
    },
    // hit: "35%",
    link: "https://bit.ly/300KMReg",
  },
  "Jili Slots": {
    win: {
      en: "bonus 200tk on Jili Slots",
      bn: "জিলি স্লটস ফ্রি প্লে",
    },
    // hit: "25%",
    link: "https://bit.ly/200JiliReg",
  },
  1: {
    win: {
      en: "1x Bonus",
      bn: "1x Bonus",
    },
    // hit: "0%",
    link: "",
  },
  2: {
    win: {
      en: "2x Bonus",
      bn: "২গুণ বোনাস",
    },
    // hit: "10%",
    link: "",
  },
  5: {
    win: {
      en: "a chance to spin again",
      bn: "আবার স্পিন করার সুযোগ",
    },
    // hit: "10%",
    link: "",
  },
};

function performWobble(baseRotation) {
  const wobbleSequence = [-5, 4, -3, 2, -1, 1, -0.5, 0];
  let index = 0;

  function doWobble() {
    if (index >= wobbleSequence.length) {
      spinBtn.disabled = false;

      const finalRotation =
        baseRotation + wobbleSequence[wobbleSequence.length - 1];
      const normalizedRotation = finalRotation % 360;
      const adjustedRotation = (normalizedRotation + segmentAngle / 2) % 360;
      winningIndex = Math.floor(adjustedRotation / segmentAngle);
      winningIndex = (segments - (winningIndex % segments)) % segments;

      const winNumber = segmentNumbers[winningIndex];
      const config = winConfig[winNumber] || {
        win: {
          en: winNumber,
          bn: winNumber,
        },
        hit: "",
        link: "#",
      };

      // Title & win message
      $("#popupTitle").text(translations[lang].congratulations);
      $("#popupBtnText").text(translations[lang].claim);
      popupMessage
        .text(`${translations[lang].winMessage} ${config.win[lang]}!`)
        .css("color", "white");

      // Hit %
      if (config.hit) {
        $("#popupHit").text(config.hit).show();
      } else {
        $("#popupHit").hide();
      }

      if ($("#phoneError").length === 0) {
        $("#phoneInput").after(
          '<p id="phoneError" class="text-red-500 text-sm mt-1"></p>'
        );
      }

      $(document)
        .off("click", "#popupLink")
        .on("click", "#popupLink", function (e) {
          e.preventDefault();

          let phone = $("#phoneInput").val().trim();
          const countryCode = $("#selectedCountry span").text().trim();

          phone = phone.replace(/\D/g, "");

          if (phone.length < 8 || phone.length > 20) {
            $("#phoneError").text(
              "❌ Please enter phone number to claim your win bonus."
            );
            return;
          }

          $("#phoneError").text("");

          $.post(
            API_BASE + "savePhone",
            {
              phone: countryCode + phone,
            },
            function (res) {
              if (res.success) {
                $("#popupMessage").text(res.message).css("color", "green");
                $("#popupOverlay").slideUp(400);
                $("#phoneInput").val(""); // Clear input after submission

                // Handle reward links or extra spin
                if (winNumber !== "5" && config.link) {
                  window.open(config.link, "_blank");
                } else if (winNumber === "5") {
                  maxSpins++;
                  updateSpinCountDisplay();
                }
              } else {
                if (res.message.includes("already used")) {
                  $("#phoneError").text("❌ Phone Number Already used!");
                } else {
                  $("#phoneError").text("❌ " + res.message);
                }
              }
            },
            "json"
          );
        });

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

  spinCount++; // Increment spin count
  updateSpinCountDisplay(); // Update UI

  spinBtn.disabled = true;
  cancelAnimationFrame(animationFrameId);

  startTimestamp = null;
  startRotation = getCurrentRotation();

  const spins = 4; // Number of rotations per spin
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

const spinWheelModal = document.getElementById("spinWheelModal");

// Open modal
function openSpinWheelModal() {
  spinWheelModal.classList.remove("opacity-0", "pointer-events-none");
  void spinWheelModal.offsetWidth;
  spinWheelModal.querySelector(".popup").classList.remove("scale-95");
  spinWheelModal.querySelector(".popup").classList.add("scale-100");

  wheel.style.transform = "rotate(0deg)";
  updateSpinCountDisplay();
}

// Close modal
function closeSpinWheelModal() {
  spinWheelModal.querySelector(".popup").classList.remove("scale-100");
  spinWheelModal.querySelector(".popup").classList.add("scale-95");

  spinWheelModal.classList.add("opacity-0", "pointer-events-none");
}

closeModalBtn.addEventListener("click", closeSpinWheelModal);

spinWheelModal.addEventListener("click", (e) => {
  if (e.target === spinWheelModal) closeSpinWheelModal();
});

window.addEventListener("load", () => {
  setTimeout(() => {
    openSpinWheelModal();
  }, 1600);
});
