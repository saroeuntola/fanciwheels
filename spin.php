<?php
session_start();
if (!isset($_SESSION['player_name'])) {
  header("Location: register-form");
  exit;
}
$playerName = htmlspecialchars($_SESSION['player_name']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spin Wheel Game - Win Exciting Prizes</title>

  <!-- SEO Meta Tags -->
  <meta name="description" content="Play the Spin Wheel Game and win exciting prizes instantly! Try your luck and enjoy fun rewards online.">
  <meta name="keywords" content="Spin Wheel Game, Online Game, Win Prizes, Lucky Wheel, Fun Game">
  <meta name="author" content="FancyWheel">
  <link rel="icon" href="./image/inner-sw.png"
    type="image/png">
  <!-- Social Sharing / Open Graph -->
  <meta property="og:title" content="Spin Wheel Game - Win Exciting Prizes">
  <meta property="og:description" content="Play the Spin Wheel Game and win exciting prizes instantly!">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://fanciwheel.com/spin">
  <meta property="og:image" content="https://fanciwheel.com/image/inner-sw.png">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Spin Wheel Game - Win Exciting Prizes">
  <meta name="twitter:description" content="Play the Spin Wheel Game and win exciting prizes instantly!">
  <meta name="twitter:image" content="https://https://fanciwheel.com//image/inner-sw.png">

  <!-- TailwindCSS and other libraries -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;

    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }


  /* .game-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 1280px;
            width: 100%;
        }

        .title {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .wallet {
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            color: #333;
            padding: 15px 25px;
            border-radius: 50px;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 20px 0;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }


        .wheel-section {
            position: absolute;
            width: 50%;
            height: 50%;
            transform-origin: right bottom;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .betting-section {
            margin: 30px 0;
        }

        .bet-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .bet-item {
            padding: 12px 20px;
            border: 3px solid transparent;
            border-radius: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            color: #333;
        }

        .bet-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .bet-item.selected {
            border-color: #667eea;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .bet-item.apple { border-color: #ff6b6b; }
        .bet-item.diamond { border-color: #4ecdc4; }
        .bet-item.star { border-color: #45b7d1; }
        .bet-item.heart { border-color: #96ceb4; }
        .bet-item.coin { border-color: #feca57; }

        .bet-amount {
            margin: 20px 0;
        }

        .bet-amount input {
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 1.1rem;
            text-align: center;
            width: 150px;
            margin: 0 10px;
        }

        .bet-amount input:focus {
            outline: none;
            border-color: #667eea;
        }

        .spin-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 20px 0;
        }

        .spin-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        .spin-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .message {
            margin: 20px 0;
            padding: 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .message.win {
            background: linear-gradient(45deg, #4caf50, #8bc34a);
            color: white;
        }

        .message.lose {
            background: linear-gradient(45deg, #f44336, #e57373);
            color: white;
        }

        .message.info {
            background: linear-gradient(45deg, #2196f3, #64b5f6);
            color: white;
        }

        .reset-btn {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            margin-left: 15px;
        }

        @media (max-width: 600px) {
            .wheel-container {
                width: 250px;
                height: 250px;
            }
            
            .wheel {
                width: 250px;
                height: 250px;
            }
            
            .bet-options {
                gap: 10px;
            }
            
            .bet-item {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
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
  /* #spinWheelModal {
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
  } */



  .wheel-container {
    position: relative;
    width: 350px;
    height: 350px;
    margin: 0 auto;
  }

  .border-spin {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('./image/t.png');
    background-size: cover;
    background-position: center;
    border: none;
    z-index: 1;
  }

  .wheel {
    position: absolute;
    background-image: url('./image/inner-sw.png');
    background-size: cover;
    background-position: center;
    z-index: 0;

  }

  #popupOverlay {
    position: fixed;

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



  #wallet.win-flash {
    animation: walletFlash 3.5s ease-in-out;
    color: gold;
    text-shadow: 0 0 8px gold, 0 0 15px orange;
  }

  @media (max-width: 768px) {
    .wheel-container {
      width: 250px;
      height: 250px;
    }

  }



  /* 
  @media (max-width: 600px) {
    #spinWheelModal .popup {
    
      border-radius: 0;
  
      padding: 20px;
    
    } */

  /* .close-icon {
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
    
      height: 90vw;

    }

    #spinBtn,
    #closeModalBtn {
      width: 80%;
      margin: 15px auto 0 auto;
      font-size: 20px;
    } 

  } */

  .message {
    width: auto;
    min-width: 200px;
    max-width: 90vw;
    cursor: default;
  }
</style>

<body>
  <!-- Modal -->
  <div id="welcomeModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
    <div class="bg-gradient-to-b from-yellow-200 to-yellow-400 p-6 rounded-2xl shadow-2xl text-center max-w-sm w-full border-4 border-yellow-500 relative">

      <!-- Close Button -->
      <button onclick="closeModal()" class="absolute top-3 right-3 text-yellow-700 hover:text-red-500 text-2xl font-bold">&times;</button>

      <!-- Icon -->
      <img src="https://cdn-icons-png.flaticon.com/512/138/138281.png" class="w-16 h-16 mx-auto mb-4 animate-bounce" alt="Coin">

      <!-- Title -->
      <h2 class="text-2xl font-extrabold text-yellow-900 mb-2">🎉 Welcome <?php echo $playerName; ?>!</h2>

      <!-- Message -->
      <p class="text-lg text-yellow-800 mb-4">You’ve received <span class="font-bold">$100</span> free to play the game!</p>

      <!-- Button -->
      <button id="closeBtn" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition duration-300">
        Start Playing
      </button>
    </div>
  </div>


  </script>
  <div class="game-container max-w-7xl w-full mx-auto p-4 lg:px-[250px]">

    <div class="flex items-center gap-3 bg-gradient-to-r from-yellow-400 to-yellow-600 px-4 py-2 rounded-full shadow-lg border-2 border-yellow-300 w-[170px] mb-5 mx-auto md:mx-0">
      <img src="https://cdn-icons-png.flaticon.com/512/138/138281.png" alt="Coin" class="w-6 h-6 drop-shadow-md">
      <span class="text-xl font-bold text-white tracking-wide">
        <span id="wallet">100</span>
      </span>
    </div>

    <div class="wheel-container relative mx-auto mb-8">
      <div class="border-spin absolute inset-0 rounded-full border-8 border-yellow-400 animate-spin-slow"></div>
      <div id="wheel" class="wheel absolute inset-0"></div>
    </div>

    <div class="betting-section">
      <h3 class="text-xl font-semibold mb-4 text-center text-yellow-400">Choose Your Bet:</h3>
      <div class="bet-options grid grid-cols-2 gap-4 mb-6">
        <div class="bet-item apple cursor-pointer p-3 bg-red-100 rounded text-center hover:bg-red-200" data-item="apple" data-multiplier="1" data-betamount="100">
          🍎 Apple (1x) PAY $100
        </div>
        <div class="bet-item diamond cursor-pointer p-3 bg-blue-100 rounded text-center hover:bg-blue-200" data-item="diamond" data-multiplier="2" data-betamount="200">
          💎 Diamond (2x) PAY $300
        </div>
        <div class="bet-item star cursor-pointer p-3 bg-yellow-100 rounded text-center hover:bg-yellow-200" data-item="star" data-multiplier="3" data-betamount="300">
          ⭐ Star (3x) PAY $400
        </div>
        <div class="bet-item heart cursor-pointer p-3 bg-pink-100 rounded text-center hover:bg-pink-200" data-item="heart" data-multiplier="4" data-betamount="400">
          ❤️ Heart (4x) PAY $500
        </div>
        <div class="bet-item coin cursor-pointer p-3 bg-green-100 rounded text-center hover:bg-green-200 col-span-2" data-item="coin" data-multiplier="5" data-betamount="500">
          🪙 Coin (5x) PAY $600
        </div>
      </div>


      <!-- <div class="bet-amount mb-6 flex items-center justify-center space-x-2">
      <label for="betAmount" class="text-lg font-medium">Bet Amount: $</label>
      <input type="number" id="betAmount" min="10" max="500" value="50" step="10" class="w-20 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none">
    </div> -->

      <div class="text-center">
        <button id="spinBtn" onclick="spin()" class="spin-btn bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-3 px-8 rounded shadow transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
          SPIN THE WHEEL!
        </button>
      </div>
    </div>



  </div>

  <div id="message" class="message fixed bottom-0 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-6 py-3 rounded shadow-lg text-center text-lg font-semibold" style="display: none; z-index: 9999;"></div>
  <div id="popupOverlay" class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden">
    <div
      class="popup bg-gray-900 rounded-xl shadow-xl max-w-md w-full mx-4 p-8 text-white font-sans relative
           lg:w-[25%] md:w-[50%] max-h-[90vh] overflow-auto">
      <!-- Close Button (X) -->
      <button
        id="closePopup"
        aria-label="Close popup"
        class="absolute top-4 right-4 text-yellow-400 hover:text-yellow-500 focus:outline-none">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
      <!-- Registration Form -->
      <form id="registerForm" action="" method="POST" class="space-y-6">
        <div>
          <h5 class="text-xl font-bold text-yellow-400 text-center">Your balance is Enough</h5>
          <p class="text-sm font-bold text-yellow-400 text-center">Deposit to play game please contact us!</p>

        </div>

        <!-- <div>
        <input
          type="text"
          id="name"
          name="name"
          required
          placeholder="Username"
          class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
        />
      </div>

      <div>
        <input
          type="text"
          name="phone"
          required
          placeholder="Phone"
          class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
        />
      </div>

          <div>
        <input
          type="email"
          name="gmail"
          required
          placeholder="Email"
          class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
        />
      </div>
      <button
        type="submit"
        class="w-full bg-yellow-400 text-gray-900 font-semibold py-3 rounded-lg hover:bg-yellow-500 transition"
      >
        Login
      </button>
      <p class="text-sm">Do not have an account? <a href="#" class="text-yellow-400 hover:text-yellow-500 transition">Sign up </a> </p> -->
      </form>
    </div>
  </div>


  <?php
  $secretBase64 = 'WW91clNlY3JldEtleUhlcmU=';
  $encodedKey = base64_encode($secretBase64);
  ?>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    function showMessage(text, type = 'info', duration = 3000) {
      Swal.fire({
        toast: true,
        position: 'bottom',
        title: text,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        showClass: {
          popup: 'swal2-show swal2-slide-in-bottom'
        },
        hideClass: {
          popup: 'swal2-hide swal2-slide-out-bottom'
        }
      });
    }

    function hideMessage() {
      Swal.close();
    }
    const popupOverlay = $("#popupOverlay");
    const popupMessage = $("#popupMessage");
    const closePopupBtn = $("#closePopup");
    let wallet = 100;
    let selectedBet = null;
    let selectedMultiplier = 2;
    let selectedBetAmount = 0;
    let isSpinning = false;

    const items = ['apple', 'diamond', 'star', 'heart', 'coin', 'crown'];

    const itemNames = {
      'apple': 'Apple',
      'diamond': 'Diamond',
      'star': 'Star',
      'heart': 'Heart',
      'coin': 'Coin',
      'crown': 'Crown'
    };

    const itemEmojis = {
      'apple': '🍎',
      'diamond': '💎',
      'star': '⭐',
      'heart': '❤️',
      'coin': '🪙',
      'crown': '👑'
    };

    function showModal() {
      $("#welcomeModal").removeClass("hidden").hide().fadeIn(300);
    }

    function closeModal() {
      $("#welcomeModal").fadeOut(200);
    }

    $(window).on("load", function() {
      if (wallet != 0) {
        setTimeout(showModal, 250);
      }
    });


    // Close when Start Playing button clicked
    $(document).on("click", "#closeBtn", function() {
      closeModal();
    });

    // Close when X icon clicked
    $(document).on("click", ".absolute.top-3.right-3", function() {
      closeModal();
    });

    const parts = [
      <?php
      $split = str_split($encodedKey, 4);
      echo '"' . implode('","', $split) . '"';
      ?>
    ];

    function getSecretKey() {
      const combined = parts.join('');
      return atob(combined);
    }

    const secretKey = getSecretKey();

    function encodeData(obj) {
      const json = JSON.stringify(obj);
      let xorData = json
        .split('')
        .map((char, i) => String.fromCharCode(char.charCodeAt(0) ^ secretKey.charCodeAt(i % secretKey.length)))
        .join('');
      return btoa(xorData);
    }

    function decodeData(encoded) {
      let xorData = atob(encoded);
      let json = xorData
        .split('')
        .map((char, i) => String.fromCharCode(char.charCodeAt(0) ^ secretKey.charCodeAt(i % secretKey.length)))
        .join('');
      return JSON.parse(json);
    }

    function saveSession() {
      try {
        const sessionData = {
          wallet: wallet,
          lastPlayed: Date.now()
        };
        localStorage.setItem('swg_data', encodeData(sessionData));
      } catch (e) {
        console.log('Session storage not available');
      }
    }

    function loadSession() {
      try {
        const savedData = localStorage.getItem('swg_data');
        if (savedData) {
          const sessionData = decodeData(savedData);
          if (typeof sessionData.wallet === "number") {
            wallet = sessionData.wallet;
          } else {
            wallet = 100;
          }
          return true;
        }
        wallet = 100;
        return false;
      } catch (e) {
        console.log('Session storage not available or corrupt');
        wallet = 100;
        return false;
      }
    }

    function updateWalletDisplay() {
      $('#wallet').text(wallet);
      saveSession();
    }

    // Initialize game
    $(document).ready(function() {
      loadSession();
      updateWalletDisplay();

      $('#closePopup').click(() => {
        popupOverlay.fadeOut(300);
      });

      $(document).on('click', '.bet-item', function() {
        if (isSpinning) return;

        $('.bet-item').removeClass('selected');
        $(this).addClass('selected');

        selectedBet = $(this).data('item');
        selectedMultiplier = $(this).data('multiplier');
        selectedBetAmount = parseInt($(this).data('betamount')) || 0;
        hideMessage();
        $('#selectedBetInfo').text(`Betting $${selectedBetAmount} on ${selectedBet.charAt(0).toUpperCase() + selectedBet.slice(1)}`);
      });

    });

    let currentRotation = 0;

    function spin() {
      if (isSpinning) return;

      if (!selectedBet) {
        showMessage('Please select an item to bet on!', 'info');
        return;
      }
      if (selectedBetAmount > wallet) {
        popupOverlay.removeClass("hidden").hide().fadeIn(300);
        return;
      }
      if (selectedBetAmount < 10) {
        showMessage('Minimum bet is $10!', 'info');
        return;
      }

      isSpinning = true;
      $('#spinBtn').prop('disabled', true).text('SPINNING...');
      hideMessage();

      wallet -= selectedBetAmount;
      updateWalletDisplay();

      const result = Math.floor(Math.random() * items.length);
      const resultItem = items[result];

      const degreesPerSlice = 360 / items.length;
      const stopAngle = result * degreesPerSlice + (Math.random() * 8 - 4);

      const extraRotations = (5 + Math.floor(Math.random() * 2)) * 360;
      const spinDuration = (4 + Math.random() * 2).toFixed(2);
      const targetRotation = currentRotation + extraRotations + stopAngle;

      $('#wheel').css({
        'transition': `transform ${spinDuration}s cubic-bezier(0.17, 0.67, 0.36, 1.02)`,
        'transform': `rotate(${targetRotation}deg)`
      });

      currentRotation = targetRotation % 360;

      setTimeout(() => {
        if (resultItem === selectedBet) {
          const winnings = selectedBetAmount * selectedMultiplier;
          wallet += winnings;
          updateWalletDisplay();

          confetti({
            particleCount: 150,
            spread: 70,
            origin: {
              y: 0.6
            }
          });

          $('#wallet').addClass('win-flash');
          setTimeout(() => $('#wallet').removeClass('win-flash'), 3000);

          Swal.fire({
            title: '🎉 Surprise! 🎉',
            text: `You won ${winnings} coins! ${itemEmojis[resultItem]} ${itemNames[resultItem]}`,
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: '#fffbe6',
            customClass: {
              popup: 'swal2-shadow'
            }
          });

        } else {
          showMessage(`😔 Lost ${selectedBetAmount}. Result was ${itemEmojis[resultItem]} ${itemNames[resultItem]}`, 'lose');
        }

        saveSession();
        isSpinning = false;
        $('#spinBtn').prop('disabled', false).text('SPIN THE WHEEL!');

        if (wallet < 10) {
          popupOverlay.fadeIn(400);
        }
      }, spinDuration * 1000 + 100);

      $('#wheel').css({
        'transition': 'none',
        'transform': `rotate(${currentRotation}deg)`
      });

      setTimeout(() => {
        const degreesPerSlice = 360 / items.length;
        const stopAngle = result * degreesPerSlice + (Math.random() * 8 - 4);
        const extraRotations = (5 + Math.floor(Math.random() * 2)) * 360;
        const spinDuration = (4 + Math.random() * 2).toFixed(2);
        const targetRotation = currentRotation + extraRotations + stopAngle;

        $('#wheel').css({
          'transition': `transform ${spinDuration}s cubic-bezier(0.17, 0.67, 0.36, 1.02)`,
          'transform': `rotate(${targetRotation}deg)`
        });

        currentRotation = targetRotation % 360;
      }, 20);
    }
  </script>

  <style>
    /* Example flash effect for wallet on win */
    .win-flash {
      animation: flash 4.5s ease-in-out;
    }

    @keyframes flash {

      0%,
      100% {
        background-color: transparent;
      }

      50% {
        background-color: #ffff99;
      }
    }

    /* Selected bet highlight */
    .bet-item.selected {
      box-shadow: 0 0 10px 3px gold;
      border-radius: 8px;
    }
  </style>

</body>

</html>