<?php
    include ("backend/session_config.php");
    $WebPageTitle = "Contact Us";
    include ("layout/header&nav.php"); 
    include ("backend/read_user.php");
    include ("backend/popup_msg.php");

?>

<!--Contact us contain section-->
<article id="contact-us-container">
    <?php
        if(!isset($_SESSION['userid'])){
            echo "<h2>You are not allowed to access this page before log in.</h2>";
        }else{
            ?>
    <div class="contact-text">
        <h1>Get In Touch</h1>
        <h2>Let us know how can we help by completing the form. We typically respond in 1-2 business days. Call us on +60126782608 or email us at hello@kpopmerch.com</h2>
    </div>

    <div class="contact-form">
        <form name="contact-us" action="backend/cart_update.php" method="POST">
            <input type="text" placeholder="Name" id="name" name="name" value="<?php echo $user['usersName']; ?>" required>
            <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $user['usersEmail']; ?>" required>
            <input type="text" placeholder="Phone Number(10-11 digits)" pattern='[0-9]{10-11}' id="phone_number" name="phone number"  value="<?php echo $user['usersPhone']; ?>" required>
            <textarea placeholder="Message" id="msg" name="msg" required></textarea>

            <button type="submit" class="submit" name="contact">Submit Now</button>
        </form>
    </div>
    <?php } ?>
</article>

<!--Footer--> 
<?php include("layout/footer.php"); ?>