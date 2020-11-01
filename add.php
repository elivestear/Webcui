<?php 
    session_start();
    $id = $_REQUEST['item'];
    if(isset($_SESSION['cart'][$id])) {
        $quantity = $_SESSION['cart'][$id] + 1;
    } else {
        $quantity = 1;
    }

    $_SESSION['cart'][$id] = $quantity;
    $redirect = "location:single-product.php?id= $id";
    header($redirect);
    exit();
?>