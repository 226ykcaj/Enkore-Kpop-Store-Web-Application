<?php

// Check if the user is not logged in and redirect them to the login page after 10 seconds
function redirectToLogin() {
    if(!isset($_SESSION['userid'])) {
        echo '<script>';
        echo 'setTimeout(function() {';
        echo 'window.location.href = "account.php?error=Please log in first";';
        echo 'alert("Please log in first to continue accessing the page.");';
        echo '}, 600000);'; // 10 mins
        echo '</script>';
    }
}

// Call the function to redirect after 10 seconds if the user is not logged in
redirectToLogin();