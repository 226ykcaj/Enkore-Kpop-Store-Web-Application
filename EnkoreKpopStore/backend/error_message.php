<?php 
    // to get the error message from the url and show the erros at the account page
    if (isset($_GET["error"])) { 
        echo "<p id='error'>";
        echo $_GET["error"]."</p>";
    } 
 ?>