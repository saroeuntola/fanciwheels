<?php
$lang = isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'bn']) ? $_GET['lang'] : 'bn';
?>

<!-- AUTH MODAL -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 pointer-events-none z-50 transition-opacity duration-500">
  <div class="bg-gray-800 p-8 rounded-2xl w-full max-w-md relative transform scale-95 transition-all duration-500">
    <button class="absolute top-4 right-4 text-white text-2xl closeAuthModal">&times;</button>

    <!-- REGISTER FORM -->
    <form id="registerAuth">
      <h1 class="text-white text-center text-2xl mb-2"><?= $lang === 'en' ? 'Sign Up' : 'নিবন্ধন করুন' ?></h1>
      <p class="text-white text-center mb-4"><?= $lang === 'en' ? 'Create New account' : 'নতুন অ্যাকাউন্ট তৈরি করুন' ?> </p>


      <div class="relative">
        <input type="text" name="username" placeholder=" <?= $lang === 'en' ? 'Username' : 'ব্যবহারকারীর নাম' ?>" class="w-full p-3 mb-1 bg-white/10 ">
        <p class="server-error text-red-500 text-sm mb-2"></p>
        <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
          <i class="fa-solid fa-user"></i>
        </span>
      </div>


      <div class="relative">
        <input type="email" name="email" placeholder="<?= $lang === 'en' ? 'Email' : 'ইমেইল' ?>" class="w-full p-3 mb-1 bg-white/10 ">
        <p class="server-error text-red-500 text-sm mb-2"></p>
        <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
          <i class="fa-solid fa-envelope"></i>
        </span>
      </div>

      <div class="relative mb-3">
        <input
          type="password"
          name="password"
          id="passwordInput"
          class="w-full p-3 bg-white/10"
          placeholder="<?= $lang === 'en' ? 'Password' : 'পাসওয়ার্ড' ?>"
          <p class="server-error text-red-500 text-sm mb-2"></p>
        <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 top-4 flex items-center text-gray-400">
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.06-3.473M6.35 6.35A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.612 2.733M3 3l18 18" />
          </svg>
        </button>
      </div>

      <!-- Phone + Country -->
      <div class=" relative">
        <div class="flex items-center mb-4">
          <div id="countryDropdown" class="relative w-36">
            <button type="button" id="countryDropdownBtn"
              class="w-full bg-white/10  text-white border border-white/20 rounded-l-lg py-3 px-4 flex items-center justify-between">
              <img id="selectedFlag" src="./image/flag/bn.svg" alt="Flag" class="w-5 h-5 mr-2">
              <span id="selectedCode">+880</span>
              <i class="fa fa-chevron-down ml-1 text-sm"></i>
            </button>
            <ul id="countryOptions" class="absolute left-0 top-full w-full bg-gray-800 border border-white/20 rounded-lg mt-1 hidden z-50">
              <li class="flex items-center px-3 py-2 cursor-pointer" data-code="+880" data-flag="./image/flag/bn.svg">
                <img src="./image/flag/bn.svg" class="w-5 h-5 mr-2"> +880
              </li>
              <li class="flex items-center px-3 py-2 cursor-pointer" data-code="+91" data-flag="./image/flag/in.svg">
                <img src="./image/flag/in.svg" class="w-5 h-5 mr-2"> +91
              </li>
              <li class="flex items-center px-3 py-2 cursor-pointer" data-code="+65" data-flag="./image/flag/ido.svg">
                <img src="./image/flag/ido.svg" class="w-5 h-5 mr-2"> +65
              </li>
              <li class="flex items-center px-3 py-2 cursor-pointer" data-code="+60" data-flag="./image/flag/ml.svg">
                <img src="./image/flag/ml.svg" class="w-5 h-5 mr-2"> +60
              </li>
              <li class="flex items-center px-3 py-2 cursor-pointer" data-code="+84" data-flag="./image/flag/vn.svg">
                <img src="./image/flag/vn.svg" class="w-5 h-5 mr-2"> +84
              </li>
            </ul>
          </div>
          <input type="tel" id="phone-number" name="phone"
            placeholder="<?= $lang === 'en' ? 'Phone Number' : 'ফোন নম্বর' ?>"
            class="flex-1 p-3 border w-full border-white/20 rounded-r-lg bg-white/10 ">

        </div>

        <p class="server-error text-red-500 text-sm mb-2"></p>
        <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
          <i class="fa-solid fa-phone"></i>
        </span>
      </div>
      <!-- Terms / Over 18 -->
      <div class="flex items-center mb-2">
        <input type="checkbox" id="acceptTerms" class="mr-2">
        <label for="acceptTerms" class="text-white text-sm"><?= $lang === 'en' ? 'I accept the Terms & Conditions and I am over 18 ' : 'আমি নিয়ম ও শর্তাবলী মেনে নিচ্ছি এবং আমার বয়স ১৮ বছরের বেশি।' ?></label>
      </div>
      <p class="server-error text-red-500 text-sm mb-2" id="termsError"></p>

      <input type="hidden" name="role_id" id="role_id" value="<?= base64_encode(2) ?>">
      <input type="hidden" id="countryCodeInput" value="+880">

      <button type="submit" class="w-full p-3 bg-blue-600 text-white mt-4 mb-4"><?= $lang === 'en' ? 'Sign Up' : 'নিবন্ধন করুন' ?></button>
      <p class="text-white text-center mt-2"><?= $lang === 'en' ? 'Already have an account?' : 'ইতিমধ্যে একটি অ্যাকাউন্ট আছে?' ?>
        <span id="switchToLogin" class="cursor-pointer text-blue-400 underline"><?= $lang === 'en' ? 'Sign In' : 'লগ ইন' ?></span>
      </p>
    </form>

    <!-- LOGIN FORM -->
    <form id="loginAuth" class="hidden">
      <h1 class="text-white text-center text-2xl mb-2"><?= $lang === 'en' ? 'Sign In' : 'লগ ইন' ?></h1>
      <p class="text-white text-center mb-4"><?= $lang === 'en' ? 'Enter your username and password' : 'আপনার ব্যবহারকারীর নাম এবং পাসওয়ার্ড লিখুন' ?></p>


      <div class="relative">
        <input type="text" name="username" placeholder="<?= $lang === 'en' ? 'Username' : 'ব্যবহারকারীর নাম' ?>" class="w-full p-3 mb-1 bg-white/10 ">
        <p class="login-error text-red-500 text-sm mb-2"></p>
        <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
          <i class="fa-solid fa-user"></i>
        </span>
      </div>


      <div class="relative">
        <input type="password" name="password" placeholder="<?= $lang === 'en' ? 'Password' : 'পাসওয়ার্ড' ?>" class="w-full p-3 mb-1 bg-white/10 ">
        <p class="login-error text-red-500 text-sm mb-2"></p>
        <span class="absolute inset-y-0 right-4 top-4 flex items-center text-gray-400">
          <i class="fa-solid fa-lock"></i>
        </span>

      </div>


      <!-- Remember Me -->
      <div class="flex items-center mb-2">
        <input type="checkbox" name="remember" id="rememberMe" class="mr-2">
        <label for="rememberMe" class="text-white text-sm"><?= $lang === 'en' ? 'Remember me' : 'আমাকে মনে রেখো' ?></label>
      </div>

      <button type="submit" class="w-full p-3 bg-blue-600 text-white mt-2 mb-4"><?= $lang === 'en' ? 'Sign In' : 'লগ ইন' ?></button>
      <p class="text-white text-center mt-2"><?= $lang === 'en' ? "Don't have an account?" : 'কোন অ্যাকাউন্ট নেই?' ?>
        <span id="switchToRegister" class="cursor-pointer text-blue-400 underline"><?= $lang === 'en' ? 'Sign Up' : 'নিবন্ধন করুন' ?></span>
      </p>
    </form>
  </div>
</div>
<?php
include './config/baseURL.php';
?>

<link rel="stylesheet" href="./dist/css/all.min.css" />
<script src="./js/all.min.js"></script>
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/toastr.min.js"></script>
<link rel="stylesheet" href="./dist/css/toastr.min.css">
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    togglePassword.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        passwordInput.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    document.getElementById("phone-number").addEventListener("input", function(e) {
      this.value = this.value.replace(/[^0-9+]/g, "");
      if (this.value.indexOf('+') > 0) {
        this.value = this.value.replace(/\+/g, "");
      }
    });
    $("#countryDropdownBtn").click((e) => {
      e.stopPropagation();
      $("#countryOptions").toggle();
    });

    // Select a country
    $("#countryOptions li").click(function() {
      const code = $(this).data("code");
      const flag = $(this).data("flag");

      $("#selectedCode").text(code);
      $("#selectedFlag").attr("src", flag);

      // Set hidden input for form submission / AJAX
      if ($("#countryCodeInput").length === 0) {
        $("<input>")
          .attr({
            type: "hidden",
            id: "countryCodeInput",
            name: "countryCode",
            value: code,
          })
          .appendTo("#registerAuth");
      } else {
        $("#countryCodeInput").val(code);
      }

      $("#countryOptions").hide();
    });

    // Hide dropdown if clicked outside
    $(document).click(() => $("#countryOptions").hide());
  });

  $(document).ready(function() {

    function openAuthModal() {
      const modal = $("#authModal");
      const modalContent = $("#authModal > div");

      modal.removeClass("opacity-0 pointer-events-none");
      modalContent.removeClass("scale-95").addClass("scale-100");
    }

    function closeAuthModal() {
      const modal = $("#authModal");
      const modalContent = $("#authModal > div");

      modalContent.removeClass("scale-100").addClass("scale-95");
      modal.addClass("opacity-0 pointer-events-none");
    }

    $(".openAuthModal").click(openAuthModal);

    $(".closeAuthModal").click(closeAuthModal);

    $("#authModal").click(function(e) {
      if (e.target === this) closeAuthModal();
    });

    $("#switchToRegister").click(() => {
      $("#loginAuth").fadeOut(300, () => $("#registerAuth").fadeIn(300));
    });

    $("#switchToLogin").click(() => {
      $("#registerAuth").fadeOut(300, () => $("#loginAuth").fadeIn(300));
    });

    const API_URL = "<?= $apiBaseURL ?>validate-check";
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-center",
      timeOut: "4000",
      extendedTimeOut: "1000",
      preventDuplicates: true,
      showDuration: "300",
      hideDuration: "300",
      showMethod: "fadeIn",
      hideMethod: "fadeOut",
    };

    const lang = "<?= $lang ?>";
    // === LIVE CHECK ===
    function liveCheck(field, value, $err) {
      $.post(
        API_URL, {
          field,
          value,
          lang,
        },
        function(data) {
          const res = JSON.parse(data);
          $err.text(res.status ? res.message : "");
        }
      );
    }

    $('input[name="username"], input[name="email"]').on(
      "keyup blur",
      function() {
        const $err = $(this).next(".server-error");
        if ($(this).val().trim() !== "")
          liveCheck($(this).attr("name"), $(this).val(), $err);
      }
    );

    $("#phone-number").on("keyup blur", function() {
      const $err = $(this).next(".server-error");
      const val = $("#countryCodeInput").val() + $(this).val().trim();
      if ($(this).val().trim() !== "") liveCheck("phone", val, $err);
    });

    // === REGISTER AJAX ===
    $("#registerAuth").submit(function(e) {
      e.preventDefault();
      $(".server-error").text("");
      $("#termsError").text("");

      let valid = true;

      const username = $('input[name="username"]').val().trim();
      const email = $('input[name="email"]').val().trim();
      const password = $('input[name="password"]').val().trim();
      const phone =
        $("#countryCodeInput").val() + $("#phone-number").val().trim();
      const role_id = $("#role_id").val();
      const accepted = $("#acceptTerms").is(":checked");

      const messages = {
        en: {
          username: "Username required",
          email: "Email required",
          password: "Password required",
          phone: "Phone required",
          terms: "You must accept the Terms & Conditions and be over 18 to register",
        },
        bn: {
          username: "ইউজারনেম প্রয়োজন",
          email: "ইমেল প্রয়োজন",
          password: "পাসওয়ার্ড প্রয়োজন",
          phone: "ফোন নম্বর প্রয়োজন",
          terms: "আপনাকে শর্তাবলী মেনে নিতে হবে এবং নিবন্ধনের জন্য আপনার বয়স ১৮ বছরের বেশি হতে হবে",
        },
      };
      if (!username) {
        $('input[name="username"]')
          .next(".server-error")
          .text(messages[lang].username);
        valid = false;
      }
      if (!email) {
        $('input[name="email"]').next(".server-error").text(messages[lang].email);
        valid = false;
      }
      if (!password) {
        $('input[name="password"]')
          .next(".server-error")
          .text(messages[lang].password);
        valid = false;
      }
      if (!phone) {
        $("#phone-number").next(".server-error").text(messages[lang].phone);
        valid = false;
      }
      if (!accepted) {
        $("#termsError").text(messages[lang].terms);
        valid = false;
      }

      if (!valid) return;

      $.post("register-auth", {
          username,
          email,
          password,
          phone,
          role_id,
        })
        .done(() => {
          $("#registerAuth")[0].reset(); // clear fields
          $("#registerAuth").fadeOut(300, () => {
            $("#loginAuth").fadeIn(300);
          });
          toastr.success("Registration successful! Please login.");
        })

        .fail((xhr) => alert("Registration failed: " + xhr.responseText));
    });

    // === LOGIN AJAX ===
    $("#loginAuth").submit(function(e) {
      e.preventDefault();
      $(".login-error").text("");
      const username = $(this).find('input[name="username"]').val().trim();
      const password = $(this).find('input[name="password"]').val().trim();
      const remember = $(this).find('input[name="remember"]').is(":checked");
      const loginMessage = {
        en: {
          username: "Username required",
          password: "Password required",
        },
        bn: {
          username: "ইউজারনেম প্রয়োজন",
          password: "পাসওয়ার্ড প্রয়োজন",
        },
      };
      if (!username) {
        $(this)
          .find('input[name="username"]')
          .next(".login-error")
          .text(loginMessage[lang].username);
        return;
      }
      if (!password) {
        $(this)
          .find('input[name="password"]')
          .next(".login-error")
          .text(loginMessage[lang].password);
        return;
      }

      $.post(
        "login-auth", {
          username,
          password,
          remember,
        },
        function(res) {
          if (res.status) {
            toastr.success("Login successful.");
            window.location.href = res.redirect;
          } else {
            $("#loginAuth").find(".login-error").first().text(res.message);
          }
        }
      ).fail((xhr) => alert("Login failed: " + xhr.responseText));
    });
  });
</script>