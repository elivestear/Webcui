<?php
    session_start();

    if($_SESSION['permission'] == 0) {
        header('location:login.php');
    }

    $conn = mysqli_connect('localhost', 'root','mysql','giuaky');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php include("import.php") ?>
    <style>
        body {
            background: #fff;
        }
        .container {
            height: 100vh;
            background-color: #fff;
        }
        .receipt-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column-reverse;
        }
        .receipt-wrap table {
            width: 60%;
        }
        .receipt-wrap .title {
            text-transform: uppercase;
            margin: 1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="receipt-wrap">
            <?php 
                if(isset($_REQUEST['id'])) {
                    $sql = "SELECT `receiptid`,`username`, prod.id,`name`,`price`,`daban`,`price`*`daban` as `total`,`date`,`address` FROM `taikhoan` user, `hoadon` receipt,`chitiethd` detail,`sanpham` prod WHERE receipt.userId = user.id and detail.idhoadon = receipt.receiptid and prod.id = detail.idsanpham AND receiptid = ".$_REQUEST['id'];
                    $query = mysqli_query($conn, $sql);
                    $total_price = 0;
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            while($row = mysqli_fetch_assoc($query)) {
                                echo "
                                    <tr>
                                        <td>".$row['id']."</td>
                                    
                                        <td>".$row['name']."</td>
                                    
                                        <td>".$row['price']."</td>
                                    
                                        <td>".$row['daban']."</td>
                                    
                                        <td>".$row['total']."k</td>                                    
                                    </tr>
                                ";
                                $total_price+= $row['total'];
                                $user = $row['username'];
                                $date = $row['date'];
                                $address = $row['address'];
                            }
                        }
                    ?>
                </tbody>
            </table>
            <hr>
            <div class="info">
                <p><strong>Tài khoản thanh toán: </strong><?php echo $user ?></p>
                <p><strong>Ngày:</strong><?php echo $date ?></p>
                <p><strong>Địa chỉ:</strong><?php echo $address ?></p>
                <p><strong>Thành tiền:</strong><?php echo $total_price ?><strong>k</strong> đồng</p>
            </div>
            <hr>
            <h1 class="text-center title">Thông tin hóa đơn</h1>
        </div>
    </div>
    <script>
        window.onload = () => {
            window.print();
        }
    </script>
</body>
</html>