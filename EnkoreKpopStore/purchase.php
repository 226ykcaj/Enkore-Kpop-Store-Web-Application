<?php 
    include ('backend/session_config.php');
    $WebPageTitle = 'My Purchase'; 
    include ('layout/header&nav.php');
    // to read the purchase history of the user
    include ('backend/read_history.php');
    // to pop up payment msg when the user is being redirected to this page after successfully make payment
    include ("backend/popup_msg.php");
?>

<article>
    <div class="profile-con">
        <div class="cart-con">
            <h1>Purchase History</h1>
            <?php 
            // if there is no purchase history
            if(empty($history)){
                echo "<br><br><h2>Your purchase history is empty.</h2>";
            }else{
                ?>
            <table>
                <tr>
                    <th colspan="2">Product</th>
                    <th class="pd-quantity">Quantity</th>
                    <th>Price</th>
                    <th class="pd-total-price">Total</th>
                </tr> 

                <?php
                // if there is purchase history
                    foreach($history as $product){
                    echo"
                    <tr>
                    <td class='pd-img'>
                        <a href='product.php?productId={$product['productId']}'>
                            {$product['img_album']}
                        </a>
                    </td>

                    <td class='pd-name'>
                        <a href='product.php?productId={$product['productId']}'>
                            <p>{$product['product_name']}</p>
                        </a>
                    </td>

                    <td class='pd-quantity'>
                        <p>{$product['quantity']}</p>
                    </td>

                    <td class='pd-price'>
                        <p>RM {$product['price']}</p>
                    </td>

                    <td class='pd-total-price'>
                        <p>RM ".$product['price']*$product['quantity']."</p>
                    </td>
                    </tr>";
                    }
                }
                
                ?>
            </table>
        </div>
    </div>
</article>

<!--Footer-->
<?php include ('layout/footer.php'); ?>