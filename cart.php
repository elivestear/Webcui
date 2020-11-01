<?php 
    session_start();
    $conn = mysqli_connect("localhost","root","mysql","giuaky");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <?php include("import.php") ?>
</head>
<body>
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <div class="container">
        <div class='pro'>
            <?php 
                $isEmpty = true;
                if(isset($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $key=>$value) {
                        if(isset($key)) {
                            $isEmpty = false;
                        }
                    }
                }

                if(!$isEmpty) {
                    echo "<div class='row mbot-3'>
                    <div class='col-sm-2'><h2 class='text-center cart-title'>Sản phẩm</h2></div>
                    <div class='col-sm-3'><h2 class='text-center cart-title'>Đơn giá</h2></div>
                    <div class='col-sm-2'><h2 class='text-center cart-title'>Số lượng</h2></div>
                    <div class='col-sm-3'><h2 class='text-center cart-title'>Tổng cộng</h2></div>
                    <div class='col-sm-2'></div>
                </div>";
                    echo "<form action = 'updatecart.php' method='POST'>";
                        foreach($_SESSION['cart'] as $key=>$value) {
                            $item[] = $key;
                        }

                        $str = implode(",",$item);
                        $total_price = 0;
                        $sql = "SELECT * FROM `sanpham` WHERE id in ($str) order by id desc";
                        $query = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($query)) {
                            echo "
                                    <div class='row bordered'>

                                    <div class='col-sm-2'>
                                        <h3 class='text-center'><a href='single-product?id=".$row['id']."'>".$row['name']."</a></h3>
                                        <div class='cartImg'><img class='fit' src='".$row['img']."' alt='".$row['img']."'></div>
                                    </div>
                                    
                                    <div class='col-sm-3'>
                                    <p class='text-center'>".number_format($row['price'], 3)." VND</p>
                                    </div>

                                    <div class='col-sm-2'>
                                    <p>
                                    <input type = 'number' min='0' name='qty[".$row['id']."]' value=".$_SESSION['cart'][$row['id']]."
                                    </p>
                                    </div>

                                    <div class='col-sm-3'>
                                    <p class='text-center'>".number_format($_SESSION['cart'][$row['id']] * $row['price'], 3)." VND</p>
                                    </div>
                                    
                                    <div class='col-sm-2'>
                                    <a class='delBtn' href='delcart.php?item=".$row['id']."'><span class='glyphicon glyphicon-remove'></span></a>
                                    </div>

                                    </div>";
                            $total_price += $_SESSION['cart'][$row['id']] * $row['price'];    
                        }

                        echo "<div class='total-price'><h3 class='text-right'>Thành tiền: ".number_format($total_price, 3)." VND</h3></div>";
                        echo "<div class='btnCont'>";
                        echo "<input type = 'submit' name='submit' value='Cập nhật'>";
                        echo "<a href='checkout.php'>Thanh toán</a>";
                        echo "<a href='products.php'>Tiếp tục mua</a>";
                        echo "<a href='delcart.php?item=all'>Xóa giỏ hàng</a>";
                        echo "</div>";
                    echo "</form>";
                }
                else {
                    echo "<h1 class='text-danger'>Giỏ hàng trống</h1>";
                    echo "<a class='btn btn-primary' href='products.php'>Tiếp tục mua</a>";
                }
            ?>
        </div>    
        </div>
    </main>

    <?php include("footer.php") ?>
</body>
</html>