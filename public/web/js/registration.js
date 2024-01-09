// Get the CNIC input field
const cnicInput = document.getElementById("cnic");

// Add an event listener for the input event
cnicInput.addEventListener("input", function (event) {
    // Remove any non-numeric characters
    const cnicValue = event.target.value.replace(/[^0-9]/g, "");

    // Format the CNIC number as (12345-6789011-1)
    if (cnicValue.length > 5) {
        event.target.value =
            cnicValue.slice(0, 5) +
            "-" +
            cnicValue.slice(5, 12) +
            "-" +
            cnicValue.slice(12, 13);
    } else if (cnicValue.length > 12) {
        event.target.value =
            cnicValue.slice(0, 5) +
            "-" +
            cnicValue.slice(5, 12) +
            "-" +
            cnicValue.slice(12, 13);
    } else if (cnicValue.length > 5) {
        event.target.value =
            cnicValue.slice(0, 5) + "-" + cnicValue.slice(5, 12);
    } else {
        event.target.value = cnicValue;
    }

    // Limit the value to 15 characters
    const maxLength = 15;
    const truncatedValue = event.target.value.slice(0, maxLength);

    // Set the modified value back to the input field
    event.target.value = truncatedValue;
});

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.querySelector(
        `[onclick="togglePassword('${inputId}')"]`
    );

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
