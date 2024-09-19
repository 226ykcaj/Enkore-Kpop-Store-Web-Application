<?php
    include ("backend/session_config.php");
    // to reassign $productId after pop up message
    if(isset($_REQUEST['productId'])){
        $productId = $_REQUEST['productId'];
        $_SESSION['productId'] = $productId; 
    }else{
        $productId = $_SESSION['productId'];
    }
    // to read particular product according to productId requested
    include ("backend/read_product.php");
    $WebPageTitle = $product['name'];
    include ("layout/header&nav.php");
    // to store current url for later redirect
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
    // to pop up message
    include ("backend/popup_msg.php");
?>

<!--Product contain section-->
<article>
    <div class="pd-con">
        <div class="pd-sec1">
            <div class="pd-sec1-sub1">
                <?php echo $product['img_album']; ?>
            </div>

            <div class="pd-sec1-sub2">
                <h1><?php echo $product['name']; ?></h1>
                <span class="price">
                    <h2 class>RM <?php echo $product['price']; ?></h2>
                </span>
                <form action='backend/cart_update.php' method='POST'>
                    <!-- to post needed details to cart_update.php-->
                    <input type='hidden' name='productId' value='<?php echo $product['productId']; ?>'>
                    <input type='hidden' name='type' value='add'>
                    <input type='hidden' name='return_url' value='<?php echo $current_url; ?>'>
                    <input type='number' class='pd-quantity' min='1' max="<?php echo $product['quantity']; ?>" name='quantity' value='1'>
                    <button type='submit' class='btn' name='cartbtn'>Add to cart</button>
                </form>
            </div>
        </div>
    
        <div class="pd-sec2">
            <div class="pd-desc">
                <div class="pd-sec2-sub1">
                <?php echo $product['img_desc']; ?>
                </div>

                <div class="pd-sec2-sub2">
                <?php echo $product['description']; ?>
                </div>
            </div>
        </div>
    </div>
</article>
<!--Footer-->
<?php include("layout/footer.php"); ?>