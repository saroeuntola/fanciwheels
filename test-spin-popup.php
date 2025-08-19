<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Spin Wheel</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/zarocknz/javascript-winwheel@2.7.0/Winwheel.min.js"></script>
<style>
/* Modal & popup styles */
.popup { position: relative; text-align:center; }
.close-icon { position:absolute; top:15px; right:15px; background:transparent; border:none; cursor:pointer; padding:0; line-height:0; color:#333; transition:color 0.3s; }
.close-icon:hover { color:#f00; }
#spinWheelModal { position:fixed; top:0; left:0; width:100%; height:100%; z-index:999; display:flex; align-items:center; justify-content:center; background-color:rgba(0,0,0,0.5); }
.popup { background-image:url('image/bg-image.jpg'); padding:70px; border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,0.4); font-size:20px; }
.wheel-container { position:relative; width:300px; height:300px; margin:0 auto; }
.border-spin { position:absolute; width:100%; height:100%; background-image:url('image/t.png'); background-size:cover; z-index:1; }
#wheel { position:absolute; top:0; left:0; z-index:2; }
#spinCountDisplay { margin-top:100px; margin-bottom:10px; font-weight:bold; color:white; }
#spinBtn { padding:12px 30px; font-size:18px; width:100%; cursor:pointer; background-color:#E3DC24; color:#333; font-weight:bold; border:none; border-radius:25px; margin-top:15px; }
#spinBtn:hover { background-color:#1400AD; color:white; transition:500ms; }
#popupOverlay { position:fixed; top:0; left:0; width:100%; height:100%; z-index:1000; display:none; align-items:center; justify-content:center; }
#popupOverlay .popup { background:black; padding:30px; border-radius:10px; max-width:90%; text-align:center; font-size:20px; }
#popupOverlay .popup button { margin-top:20px; padding:10px 20px; font-size:16px; }

/* Responsive */
@media (max-width:600px){
    #spinWheelModal .popup { border-radius:0; padding:20px; }
    .wheel-container { width:90vw; height:90vw; }
    #spinBtn { width:80%; margin:15px auto 0; font-size:20px; }
}
</style>
</head>
<body>

<!-- Spin Wheel Modal -->
<div id="spinWheelModal">
  <div class="popup">
    <div class="wheel-container">
      <div class="border-spin"></div>
      <canvas id="wheel" width="300" height="300"></canvas>
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
<div id="popupOverlay" class="flex items-center justify-center">
  <div class="popup">
    <button id="closePopup" aria-label="Close popup" class="close-icon">X</button>
    <p id="popupMessage"></p>
  </div>
</div>

<script>
// Config
const segmentNumbers = ["Blue", "Orange", "Yellow", "Purple", "Pink", "Green", "$700"];
const segmentColors = ["#3498db","#e67e22","#f1c40f","#9b59b6","#ff69b4","#2ecc71","#f39c12"];
let spinCount = 0;
const maxSpins = 1;
const lang = "en";
const translations = { en:{freeSpin:"Free Spin", winMessage:"🎉 You won"}, bn:{freeSpin:"ফ্রি স্পিন", winMessage:"🎉 আপনি জিতেছেন"} };

// Update spin display
function updateSpinCountDisplay() { $("#spinCountDisplay").text(`${translations[lang].freeSpin}: ${spinCount}/${maxSpins}`); }
updateSpinCountDisplay();

// Create Winwheel
let theWheel = new Winwheel({
  'canvasId':'wheel',
  'numSegments':segmentNumbers.length,
  'outerRadius':140,
  'segments':segmentNumbers.map((text,i)=>({fillStyle:segmentColors[i], text:text})),
  'animation':{
    'type':'spinToStop',
    'duration':8,
    'spins':3,
    'callbackFinished':function(wheel){
      const winningSegment = wheel.getIndicatedSegment();
      spinBtn.disabled = false;
      $("#popupMessage").text(`${translations[lang].winMessage} ${winningSegment.text}!`);
      $("#popupOverlay").hide().css("display","flex").hide().slideDown(400);
    }
  }
});

// Spin button
const spinBtn = document.getElementById("spinBtn");
spinBtn.addEventListener("click",()=>{
  if(spinCount >= maxSpins){
    $("#popupOverlay").hide().css("display","flex").hide().slideDown(400);
    spinBtn.disabled=true;
    return;
  }
  spinCount++;
  updateSpinCountDisplay();
  spinBtn.disabled=true;
  theWheel.startAnimation();
});

// Close modal
document.getElementById("closeModalBtn").addEventListener("click",()=>{document.getElementById("spinWheelModal").style.display="none";});
$("#closePopup").on("click",()=>$("#popupOverlay").slideUp(400));
</script>

</body>
</html>
