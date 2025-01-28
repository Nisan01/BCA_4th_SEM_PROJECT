document.addEventListener("DOMContentLoaded", function() {
    const menuIcon = document.getElementById("menu-icon");
    if (menuIcon) {
        menuIcon.addEventListener("click", function() {
            const ulLinks = document.querySelector(".ul-link");
            ulLinks.classList.toggle("show");
        });
    }
});


// Cartbar Toggle
const cartbar = document.querySelector('.cart-container');
const closebtn = document.getElementById('closeSidebar');
const togglebtn = document.getElementById('toggleCartbar');

if (togglebtn && cartbar) {
    togglebtn.addEventListener('click', () => {
        cartbar.style.right = '0';
    });
}

if (closebtn && cartbar) {
    closebtn.addEventListener('click', () => {
        cartbar.style.right = '-300px';
    });
}

// Profile Dashboard Toggle
const profileCon = document.getElementById('profile-con');
if (profileCon) {
    profileCon.addEventListener('click', () => {
        const profileDash = document.getElementById('profile-dash');
        if (profileDash) {
            profileDash.classList.toggle('show');
        }
    });
}

// Profile Image Change Toggle
const profileImageContainer = document.getElementById('profile-image-container');
if (profileImageContainer) {
    profileImageContainer.addEventListener('click', () => {
        const profileChange = document.getElementById('profile-change');
        if (profileChange) {
            profileChange.classList.toggle('show');
        }
    });
}

// GSAP Animations
gsap.from("nav li a", {
    y: -20,
    opacity: 0,
    duration: 0.8,
    delay: 0.2,
    stagger: 0.3,
    ease: "power2.out"
});
