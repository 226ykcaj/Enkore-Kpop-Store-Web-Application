<?php
// Include session configuration file
include ("session_config.php");

// Initialize $productId from POST data or set it as empty string
$productId = isset($_POST['productId']) ? $_POST['productId'] : "";

// Include read_product.php to retrieve product details
include ("read_product.php");

// Include database connection file
include ("dbh.php");

// Check if 'cartbtn' button is pressed
if (isset($_POST['cartbtn'])){        
    // If user is not logged in, redirect to login page with error message
    if(!isset($_SESSION['userid'])){
        // Close database connection
        mysqli_close($conn);
        header("Location:../account.php?error=please log in first");
        exit();
    }
}

// Get user ID from session
$userId = $_SESSION['userid'];
// Set payment status as "Unpaid"
$payment_status = "Unpaid";

// Check if 'type' parameter is set in POST data
if(isset($_POST['type'])){
    // Retrieve product details from $product array obtained from read_product.php
    $product_name = $product['name'];
    $price = $product['price'];
    $img_album = $product['img_album'];

    // Query to check if product already exists in cart
    $resultOfCartProduct = mysqli_query($conn, "SELECT * FROM cart WHERE usersId = '$userId' AND productId = '$productId' AND payment_status = '$payment_status';");

    // Check if query execution failed
    if(!$resultOfCartProduct){
        die("Fail to retrieve cart product:" . mysqli_error($conn));
    }

    // If 'type' is 'add' and product already exists in cart, update quantity
    if($_POST['type'] == 'add' && mysqli_num_rows($resultOfCartProduct) > 0){
        // Check if remaining product quantity is greater than 0
        if($product['quantity'] > 0){
            // Get quantity from POST data
            $quantity = $_POST['quantity'];

            // Prepare and execute SQL query to update cart with new quantity
            $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = quantity + ?, payment_status = ? WHERE usersId = ? AND productId = ?");
            mysqli_stmt_bind_param($stmt, "isii", $quantity, $payment_status, $userId, $productId);
            if(!mysqli_stmt_execute($stmt)){
                die("Fail to update cart products:" . mysqli_error($conn));
            }      

            // Prepare and execute SQL query to update product quantity
            $stmt_update_products = mysqli_prepare($conn,"UPDATE products SET quantity = quantity - ? WHERE productId = ?;");
            mysqli_stmt_bind_param($stmt_update_products, "ii", $quantity, $productId);
            if(!mysqli_stmt_execute($stmt_update_products)){
                die("Fail to update products table:" . mysqli_error($conn));
            }
            // Close prepared statements
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt_update_products);
            // Set session variable for popup successfully adding item
            $_SESSION['addToCart'] = true;
        }else if($product['quantity'] <= 0){
            // Set session variable for pop up not available products to be added
            $_SESSION['empty_product'] = true;
        }
    }
    // If 'remove' button is pressed
    else if(isset($_POST['remove'])){
        // Split the value of 'remove' parameter to get cartId and productId
        list($cartId, $productId) = explode(',', $_POST['remove']);

        // Query to retrieve cart product details
        $resultToUpdateQuantity = mysqli_query($conn, "SELECT * FROM cart WHERE cartId = '$cartId';");
        if(!$resultToUpdateQuantity){
            die("Fail to select cart products:" . mysqli_error($conn));
        }

        // If cart product exists, get its quantity
        if(mysqli_num_rows($resultToUpdateQuantity) > 0){
            $cart = mysqli_fetch_assoc($resultToUpdateQuantity); 
        }
        $quantity = $cart['quantity'];

        // Query to delete cart product
        $resultToDelete = mysqli_query($conn, "DELETE FROM cart WHERE cartId = '$cartId';");

        // Check if deletion was successful
        if(!$resultToDelete){
            die("Fail to delete cart products:" . mysqli_error($conn));
        }
        
        // Prepare and execute SQL query to update product quantity
        $stmt_update_products = mysqli_prepare($conn, "UPDATE products SET quantity = quantity + ? WHERE productId = ?;");
        mysqli_stmt_bind_param($stmt_update_products, "ii", $quantity, $productId);
        if(!mysqli_stmt_execute($stmt_update_products)){
            die("Fail to update products table:" . mysqli_error($conn));
        }
        // Close prepared statement
        mysqli_stmt_close($stmt_update_products);
    }
    // If 'type' is 'modify'
    else if($_POST['type'] == 'modify'){
        // Retrieve cartIds, updated quantities, and productIds from POST data
        $cartIds = $_POST['cartIds'];
        $updatedQuantities = $_POST['quantity'];
        $productIds = $_POST['productIds'];

        // Loop through arrays and update quantities for each product
        foreach ($cartIds as $index => $cartId) {
            // Get quantity to modify in cart, productId, and calculate total price
            $quantityToModifyInCart = $updatedQuantities[$index];
            $productId = $productIds[$index];
            $totalPrice = $quantityToModifyInCart * $price;

            // Query to retrieve cart product details
            $resultOfCart = mysqli_query($conn, "SELECT * FROM cart WHERE cartId = '$cartId' AND payment_status = '$payment_status';");

            // Check if query execution failed
            if(!$resultOfCart){
                die("Fail to retrieve cart product:" . mysqli_error($conn));
            }

            // If cart product exists, get its quantity
            if(mysqli_num_rows($resultOfCart) > 0){
                $row = mysqli_fetch_assoc($resultOfCart);
                $quantityInCart = $row['quantity'];
            } 

            // Query to retrieve product details
            $resultOfProduct = mysqli_query($conn, "SELECT * FROM products WHERE productId = '$productId';");

            // Check if query execution failed
            if(!$resultOfProduct){
                die("Fail to retrieve cart product:" . mysqli_error($conn));
            }

            // If product exists, get its quantity
            if(mysqli_num_rows($resultOfProduct) > 0){
                $row = mysqli_fetch_assoc($resultOfProduct);
                $quantityInProducts = $row['quantity'];
            } 

            // If quantity to modify in cart is greater than or equal to quantity in cart
            if($quantityToModifyInCart >= $quantityInCart){
                $remainingQuantity = ($quantityToModifyInCart - $quantityInCart) - $quantityInProducts;

                // If remaining quantity is non-negative, update cart and product quantities
                if($remainingQuantity <= 0){
                    // Prepare and execute SQL query to update cart
                    $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE cartId = ?");
                    mysqli_stmt_bind_param($stmt, "ii", $quantityToModifyInCart, $cartId);

                    if (!mysqli_stmt_execute($stmt)) {
                        die("Failed to update cart products: " . mysqli_error($conn));
                    }

                    // Prepare and execute SQL query to update product quantity
                    $stmt_update_products = mysqli_prepare($conn, "UPDATE products SET quantity = quantity - ? + ? WHERE productId = ?;");
                    mysqli_stmt_bind_param($stmt_update_products, "iii", $quantityToModifyInCart, $quantityInCart, $productId);
                    if(!mysqli_stmt_execute($stmt_update_products)){
                        die("Fail to update products table:" . mysqli_error($conn));
                    }
                    // Close prepared statements
                    mysqli_stmt_close($stmt);
                    mysqli_stmt_close($stmt_update_products);
                }
                
            }else{
                // Prepare and execute SQL query to update cart
                $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE cartId = ?");
                mysqli_stmt_bind_param($stmt, "ii", $quantityToModifyInCart, $cartId);

                if (!mysqli_stmt_execute($stmt)) {
                    die("Failed to update cart products: " . mysqli_error($conn));
                }

                // Calculate quantity to be added
                $quantityToBeAdded = $quantityInCart - $quantityToModifyInCart;

                // Prepare and execute SQL query to update product quantity
                $stmt_update_products = mysqli_prepare($conn, "UPDATE products SET quantity = quantity + ? WHERE productId = ?;");
                mysqli_stmt_bind_param($stmt_update_products, "ii", $quantityToBeAdded, $productId);
                if(!mysqli_stmt_execute($stmt_update_products)){
                    die("Fail to update products table:" . mysqli_error($conn));
                }
                // Close prepared statements
                mysqli_stmt_close($stmt);
                mysqli_stmt_close($stmt_update_products);
            }
            // Free result sets
            mysqli_free_result($resultOfCart);
            mysqli_free_result($resultOfProduct);
        }
    }
    // If 'type' is 'add' and product does not exist in cart, insert new product into cart
    else if($_POST['type'] == 'add' && mysqli_num_rows($resultOfCartProduct) == 0){
        // Check if product quantity is greater than 0
        if($product['quantity'] > 0){
            // Get quantity from POST data
            $quantity = $_POST['quantity'];

            // Prepare and execute SQL query to insert new product into cart
            $stmt = mysqli_prepare($conn, "INSERT INTO cart (productId, usersId, product_name, price, quantity, img_album, payment_status) VALUES (?,?,?,?,?,?,?);");
            mysqli_stmt_bind_param($stmt, "iisdiss", $productId, $userId, $product_name, $price, $quantity, $img_album, $payment_status);
            if(!mysqli_stmt_execute($stmt)){
                die("Fail to insert cart products:" . mysqli_error($conn));
            }

            // Prepare and execute SQL query to update product quantity
            $stmt_update_products = mysqli_prepare($conn, "UPDATE products SET quantity = quantity - ? WHERE productId = ?;");
            mysqli_stmt_bind_param($stmt_update_products, "ii", $quantity, $productId);
            if(!mysqli_stmt_execute($stmt_update_products)){
                die("Fail to update products table:" . mysqli_error($conn));
            }
            // Close prepared statements
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt_update_products);
            // Set session variable for popup
            $_SESSION['addToCart'] = true;
        }else if($product['quantity'] <= 0){
            // Set session variable for pop up not available products to be added
            $_SESSION['empty_product'] = true;
        }
    }
}

// If 'order' button is pressed, set session variable and redirect to payment page
if(isset($_POST['order'])){
    $_SESSION['pay'] = true;
    // Close database connection
    mysqli_close($conn);
    header("Location:../payment.php");
    exit();
}

// Query to retrieve cart products
$resultOfCartProducts = mysqli_query($conn, "SELECT * FROM cart WHERE usersId = '$userId' AND payment_status ='$payment_status';");

// Check if query execution failed
if(!$resultOfCartProducts){
    die("Fail to retrieve cart products:" . mysqli_error($conn));
}

// If cart products exist, fetch them into an array
if(mysqli_num_rows($resultOfCartProducts) > 0){
    $cart = mysqli_fetch_all($resultOfCartProducts, MYSQLI_ASSOC);
}

// Free result
mysqli_free_result($resultOfCartProducts);

// If 'pay' button is pressed, update payment status and redirect to purchase page
if(isset($_POST['pay'])){
    foreach($cart as $ordered_product){
        $cartId = $ordered_product['cartId'];
        $product_name = $ordered_product["product_name"];
        $product_qty = $ordered_product["quantity"];
        $product_price = $ordered_product["price"];
        $product_id = $ordered_product["productId"];
        $product_img = $ordered_product["img_album"];
        // Get current timestamp
        $currentTimestamp = date("Y-m-d H:i:s");
        $payment_status = "Paid";
        // Prepare and execute SQL query to update payment status
        $stmt = mysqli_prepare($conn, "UPDATE cart SET payment_status = ? WHERE cartId = ?;");
        mysqli_stmt_bind_param($stmt, "si", $payment_status, $cartId);
        if(!mysqli_stmt_execute($stmt)){
            die("Fail to save ordered products into db:" . mysqli_error($conn));
        }
        // Close prepared statement
        mysqli_stmt_close($stmt);
    }
    // Set session variable for payment message
    $_SESSION['payment_msg'] = true;
    // Close database connection
    mysqli_close($conn);
    // Redirect to purchase page
    header("Location:../purchase.php");
    exit();
}

if(isset($_POST['contact'])){
    // Set session variable for contact message
    $_SESSION['contact_msg'] = true;
    // Close database connection
    mysqli_close($conn);
    // Redirect to purchase page
    header("Location:../contactus.php");
    exit();
}

// Close database connection
mysqli_close($conn);

// Get return URL from POST data or set it as empty string
$return_url = (isset($_POST["return_url"])) ? urldecode($_POST["return_url"]) : '';

// Redirect back to return URL
header('Location:'.$return_url);

exit();
?>