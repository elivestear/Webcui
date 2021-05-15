<?php 
    session_start();
    $conn = mysqli_connect("localhost","root","","doan");
    if(!isset($_SESSION['userid'])) {
        header("location:login.php");
    }

    if(isset($_REQUEST['id'])) {
        $sql = "UPDATE `hoadon` SET `status` = 'Successful' WHERE receiptid = {$_REQUEST['id']}";
        $query = mysqli_query($conn, $sql);

        echo "ok";
    }else {
        echo "err";
    }
?>