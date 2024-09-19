<?php
// Pop up the msg if user already log in and click the add item btn
if(isset($_SESSION['userid'])){
    if(isset($_SESSION['addToCart']) && $_SESSION['addToCart']==true){
        // To pop up message
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addToCart').classList.add('open');
        });</script>";
    }
}

// Message to be poped up to inform succesfully adding item to cart
echo"<div class='popup' id='addToCart'>
<form method='get'>
    <h2>Thank You!</h2>
    <p>You have successfully add this item to cart!</p>
    <button type='submit' name='closebtn'>OK</button>
</form>
</div>";

// To close pop up message
if (isset($_GET['closebtn'])) {
    echo "<script>document.addEventListener('click', function() {
        document.getElementById('addToCart').classList.remove('open');
        });</script>";
    
}

// Pop up the msg if user already log in and click the payment btn
if(isset($_SESSION['userid'])){
    if(isset($_SESSION['payment_msg']) && $_SESSION['payment_msg']==true){
        // To pop up message
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('payment_msg').classList.add('open');
        });</script>";
    }
}

// Payment message to be poped up
echo"<div class='popup' id='payment_msg'>
    <form method='get'>
        <h2>Thank You!</h2>
        <p>You have successfully make payment!</p>
        <button type='submit' name='closebtn'>OK</button>
    </form>
    </div>";    

// To close pop up payment message
if (isset($_GET['closebtn'])) {
    echo "<script>document.addEventListener('click', function() {
        document.getElementById('payment_msg').classList.remove('open');
        });</script>";
    
}

// Pop up the msg if user already log in and click the submit btn to submit the form
if(isset($_SESSION['userid'])){
    if(isset($_SESSION['contact_msg']) && $_SESSION['contact_msg']==true){
        // To pop up message
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('contact_msg').classList.add('open');
        });</script>";
    }
}

// Msg to inform that the form is successfully submitted
echo"<div class='popup' id='contact_msg'>
<form method='get'>
    <h2>Thank You!</h2>
    <p>You have successfully submitted the form!</p>
    <button type='submit' name='closebtn'>OK</button>
</form>
</div>";    

// To close succesfully form submitted message
if (isset($_GET['closebtn'])) {
    echo "<script>document.addEventListener('click', function() {
        document.getElementById('contact_msg').classList.remove('open');
        });</script>";
    
}

// Pop up the msg if user already log in and want to add item but there is nothing available
if(isset($_SESSION['userid'])){
    if(isset($_SESSION['empty_product']) && $_SESSION['empty_product']==true){
        // To pop up message
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('empty_product').classList.add('open');
        });</script>";
    }
}

// Msg to inform the user unsucessfully adding item
echo"<div class='popup' id='empty_product'>
<form method='get'>
    <h2>Sorry!</h2>
    <p>This product is fully sold!</p>
    <button type='submit' name='closebtn'>OK</button>
</form>
</div>";    

// To close unsucessfully adding item msg
if (isset($_GET['closebtn'])) {
    echo "<script>document.addEventListener('click', function() {
        document.getElementById('empty_product').classList.remove('open');
        });</script>";
    
}

// to unset the session so that it wont keep popping up the msg
unset($_SESSION['addToCart']);
unset($_SESSION['payment_msg']);
unset($_SESSION['contact_msg']);
unset($_SESSION['empty_product']);