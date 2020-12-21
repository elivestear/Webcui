<?php 
    session_start();
    $conn = mysqli_connect("localhost","root","mysql","giuaky");
    if(!isset($_SESSION['userid'])) {
        header("location:login.php");
    }
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $userid = $_SESSION['userid'];
        $address = isset($_POST['address'])? $_POST['address']: "Tại cửa hàng";
        $customername = $_POST['customername'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $time = date("y-m-d");
        $items = array();
        foreach($_SESSION['cart'] as $key=>$value) {
            $quantity = mysqli_fetch_row( mysqli_query($conn, "SELECT `quantity` from `sanpham` WHERE `id` =" . $key))[0];
            $n_quantity = $quantity - $value;
            mysqli_query($conn, "UPDATE `sanpham` SET `quantity` =".$n_quantity." WHERE `id` =".$key);
            $items[$key] = $value; 
        }
        // $productid = implode(",",$item);
        // $quantity = implode(",",$item_q);

        $sql = "INSERT INTO `hoadon` (`date`,`userid`,`address`) VALUES ('".$time."','".$userid."','".$address."');";        
        mysqli_query($conn, $sql);
        $query = mysqli_query($conn, "SELECT `receiptid` FROM `hoadon` ORDER BY receiptid desc");
        $getid = mysqli_fetch_row($query);

        foreach($items as $k=>$v) {
            $sql = "INSERT INTO `chitiethd`(`idhoadon`,`idsanpham`,`daban`) VALUES ('$getid[0]','$k','$v');";
            mysqli_query($conn, $sql);
            $item[] = $k; 
        }
        $productid = implode(",",$item);

        $directory = "D:\\";
        $filename = $directory . $time . $userid . $getid[0] .".txt";
        $receipt_print = fopen($filename, "w") or die("");
        fwrite($receipt_print, "-----HÓA ĐƠN THANH TOÁN-----\n");
        fwrite($receipt_print, $userid .".". $customername ."\n\n");
        fwrite($receipt_print, "Địa chỉ: ". $address . ", SĐT: " . $phone. ", Email: ". $email ."\n\n ----------\n");
        $sql = "SELECT * FROM `sanpham` WHERE id in ($productid) order by id desc";
        $query = mysqli_query($conn, $sql);
        $total_price = 0;
        while($row = mysqli_fetch_assoc($query)) {
            $txt = $row['name'] . " ;Đơn giá: " . $row['price'] . " ;Số lượng: " . $_SESSION['cart'][$row['id']]."\n";
            fwrite($receipt_print, $txt);
            $total_price += $_SESSION['cart'][$row['id']] * $row['price'];
        }
        fwrite($receipt_print, "----------\n\nThành tiền: ".number_format($total_price, 3));
        fclose($receipt_print);
        echo "<script>window.alert('thanh toán thành công! bạn sẽ sớm nhận được sản phẩm!')</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <?php include('import.php') ?>
</head>
<body>
    <header>
        <?php include('header.php') ?>
    </header>    

    <main>
        <div class="container ck">
            <h1 class="text-center">Mời bạn điền thông tin</h1>
                <div id="checkout-form" style="max-width: 50%; margin: auto; margin-bottom: 3em">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="form-group">
                        <label for=""></label>
                        <input type="text" class="form-control" name="customername" id="customername" placeholder="Họ Tên" required>
                        </div>

                        <div class="form-group">
                        <label for=""></label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Điện thoại" required>
                        </div>

                        <div class="form-group">
                        <label for=""></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                          <label for=""></label>
                          <input type="text"
                            class="form-control" name="address" id="address" placeholder="Địa chỉ" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Hoàn tất</button>
                        <button type="reset" class="btn btn-danger">Hủy</button>
                        <a href="cart.php" class="btn btn-warning">Quay lại giỏ hàng</a>
                    </form>
                </div>
        </div>
    </main>

    <?php include('footer.php') ?>
</body>
</html>