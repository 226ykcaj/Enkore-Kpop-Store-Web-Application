function sortProducts() {
    // Get the selected sorting option from the dropdown
    var selectElement = document.getElementById("sort-product");
    var selectedValue = selectElement.value;

    // Get the container holding all products
    var productsContainer = document.querySelector(".products-sec3");
    // Get all individual product containers
    var products = productsContainer.querySelectorAll(".products-container");

    // Convert the NodeList of products to an array for sorting
    var sortedProducts = Array.from(products);

    // Sort the products based on the selected sorting option
    sortedProducts.sort(function(a, b) {
        var productA, productB;

        switch (selectedValue) {
            case "alphabetical-a-to-z":
                // Get the text content of product names and convert to lowercase for comparison
                productA = a.querySelector(".product-name p").textContent.toLowerCase();
                productB = b.querySelector(".product-name p").textContent.toLowerCase();
                // Compare product names alphabetically from A to Z
                return productA.localeCompare(productB);
            case "alphabetical-z-to-a":
                // Get the text content of product names and convert to lowercase for comparison
                productA = a.querySelector(".product-name p").textContent.toLowerCase();
                productB = b.querySelector(".product-name p").textContent.toLowerCase();
                // Compare product names alphabetically from Z to A
                return productB.localeCompare(productA);
            case "highest-price":
                // Get the price values and convert to numbers for comparison
                productA = parseFloat(a.querySelector(".product-price p").textContent.split("RM ")[1]);
                productB = parseFloat(b.querySelector(".product-price p").textContent.split("RM ")[1]);
                // Compare product prices from highest to lowest
                return productB - productA;
            case "lowest-price":
                // Get the price values and convert to numbers for comparison
                productA = parseFloat(a.querySelector(".product-price p").textContent.split("RM ")[1]);
                productB = parseFloat(b.querySelector(".product-price p").textContent.split("RM ")[1]);
                // Compare product prices from lowest to highest
                return productA - productB;
            default:
                return 0;
        }
    });

    // Clear current products
    productsContainer.innerHTML = "";

    // Append sorted products
    sortedProducts.forEach(function(product) {
        productsContainer.appendChild(product);
    });
}