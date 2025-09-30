<?php
include './config/baseURL.php';

?>
<style>
    .iti {
        width: 100% !important;
    }

    .iti input {
        width: 100% !important;
    }

    .iti__country-list {
        background: black;
        width: 280px;
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
        transition: color 0.3s ease;
        z-index: 1000;
    }

    /* Spin Wheel Modal (no background color) */
    #spinWheelModal {
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 50px;
    }

    #spinWheelModal .popup {
        background-image: url('image/bg-image.jpg');
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

    .wheel {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url('image/wheel-test.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 0;
    }

    .small-wheel {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url('image/test1.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 1;
    }

    .border-spin {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('image/Frame1_1.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 2;
        pointer-events: none;
    }

    #spinCountDisplay {
        border-radius: 50px;
        width: 50%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        margin-top: 120px;
        margin-left: 72px;
        padding: 10px 0px;

    }

    #spinBtn {
        padding: 12px 30px;
        font-size: 18px;
        width: 100%;
        cursor: pointer;
        border-radius: 25px;
        margin-top: 15px;
        font-weight: bold;
    }

    /* Result Modal */
    #popupOverlay,
    #popupOverlay1 {
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

    #popupOverlay .popup,
    #popupOverlay1 .popup {
        background-color: #1F2937;
    }

    input {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    input:focus {
        background: rgba(255, 255, 255, 0.12) !important;
        border-color: rgba(102, 126, 234, 0.5);
        box-shadow:
            0 0 0 3px rgba(102, 126, 234, 0.1),
            0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    #popupOverlay .popup button,
    #popupOverlay1 .popup button {
        padding: 12px 20px;
        font-size: 16px;
    }

    @media (max-width: 600px) {
        #spinWheelModal .popup {
            padding: 10px;
        }

        .close-icon {
            position: absolute;
            top: 5px;
            right: 5px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            line-height: 0;
            color: white;
            transition: color 0.3s ease;
        }

        .wheel-container {

            width: 340px;
            height: 340px;
        }

        #spinBtn {
            margin-bottom: 30px;
        }

        #spinCountDisplay {
            margin-left: 85px;
        }
    }
</style>
<link rel="stylesheet" href="./dist/css/toastr.min.css">
<script src="./js/toastr.min.js"></script>

<body>
    <!-- Spin Wheel Modal -->
    <div id="spinWheelModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500 z-50">
        <div class="popup transform scale-95 transition-all duration-500 bg-gray-800 p-6 rounded-2xl relative">
            <div class="wheel-container">
                <div class="border-spin"></div>
                <div class="small-wheel"></div>
                <div class="wheel" id="wheel"></div>
            </div>
            <div class=" bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700 shadow-lg text-white rounded-full" id="spinCountDisplay"></div>
            <button class=" bg-blue-600 hover:bg-blue-700 hover:transition hover:duration-700 shadow-lg text-white rounded-full" id="spinBtn"><?= $lang === 'en' ? 'SPIN' : 'স্পিন' ?></button>

            <button id="closeModalBtn" class="close-icon text-white" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Result Popup -->
    <!-- Result Popup -->
    <div id="popupOverlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden px-4">
        <div class="popup rounded-xl shadow-xl max-w-md w-full text-white font-sans relative bg-gray-800 p-6">
            <!-- Close Button -->
            <button id="closePopup" aria-label="Close popup" class="absolute top-0 right-0 p-0 focus:outline-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
            <!-- Title -->
            <h1 id="popupTitle" class="text-center text-2xl font-bold text-green-700 mb-2"></h1>

            <!-- Win Message -->
            <p id="popupMessage" class="text-center mb-2 text-white"></p>
            <p id="popupHit" class="text-center text-sm text-yellow-400 mb-4"></p>

            <!-- Phone Input + Error -->
            <div class="mb-2">
                <input type="tel" id="phoneInput" placeholder="Enter Phone Number"
                    class="w-full px-3 py-2 rounded-lg text-white focus:outline-none" />
                <p id="phoneError" class="text-red-500 text-sm mt-1"></p>
            </div>

            <!-- Claim Button (always enabled) -->
            <a id="popupLink" href="#"
                class="block w-full text-center bg-blue-600 hover:bg-blue-700 rounded-lg py-2 font-bold transition duration-300 mt-4">
                <span id="popupBtnText"></span>
            </a>
        </div>
    </div>

</body>

<script>
    window.APP_CONFIG = {
        API_URL: "<?= $apiBaseURL ?>"
    };
</script>
<script type="module" src="secure_js.php?file=script.js"></script>
<script>
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

        "2", "Crazy Time", "1", "2", "Jili Slots", "5", "1", "KM Slots"
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
            claim: "Claim Now"
        },
        bn: {
            freeSpin: "ফ্রি স্পিন",
            winMessage: "আপনি জিতেছেন",
            congratulations: "অভিনন্দন!",
            claim: "এখনই দাবি করুন"
        }
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
        const currentRotation = startRotation + easedProgress * (targetRotation - startRotation);
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
                bn: "ক্রেজি টাইম-এ ৫০০ টাকা বোনাস"
            },
            // hit: "20%",
            link: "https://bit.ly/500EvoReg"
        },
        "KM Slots": {
            win: {
                en: "bonus 300tk on KM Slots & Table",
                bn: "৩০০ টাকা কেএম স্লটস এবং টেবিল"
            },
            // hit: "35%",
            link: "https://bit.ly/300KMReg"
        },
        "Jili Slots": {
            win: {
                en: "bonus 200tk on Jili Slots",
                bn: "জিলি স্লটস ফ্রি প্লে"
            },
            // hit: "25%",
            link: "https://bit.ly/200JiliReg"
        },
        "1": {
            win: {
                en: "1x Bonus",
                bn: "1x Bonus"
            },
            // hit: "0%",
            link: ""

        },
        "2": {
            win: {
                en: "2x Bonus",
                bn: "২গুণ বোনাস"
            },
            // hit: "10%",
            link: ""
        },
        "5": {
            win: {
                en: "a chance to spin again",
                bn: "আবার স্পিন করার সুযোগ"
            },
            // hit: "10%",
            link: ""
        }
    };

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
                const config = winConfig[winNumber] || {
                    win: {
                        en: winNumber,
                        bn: winNumber
                    },
                    hit: "",
                    link: "#"
                };

                // Title & win message
                $("#popupTitle").text(translations[lang].congratulations);
                $("#popupBtnText").text(translations[lang].claim);
                popupMessage.text(`${translations[lang].winMessage} ${config.win[lang]}!`).css("color", "white");

                // Hit %
                if (config.hit) {
                    $("#popupHit").text(config.hit).show();
                } else {
                    $("#popupHit").hide();
                }

                if ($("#phoneError").length === 0) {
                    $("#phoneInput").after('<p id="phoneError" class="text-red-500 text-sm mt-1"></p>');
                }

                $(document).off("click", "#popupLink").on("click", "#popupLink", function(e) {
                    e.preventDefault();
                    const phone = phoneInput.val().trim();

                    if (!/^\d{8,20}$/.test(phone)) {
                        $("#phoneError").text("❌Please enter phone number to claim your win bonus.");
                        return;
                    }
                    $("#phoneError").text("");
                    $.post("https://fanciwheel.com/admin/page/api/savePhone", {
                        phone
                    }, function(res) {
                        if (res.success) {
                            popupMessage.text(res.message).css("color", "green");
                            popupOverlay.slideUp(400);

                            if (winNumber !== "5" && config.link) {
                                window.open(config.link, "_blank");
                            } else if (winNumber === "5") {
                                maxSpins++;
                                updateSpinCountDisplay();
                            }
                        } else {
                            $("#phoneError").text(res.message);
                        }
                    }, "json");
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
</script>