<?php
    include ("backend/session_config.php");
    include ("backend/read_products.php");
    if($categoryId==1){
        $WebPageTitle = "LE SSERAFIM";
    }else if($categoryId==2){
        $WebPageTitle = "iKON";
    }else if($categoryId==3){
        $WebPageTitle = "NEWJEANS";
    }
    include ("layout/header&nav.php");
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    include ("backend/popup_msg.php");  
?>

<!--Products contain section-->
<article>
    <div class='products-con'>
        <div class='products-sec1'>
         <?php echo "{$products[0]['img_group']}";?>
        </div>

    <div class='products-sec2'>
        <p>4 Products</p>
        <label class='sortby'>
        Sort By
            <select id='sort-product' name='sort' onchange='sortProducts()'>
                <option value='alphabetical-a-to-z'>Alphabetical A-Z</option>
                <option value='alphabetical-z-to-a'>Alphabetical Z-A</option>
                <option value='highest-price'>Highest Price</option>
                <option value='lowest-price'>Lowest Price</option>
            </select>
        </label>
    </div>
       
    <div class='products-sec3'>
    <?php
        for($i=0;$i<count($products);$i++){
            echo"
            <div class='products-container'>
                <a href='product.php?productId={$products[$i]['productId']}'>
                    {$products[$i]['img_album']}
                    <div class='product-name'>
                        <p>{$products[$i]['name']}</p>
                    </div>
                    <div class='product-price'>
                        <p>RM {$products[$i]['price']}</p>
                    </div>
                </a>
                <form action='backend/cart_update.php' method='POST'>
                    <input type='hidden' name='productId' value='{$products[$i]['productId']}' >
                    <input type='hidden' name='quantity' value='1' >
                    <input type='hidden' name='type' value='add' >
                    <input type='hidden' name='return_url' value='{$current_url}' >
                    <button type='submit' class='cart-button' name='cartbtn'>Add to cart</button>
                </form>
            </div>";
        }
    ?>
    </div>
</article>

<!--Footer-->
<?php include ("layout/footer.php"); ?>