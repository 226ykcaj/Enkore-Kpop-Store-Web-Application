<?php 
    include ("backend/session_config.php");
    $WebPageTitle = "Cart"; 
    include ("layout/header&nav.php");
    include ("backend/read_cart.php");
?>

<!--Cart contain section-->
<article id="cart-container">
    <div class="cart-con">
        <h1>Shopping Cart</h1>
            <?php
            // to check if there is any ordered products in cart
            if(mysqli_num_rows($result) > 0 ){

                echo"<form action='backend/cart_update.php' method='post' id='listCart'>
                        <table>
                            <tr>
                                <th colspan='2'>Product</th>
                                <th class='pd-quantity'>Quantity</th>
                                <th>Price</th>
                                <th class='pd-total-price'>Total</th>
                            </tr>";
                // to calculate the total price of the items in cart
                $total =0;
                // to loop through every cart products
                foreach ($cart as $cart_item){
                    $product_name = $cart_item["product_name"];
                    $quantity = $cart_item["quantity"];
                    $price = $cart_item["price"];
                    $productId = $cart_item["productId"];
                    $img_album = $cart_item["img_album"];
                    $cartId = $cart_item["cartId"];
                    
                    echo '<tr>';
                    echo "<td class='pd-img'><a href='product.php?productId={$productId}'>".$img_album.'</a></td>';
                    echo "<td class='pd-name'><p>".$product_name."</p></td>";
                    // To store every cartId of each cart product
                    echo "<input type='hidden' name='cartIds[]' value='{$cartId}' >";
                    // To store every productId of each cart product
                    echo "<input type='hidden' name='productIds[]' value='{$productId}'>";
                    // include read_product file to read product details
                    include ("backend/read_product.php");
                    // to calculate the max quantity available
                    $maxQuantity = $product['quantity'] + $quantity;
                    echo "<td><input type='number' class='pd-quantity' min='1' max='{$maxQuantity}' name='quantity[]' value='".$quantity."' >";
                    // to post the cartId and productId as values inside remove
                    echo "<button type='submit' class='remove' name='remove' value='".$cartId.",".$productId."'>Remove</button>";
                    echo "</td>";
                    echo "<input type='hidden' name='type' value='modify'>";
                    // to calculate the total price of the cart products
                    $subtotal = ($price * $quantity);
                    $total = ($total + $subtotal);
                    echo "<td  class='pd-price'>RM".$price.'</td>';
                    echo "<td  class='pd-total-price'>RM".$subtotal.'</td>';
                    echo "<input type='hidden' name='productId' value='{$productId}' >";
                    
                    echo '</tr>';
                }
                
                echo '</table>';
                // to store current url
                $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
                echo '<input type="hidden" name="return_url" value="'.$current_url.'" >';

                echo"<div class='subtotal'>
                        <span  class='text'>Total</span>
                        <span class='price'>RM". $total."</span>
                    </div>
                    <div class='button'>
                        <button type='submit' name='update'>Update</button>
                        <button type='submit' name='order'>Place Order</button>  
                    </div>
                    </form>";

            }else{
                echo "<br><h2>Your shopping cart is empty.</h2>";
            }
                                
            ?>            
    </div>
</article>

<!--Footer-->
<?php include ("layout/footer.php"); ?>