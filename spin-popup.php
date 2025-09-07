<?php
include './config/baseURL.php';
$translations = [
    'en' => [
        'spinMessage' => 'Your Spin Time is Enough!',
        'winMessage' => 'You won'
    ],
    'bn' => [
        'spinMessage' => 'তোমার স্পিন টাইম যথেষ্ট!',
        'winMessage' => 'তুমি জিতেছ'
    ]
];
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
        background-image: url('image/test23-removebg-preview.png');
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
        background: linear-gradient(135deg,
                rgba(0, 0, 255, 0.6),
                /* blue */
                rgba(255, 0, 0, 0.6)
                /* red */
            );
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow:
            0 25px 45px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);

    }
    /* Modern gradient backgrounds */
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Enhanced input styling */
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
        margin-top: 20px;
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

        /* #spinBtn,
    #closeModalBtn {
      width: 80%;
      margin: 15px auto 0 auto;
      font-size: 20px;
    } */


    }
</style>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<body>
    <!-- Spin Wheel Modal -->
    <div id="spinWheelModal">
        <div class="popup">
            <div class="wheel-container">
                <div class="border-spin"></div>
                <div class="small-wheel"></div>
                <div class="wheel" id="wheel"></div>
            </div>
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full" id="spinCountDisplay"></div>
            <button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full" id="spinBtn"><?= $lang === 'en' ? 'SPIN' : 'স্পিন' ?></button>

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
    <div id="popupOverlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="popup rounded-xl shadow-xl max-w-md w-full text-white font-sans relative bg-gray-800">
            <!-- Close Button -->
            <button id="closePopup" aria-label="Close popup" class="absolute top-0 right-0 focus:outline-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <h1 id="popupMessage" class="text-center text-lg font-semibold mb-6 text-white "></h1>
            <!-- Registration Form -->
            <form id="registerForm" class="space-y-6 p-6">
                <h3 class="text-sm font-bold text-white">
                    <?= $lang === 'en'
                        ? 'Sign up today to collect your win and unlock extra spin chances!'
                        : 'আজই নিবন্ধন করুন, আপনার জয়ের পুরস্কার সংগ্রহ করুন এবং অতিরিক্ত স্পিনের সুযোগ আনলক করুন!' ?>
                </h3>

                <!-- Name -->
                <div class="relative">

                    <input type="text" name="name" placeholder="<?= $lang === 'en' ? 'Name' : 'নাম' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="nameError1">
                        <?= $lang === 'en' ? 'Name is required' : 'নাম আবশ্যক' ?>
                    </span>
                </div>

                <!-- Email -->
                <div class="relative">

                    <input type="email" name="gmail" placeholder="<?= $lang === 'en' ? 'Email' : 'ইমেইল' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="emailError1">
                        <?= $lang === 'en' ? 'Email is required' : 'ইমেইল আবশ্যক' ?>
                    </span>
                </div>

                <!-- Phone -->
                <div class="relative">

                    <input type="tel" name="phone" id="phone"
                        placeholder="<?= $lang === 'en' ? 'Phone Number' : 'ফোন নম্বর' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                        oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-phone"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="phoneError1">
                        <?= $lang === 'en' ? 'Phone number is required' : 'ফোন নম্বর আবশ্যক' ?>
                    </span>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full py-3 transition">
                    <?= $lang === 'en' ? 'Sign up' : 'লগইন করুন' ?>
                </button>
            </form>
        </div>
    </div>
    <div id="popupOverlay1" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="popup rounded-xl shadow-xl max-w-md w-full text-white font-sans relative bg-blue-800">
            <!-- Close Button -->
            <button id="closePopup1" aria-label="Close popup" class="absolute top-0 right-0 p-0 focus:outline-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <!-- Registration Form 2 -->
            <form id="registerForm1" class="space-y-6 p-6">
                <div class="">
                    <h3 class="text-sm font-bold text-white text-center mb-4">
                        <?= $lang === 'en'
                            ? 'You have used all your spins'
                            : 'আপনি আপনার সব স্পিন ব্যবহার করেছেন' ?>
                    </h3>
                    <p class=" text-white">
                        <?= $lang === 'en'
                            ? 'Please register for free to get more spins'
                            : 'অধিক স্পিন পেতে দয়া করে বিনামূল্যে নিবন্ধন করুন' ?>
                    </p>
                </div>

                <!-- Name -->
                <div class="relative">

                    <input type="text" name="name" placeholder="<?= $lang === 'en' ? 'Name' : 'নাম' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="nameError2">
                        <?= $lang === 'en' ? 'Name is required' : 'নাম আবশ্যক' ?>
                    </span>
                </div>

                <!-- Email -->
                <div class="relative">

                    <input type="email" name="gmail" placeholder="<?= $lang === 'en' ? 'Email' : 'ইমেইল' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="emailError2">
                        <?= $lang === 'en' ? 'Email is required' : 'ইমেইল আবশ্যক' ?>
                    </span>
                </div>

                <!-- Phone -->
                <div class="relative">

                    <input type="tel" name="phone" id="phone1"
                        placeholder="<?= $lang === 'en' ? 'Phone Number' : 'ফোন নম্বর' ?>"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                        oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" />
                    <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
                        <i class="fa-solid fa-phone"></i>
                    </span>
                    <span class="text-red-500 text-sm mt-1 hidden" id="phoneError2">
                        <?= $lang === 'en' ? 'Phone number is required' : 'ফোন নম্বর আবশ্যক' ?>
                    </span>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full py-3 transition">
                    <?= $lang === 'en' ? 'Sign up' : 'লগইন করুন' ?>
                </button>
            </form>
        </div>
    </div>
</body>

<script>
    window.APP_CONFIG = {
        API_URL: "<?= $apiBaseURL ?>"
    };
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    const segmentNumbers = [

        "Red", "yallow", "Blue", "Yallow", "blue", "yallow", "red", "Yallow", "blue", "yallow", "blue", "yallow",
        "red", "Yallow", "blue", "yallow"
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
            winMessage: "🎉 You won"
        },
        bn: {
            freeSpin: "ফ্রি স্পিন",
            winMessage: "🎉 আপনি জিতেছেন"
        }
    };

    let spinCount = 0;
    const maxSpins = 1;
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
                popupMessage.text(`${translations[lang].winMessage} ${winNumber}!`);

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