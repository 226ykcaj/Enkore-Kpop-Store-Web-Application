<?php
    $WebPageTitle = "Enkore Kpop Store";
    // to start session and configure the session
    include ("backend/session_config.php");
    // to connect to database
    include ("backend/dbh.php");
    // to read the best selling products
    include ("backend/read_bestSelling.php");
    include ("layout/header&nav.php");
    // to pop up related message after successfully adding item
    include ("backend/popup_msg.php");
    // to log the error into txt file and not showing to the user
    include ("backend/error_log.php");
    // to store the current url
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<article>
    <!--For slider: display 2 posters-->
    <div class="slide-con">
        <div class="slide">
            <img src="picture/home/lesserafim-slide.png" alt="LE SSERAFIM">
        </div>

        <div class="slide">
            <img src="picture/home/newjeans-slide.png" alt="New Jeans">
        </div>
    </div>
    <div class="dot-con">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
    </div>

    <br>
    <!--For display best selling products-->
    <section class="product">
        <h1>Best Selling</h1>
        <div class="pd-wrap">
            <img src="picture/home/back.png" alt="Back Button" id="back-button">
            <div class="product-con">
                <?php
                foreach($products as $product){
                    echo "<div class='products-container'>
                    <a href='product.php?productId={$product['productId']}'>
                        {$product['img_album']}
                        <div class='product-name'>
                            <p>{$product['name']}</p>
                        </div>
                        <div class='product-price'>
                            <p>RM {$product['price']}</p>
                        </div>
                    </a>
                    <form action='backend/cart_update.php' method='POST'>
                        <input type='hidden' name='productId' value='{$product['productId']}'>
                        <input type='hidden' name='type' value='add'>
                        <input type='hidden' name='quantity' value='1'>
                        <input type='hidden' name='return_url' value='{$current_url}'>
                        <button type='submit' class='cart-button' name='cartbtn'>Add to cart</button>
                    </form>
                </div>";
                }
                ?>
            </div>
            <img src="picture/home/next.png" alt="Next Button" id="next-button">
        </div>
    </section>
</article>

<!--Footer-->
<?php include ("layout/footer.php");?>