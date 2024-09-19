<?php 
    include ("backend/session_config.php");
    $WebPageTitle = "My Account"; 
    include ("layout/header&nav.php");
    // to retrieve the user details and show in according input field
    include ("backend/read_user.php");
?>

<!--Profile contain section-->
<article>
    <div class="profile-con">
        <div class="profile-con-sec1">
            <h1>Profile</h1>
            <?php
            // to check if user access the profile page in a proper way
            if(!isset($_SESSION['userid'])){
                echo "<br><br><h2>You should log in to access profile page.<h2>";
            }else{
            ?>
            <form action='backend/profile_update.php' method='POST'>
                <table>
                    <tr>
                        <td>Name: </td>
                        <td><input name='name' type='text' value="<?php echo $user['usersName']; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Email: </td>
                        <td><input name='email' type='email' value="<?php echo $user['usersEmail']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><input name="phone" type="text" pattern="[0-9]{10,11}" placeholder="Phone Number(10-11 digits)" value="<?php echo $user['usersPhone']; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td><input name='address' type='text' value="<?php echo $user['address']; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" placeholder="Password" id="registerPwd" name="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        required></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td colspan='2'>
                            <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
                        </td>
                    </tr>
                </table>
                <button type="submit">Update</button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</article>

<!--Footer-->
<?php include ("layout/footer.php"); ?>