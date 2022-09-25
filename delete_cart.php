<?php 

session_start();
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
    session_destroy();
}

header('Location: view_books.php');

?>