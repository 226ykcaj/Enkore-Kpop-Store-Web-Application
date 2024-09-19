<?php
    include ("session_config.php");
    // to unset and destroy all the session existed
    session_unset();
    session_destroy();
    // prompt user to account page
    header("location:../account.php");
    exit();