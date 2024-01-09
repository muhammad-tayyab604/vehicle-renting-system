let hamburger = document.querySelector("#icon1");
let navbar = document.querySelector(".navbar");
let profileIcon = document.querySelector(".profile");
let links = document.querySelector(".links");

hamburger.onclick = () => {
    hamburger.classList.toggle("fa-xmark");
    navbar.classList.toggle("active");
};

window.onscroll = () => {
    hamburger.classList.remove("fa-xmark");
    navbar.classList.remove("active");
};

// View profllie links
profileIcon.onclick = () => {
    links.classList.toggle("activeLink");
};
window.onscroll = () => {
    links.classList.remove("activeLink");
};
// End View profllie links

const sr = ScrollReveal({
    distance: "60px",
    duration: 2500,
    delay: 400,
    reset: true,
});

sr.reveal(".text", { delay: 200, origin: "top" });
sr.reveal(".heading", { delay: 200, origin: "top" });
sr.reveal(".container-ride .box", { delay: 200, origin: "left" });
sr.reveal(".services-container .box", { delay: 200, origin: "right" });
sr.reveal(".about-container", { delay: 200, origin: "bottom" });
sr.reveal(".regform", { delay: 200, origin: "bottom" });
sr.reveal(".newsletter", { delay: 200, origin: "bottom" });

// Delete Account Pop-Up Logic
document.addEventListener("DOMContentLoaded", function () {
    const deleteAccountForm = document.getElementById("deleteAccountForm");

    const deleteButton = document.querySelector(".delete-button");

    deleteButton.addEventListener("click", function (event) {
        event.preventDefault();

        const confirmDelete = confirm(
            "Are you sure you want to delete your account? This action cannot be undone."
        );

        if (confirmDelete) {
            deleteAccountForm.submit();
        }
    });
});

// Scroll main images like vehicle images
document.addEventListener("DOMContentLoaded", function () {
    const prevButton = document.getElementById("prev-button");
    const nextButton = document.getElementById("next-button");
    const vehicleCarousel = document.querySelector(".vehicle-carousel");
    const vehicleSlides = document.querySelectorAll(".vehicle-slide");

    let currentIndex = 0;

    function updateCarousel() {
        vehicleCarousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    nextButton.addEventListener("click", function () {
        currentIndex = (currentIndex + 1) % vehicleSlides.length;
        updateCarousel();
    });

    prevButton.addEventListener("click", function () {
        currentIndex = (currentIndex - 1 + vehicleSlides.length) % vehicleSlides.length;
        updateCarousel();
    });
});


console.log("Hi");
