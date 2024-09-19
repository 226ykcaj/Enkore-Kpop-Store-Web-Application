//For index.php (Best Selling Part)
// Select all elements with the class 'product-con' and convert the NodeList to an array
const productContainers = [...document.querySelectorAll('.product-con')];
// Select all elements with the id 'next-button' and convert the NodeList to an array
const nxtBtn = [...document.querySelectorAll('#next-button')];
// Select all elements with the id 'back-button' and convert the NodeList to an array
const preBtn = [...document.querySelectorAll('#back-button')];

// Loop through each product container
productContainers.forEach((item, i) => {
    // Get the dimensions of the current product container
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    // Add event listener to the 'next' button of the current product container
    nxtBtn[i].addEventListener('click', () => {
        // Scroll the product container horizontally by its width when 'next' button is clicked
        item.scrollLeft += containerWidth;
    })

    // Add event listener to the 'previous' button of the current product container
    preBtn[i].addEventListener('click', () => {
        // Scroll the product container horizontally by its width when 'previous' button is clicked
        item.scrollLeft -= containerWidth;
    })
})