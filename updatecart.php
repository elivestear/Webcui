<?php 
    session_start();
    if(isset($_POST['submit'])) {
        foreach($_POST['qty'] as $key=>$value) {
            // echo $key ."/" . $value ."<br>";
            if($value == 0 and is_numeric(($value))) {
                unset($_SESSION['cart'][$key]);
            } elseif($value > 0 and is_numeric($value))  {
                $_SESSION['cart'][$key] = $value;
            }
        }
        header("location:cart.php");
        exit();
    }
?>