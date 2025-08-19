<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<style>

  .iti__country-list{
    width: 300px;
  }
  .iti__selected-dial-code{
    color: whitesmoke;
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
    background-color: #F54927;
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
  margin-bottom: 30px;
  color: #333;
  font-size: 15px;
  
}
  #spinBtn {
    padding: 12px 30px;
    font-size: 18px;
    width: 100%;
    cursor: pointer;
    background-color:#E3DC24;
    border-radius: 25px;
    margin-top: 80px;
    color: #333;
    font-weight: bold;
  }

  /* Result Modal */
  #popupOverlay{
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
  margin-top: 30px;
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
  
<div class="fixed bg-black w-full bg-opacity-70 flex items-center justify-center mx-auto h-full">
  
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



</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
const phoneInput = document.querySelector("#phone");;

// First phone input
const iti = window.intlTelInput(phoneInput, {
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

</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>