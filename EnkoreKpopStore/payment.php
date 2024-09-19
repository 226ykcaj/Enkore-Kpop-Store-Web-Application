<?php
    include ("backend/session_config.php");
    $WebPageTitle = "Checkout";
    include ("layout/header&nav.php"); 
    // to retrieve user details
    include ("backend/read_user.php");
    // to assign variable with userid session if the userid session is not null, assign it with an empty string if the userid session is null
    $userId = isset($_SESSION['userid'])?$_SESSION['userid']:"";
?>

<!--Payment contain section-->
<article>
    <?php
        // to check if the user access the payment page using the proper way(press place order button in cart page)
        if(!isset($_SESSION['pay']) || $_SESSION['pay'] !== true){
            echo "<h1>Payment<h1><br>";
            echo "<h2>You are not allowed to pay before placing order.</h2><br><br>";
        }else if($_SESSION['pay'] === true){
            ?>
    <div class="payment-con">
        <form action='backend/cart_update.php' method='POST'>
            <div class="payment-con-sec1">
                <h1>Delivery</h1>
                <input class="name" type="text" placeholder="Name" value="<?php echo $user['usersName']; ?>" required="required">
                <input class="company" type="text" placeholder="Company (optional)">
                <input class="address" type="text" placeholder="Address" value="<?php echo $user['address']; ?>" required="required">
                <div class="address-sec">
                    <input class="postcode" type="text" pattern="[0-9]{5}" placeholder="Postcode" required="required">
                    <input class="city" type="text" placeholder="City" required="required">
                    <select name="State" placeholder="State" required="required">
                        <option value="" disable selected hidden>State/territory</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelatan">Kelatan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Malacca">Malacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select>
                </div>
                <input type="text" pattern="[0-9]{10,11}" placeholder="Phone Number(10-11 digits)" value="<?php echo $user['usersPhone']; ?>" required="required">
            </div>

            <div class="payment-con-sec2">
                <h1>Payment</h1>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="Credit/Debit Card Number" required>
                <input type="text" id="cardName" name="cardName" placeholder="Card Holder" required>

                <div class="payment-sec">
                    <input type="text" id="expirationDate" name="expirationDate" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" placeholder="MM/YY" required>
                    <input type="text" id="cvv" name="cvv" pattern="[0-9]{3,4}" placeholder="CVV" required> 
                </div>
            </div>
            <button type="submit" name='pay'>Pay now</button>  
        </form>
    </div>
    <?php 
    // if user didnt complete the payment and go to other page, they still need to make payment by placing order again
    unset($_SESSION['pay']);
    }
    ?>
</article>

<!--Footer-->
<?php include ("layout/footer.php"); ?>