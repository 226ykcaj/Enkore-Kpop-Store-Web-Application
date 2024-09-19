<footer class="footer">
    <div class="footer-con">
        <a href="index.php">
            <img id="logo-con" src="picture/logo/enkorelogo.png" alt="ENKORE LOGO">
        </a>
    
        <p>LOCATION</p>

        <address>
            Lot. 12, TRX Mall, 55188, Kuala Lumpur.
        </address>
    </div>
  
    <ul class="footer-nav">
        <li class="nav1">
            <p class="nav1-title">COMPANY</p>

            <ul class="nav-1ul">
                <li>
                    <a href="aboutus.php">About Us</a>
                </li>

                <li>
                    <a href="contactus.php">Contact Us</a>
                </li>

                <li>
                    <a href="mailto:hello@kpopmerch.com">Email Us</a>
                </li>
            </ul>
        </li>

        <li class="nav2">
            <p class="nav2-title">SHOP</p>
            
            <ul class="nav2-ul">
                <li>
                <a href="products.php?categoryId=2">iKON</a>
                </li>
                
                <li>
                <a href="products.php?categoryId=1">LE SSERAFIM</a>
                </li>
                
                <li>
                <a href="products.php?categoryId=3">NEWJEANS</a>
                </li>
            </ul>
        </li>
    </ul>
 
    <div class="legal">
        <p>&copy; 2024 ENKORE KPOP STORE</p>
    </div>
    
</footer>

    <script type="text/javascript" src="script/account.js"></script>
    <script type="text/javascript" src="script/bestselling.js"></script>
    <script type="text/javascript" src="script/hamburger.js"></script>
    <script type="text/javascript" src="script/password.js"></script>
    <script type="text/javascript" src="script/slider.js"></script>
    <script type="text/javascript" src="script/sortby.js"></script>
</body>

</html>
<?php
// to prompt user to log in if they are not log in after accessing the page for a certain amount of time
include ("backend/check_login.php");
// to log the errors into error_log.txt and not showing the errors to the user
include ("backend/error_log.php");
?>