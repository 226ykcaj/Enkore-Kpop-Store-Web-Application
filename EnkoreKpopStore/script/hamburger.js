//For hamburger menu
// Select the hamburger menu icon
const hamburger = document.querySelector(".hamburger-menu");
// Select the navigation menu
const navMenu = document.querySelector(".nav-sec2");

// Toggle the 'active' class on click of the hamburger menu icon
hamburger.addEventListener("click", () =>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
})

// Close the navigation menu when a menu item is clicked
document.querySelectorAll(".nav-sec2").forEach(n => n.addEventListener("click", () =>{
    // Remove the 'active' class from both the hamburger menu icon and the navigation menu
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))