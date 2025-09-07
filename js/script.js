const API_BASE = window.APP_CONFIG?.API_URL || "";

// Phone inputs
const phoneInput = document.querySelector("#phone");
const phoneInput1 = document.querySelector("#phone1");

// Initialize intl-tel-input
const iti = window.intlTelInput(phoneInput, {
  initialCountry: "bd",
  preferredCountries: ["bd", "in", "vn", "cn"],
  separateDialCode: true,
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
});

const iti1 = window.intlTelInput(phoneInput1, {
  initialCountry: "bd",
  preferredCountries: ["bd", "in", "vn", "cn"],
  separateDialCode: true,
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
});

// Helper: show/hide error for an input
function showError(input, errorId) {
  const errorEl = document.getElementById(errorId);
  input.classList.add("border-2", "border-red-500");
  errorEl.classList.remove("hidden");
}

function hideError(input, errorId) {
  const errorEl = document.getElementById(errorId);
  input.classList.remove("border-2", "border-red-500");
  errorEl.classList.add("hidden");
}

// Validate single input
function validateInput(input, errorId) {
  if (!input.value.trim()) {
    showError(input, errorId);
    return false;
  } else {
    hideError(input, errorId);
    return true;
  }
}

// Validate entire form
function validateForm(
  formId,
  phoneId,
  nameErrorId,
  emailErrorId,
  phoneErrorId,
  itiInstance
) {
  const form = document.querySelector(formId);
  const nameInput = form.querySelector('input[name="name"]');
  const emailInput = form.querySelector('input[name="gmail"]');
  const phoneInput = form.querySelector(`#${phoneId}`);

  // Set full intl phone number
  phoneInput.value = itiInstance.getNumber();

  const validName = validateInput(nameInput, nameErrorId);
  const validEmail = validateInput(emailInput, emailErrorId);
  const validPhone = validateInput(phoneInput, phoneErrorId);

  return validName && validEmail && validPhone;
}

// Handle form submit
function handleFormSubmit(
  formId,
  phoneId,
  nameErrorId,
  emailErrorId,
  phoneErrorId,
  itiInstance
) {
  const form = document.querySelector(formId);

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (
      !validateForm(
        formId,
        phoneId,
        nameErrorId,
        emailErrorId,
        phoneErrorId,
        itiInstance
      )
    ) {
      toastr.warning(
        "Please fill in all required fields.",
        "Missing Information"
      );
      return;
    }
toastr.options = {
  closeButton: true,
  progressBar: true, 
  positionClass: "toast-top-center", 
  timeOut: "5000", 
  extendedTimeOut: "1000",
  preventDuplicates: true,
  showDuration: "300",
  hideDuration: "300",
  showMethod: "fadeIn",
  hideMethod: "fadeOut",
};
    const formData = new FormData(form);
    const name = formData.get("name").trim();
    const email = formData.get("gmail").trim();
    const phone = formData.get("phone").trim();

    try {
      const response = await fetch(API_BASE + "create_player", {
        method: "POST",
        body: new URLSearchParams({ name, gmail: email, phone }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      });

      const data = await response.json();
      if (data.success) {
        toastr.success(
          "Our customer will contact you soon.",
          "Registration Successful"
        );
        form.reset();
        setTimeout(() => {
          if (formId === "#registerForm") {
            popupOverlay.slideUp(400);
          } else if (formId === "#registerForm1") {
            popupOverlay1.slideUp(400);
          }
          
        }, 500);
      } else {
        toastr.error(
          data.message || "Failed to register.",
          "Registration Failed"
        );
      }
    } catch (err) {
      toastr.error("Server error occurred.", "Error");
      console.error(err);
    }
  });
}

// Initialize forms
handleFormSubmit(
  "#registerForm",
  "phone",
  "nameError1",
  "emailError1",
  "phoneError1",
  iti
);
handleFormSubmit(
  "#registerForm1",
  "phone1",
  "nameError2",
  "emailError2",
  "phoneError2",
  iti1
);
