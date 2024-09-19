// Homepage: Slider
let slideIndex = 0;
showSlides();

function showSlides() {
    // Get all slide elements and dot elements
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    // If slideIndex is greater than the number of slides, reset to 1
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    // Remove the "active" class from all dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    // Display the current slide and set the corresponding dot as active
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    // Call showSlides function again after 4000 milliseconds (4 seconds)
    setTimeout(showSlides, 4000);
}

const currentSlide = (n) => {
    showSlide(slideIndex = n);
}

const showSlide = (n) => {
    const slides = document.getElementsByClassName("slide");
    const dots = document.getElementsByClassName("dot");

    // If n is greater than the number of slides, set slideIndex to 1
    if (n > slides.length) {
        slideIndex = 1;
    }
    // If n is less than 1, set slideIndex to the last slide
    if (n < 1) {
        slideIndex = slides.length;
    }
    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    // Remove the "active" class from all dots
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    // Display the current slide and set the corresponding dot as active
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}