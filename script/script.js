header, sticky
const header = document.querySelector("header");
window.addEventListener ("scroll", function() {
	header.classList.toggle ("sticky", window.scrollY > 100);
});

// menu icon
let menu = document.querySelector('#menu-icon');
let navlist = document.querySelector('.navlist');

menu.onclick = () => {
	menu.classList.toggle('bx-x');
	navlist.classList.toggle('open');
};

window.onscroll = () => {
	menu.classList.remove('bx-x');
	navlist.classList.remove('open');
};


// navlist, stay at main color when active
document.addEventListener("DOMContentLoaded", function() {
    const navItems = document.querySelectorAll(".navlist li a");

    navItems.forEach(item => {
        item.addEventListener("click", function() {
            navItems.forEach(link => link.classList.remove("active"));

            item.classList.add("active");
        });
    });
});

//BOOKING PAGE

// Get references to the Cancel and Okay buttons
const cancelButton = document.querySelector(".btn-cancel");
const okayButton = document.querySelector(".btn-okay");

// Add event listeners to handle button clicks
cancelButton.addEventListener("click", () => {
    // Redirect to the home page when Cancel is clicked
    window.location.href = "home.html"; // Replace "home.html" with the actual URL of your home page
});

okayButton.addEventListener("click", () => {
    // Redirect to the confirmation page when Okay is clicked
    window.location.href = "confirmation.html"; // Replace "confirmation.html" with the actual URL of your confirmation page
});


