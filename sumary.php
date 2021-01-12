<?php 
    session_start();

    if($_SESSION['permission'] != 1) {
        header('location:login.php');
    }

    $conn = mysqli_connect("localhost","root","mysql","giuaky");

    // if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $update = "UPDATE `taikhoan` SET `permission` = '".$_POST['permission']."' WHERE `taikhoan`.`id` = ".$_POST['updateId'];
    //     $excute = mysqli_query($conn, $update);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <?php include("import.php") ?>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <style>
        .stonks {
            display: flex;
            flex-direction: column-reverse;
        }
        #month {
            border: none;
            outline: none;
            background-color: #0097e6;
            color: #fff;
            padding: .2em 0;
        }
    </style>
</head>
<body>
   <header>
    <?php include("header.php"); ?>
   </header>

   <main>
    <div class="container">
        <div class="mt-3 row">
            <div class="col-sm-3">
                <div class="list-group m-x-2">
                    <a href="manage-product.php" class="list-group-item list-group-item-action list-group-item-primary">Quản lý sản phẩm</a>
                    <a href="manage-category.php" class="list-group-item list-group-item-action">Quản lý danh mục</a>
                    <a href="manage-account.php" class="list-group-item list-group-item-action">Quản lý tài khoản</a>
                    <a href="manage-receipt.php" class="list-group-item list-group-item-action">Đơn hàng</a>
                    <a href="sumary.php" class="list-group-item list-group-item-action">Doanh thu năm</a>
                </div>
            </div>
            <div class="col-sm-9">    
                <div>
                    <h3>Doanh thu tháng <?php echo ($_REQUEST['month']) ? $_REQUEST['month'] : date('m') ?></h3>
                    <select name="month" id="month" onchange="reload(this)">
                        <script>
                            var months = "";
                            for (let index = 1; index <= 12; index++) {
                                months = months + "<option value="+index+">"+index+"</option>";
                            }
                            document.getElementById('month').innerHTML = months;

                            function reload(mon) {
                                let url = "sumary.php?month="+mon.value;
                                window.location = url;
                            }
                        </script>
                    </select>
                </div>                        
                <div class="stonks">
                    <?php 
                        $sql = "SELECT sum(daban) as total_sell FROM `chitiethd`,`hoadon` WHERE idhoadon = receiptid AND MONTH(date) = ". (($_REQUEST['month']) ? $_REQUEST['month'] : date("m"))." AND YEAR(date) = " . date("Y");
                        $query = mysqli_query($conn, $sql);
                        $rs = mysqli_fetch_row($query);
                        $totalsell = $rs[0] ? $rs[0]:0;
                        $sql = "SELECT sanpham.name,daban,hoadon.date,daban*price as total FROM `chitiethd`,`sanpham`,`hoadon` WHERE sanpham.id = idsanpham and receiptid = idhoadon and MONTH(date) = " . (($_REQUEST['month']) ? $_REQUEST['month'] : date("m"))." AND YEAR(date) = ". date("Y");
                        $query = mysqli_query($conn, $sql);
                        $total_stonk = 0;
                    ?>
                     <div class="sum_table">
                         <?php echo "<p><strong>Đã bán:</strong> $totalsell </p>"; ?>
                         <table class="table">
                             <th>
                                 <tr>
                                     <th>Sản phẩm</th>
                                     <th>Bán ra</th>
                                     <th>Ngày</th>
                                     <th>Tổng</th>
                                 </tr>
                             </th>
                            <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($query)) {
                                    echo "
                                        <tr>
                                            <th style='color: #0984e3'>".$row['name']."</th>
                                            <td>".$row['daban']."</td>
                                            <td>".$row['date']."</td>
                                            <td>".$row['total']."</td>
                                        </tr>
                                    ";
                                    $total_stonk+=$row['total'];
                                }

                            ?>
                            </tbody>
                         </table>
                     </div>
                     <div>
                        <h3>Tổng: <span style="color: #2ecc71"><?php echo $total_stonk ?></span>K đồng</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </main>
   <?php include("footer.php") ?>
   <script src="js/ajax.js"></script>
</body>
</html>