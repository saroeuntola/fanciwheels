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
            body: new URLSearchParams({
                name,
                gmail,
                phone
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
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
            Swal.fire({
                icon: "error",
                title: "Registration Failed",
                text: data.message || "Failed to register."
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Server Error",
            text: "An error occurred during registration."
        });
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
    const phone1 = formData.get("phone1").trim();

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
            body: new URLSearchParams({
                name,
                gmail,
                phone1
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
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
            Swal.fire({
                icon: "error",
                title: "Registration Failed",
                text: data.message || "Failed to register."
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Server Error",
            text: "An error occurred during registration."
        });
        console.error(error);
    }
});