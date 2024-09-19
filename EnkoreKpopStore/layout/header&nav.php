<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $WebPageTitle; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
    <nav>
        <!-- Hamburger menu-->
        <div class="hamburger-menu">
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="nav-sec1">
            <a href="index.php"><img id="logo-con" src="picture/logo/enkorelogo.png" alt="ENKORE LOGO"></a>
        </div>

        <div class="nav-sec2">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li>SHOP
                    <div class="drop-down-menu">
                        <ul>
                            <!-- to pass the categoryid to read the producst according to the categoryId-->
                            <li><a href="products.php?categoryId=2">iKON</a></li>
                            <li><a href="products.php?categoryId=1">LE SSERAFIM</a></li>
                            <li><a href="products.php?categoryId=3">NEWJEANS</a></li>
                        </3l>
                    </div>
                </li>
                <li><a href="aboutus.php">ABOUT US</a></li>
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </div>

        <div class="nav-sec3">
            <!-- to only show the features to the log in user-->
            <?php if(isset($_SESSION['userid'])){
                echo"<ul>
                    <li><img src='picture/logo/login-logo.png' alt='Login logo'>
                        <div class='drop-down-menu'>
                            <ul>
                                <li><a href='profile.php'>My account</a></li>
                                <li><a href='purchase.php'>My purchase</a></li>
                                <li><a href='backend/logoutserver.php'>Log Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>";
            // to only let the user to log in instead of accessing any features
            }else if(!isset($_SESSION['userid'])){
                echo"<ul>
                    <li><a href='account.php'><img src='picture/logo/login-logo.png' alt='Login logo'></a>
                    </li>
                </ul>";
            }
            ?>
        </div>

        <div class="nav-sec4">
            <a href="cart.php"><img src="picture/logo/shopping-bag.png" alt="Shopping bag logo"></a>
        </div>
    </nav>
</header>