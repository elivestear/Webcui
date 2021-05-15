<?php 
    session_start();

    if($_SESSION['permission'] != 1) {
        header('location:login.php');
    }

    $conn = mysqli_connect("localhost","root","","doan");

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

                <h1 class="text-center text-primary">Hóa đơn</h1>
                            
                <div class="table-cont">
                    <div class="table-responsive-md">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Người mua</th>
                                <th>ngày</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $result = mysqli_query($conn, "SELECT count(receiptid) as total FROM `hoadon`");
                             $row = mysqli_fetch_assoc($result);
                             $total_records = $row['total'];
 
                             $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                             $limit = 20;
 
                             $total_page = ceil($total_records / $limit);
 
                             if($current_page > $total_page) $current_page = 1;
                             elseif($current_page < 1) $current_page = 1;
 
                             $start = ($current_page - 1) * $limit;
                            $query = "SELECT `receiptid`,`username`,`date`,`address`,`status` FROM `hoadon` receipt, `taikhoan` user WHERE receipt.userID = user.id LIMIT $start, $limit";
                            $rs = mysqli_query($conn, $query);
                            
                            while($row = mysqli_fetch_assoc($rs)) {
                                echo '<tr>
                                        <td><a class="btn btn-primary" href="receiptdetail.php?id='.$row['receiptid'].'" target="_blank">'.$row['receiptid'].'</a></td>
                                        <td>'.$row['username'].'</td>
                                        <td>'.$row['date'].'</td>  
                                        <td>'.$row['address'].'</td>
                                        <td style="color:'.sttcolor($row['status']).'; font-weight: 600">
                                            <p style="cursor: pointer" onclick="confirm(this,'.$row['receiptid'].');">'.$row['status'].'</p>
                                        </td>
                                    </tr>';
                            }

                            function sttcolor($stt) {
                                if($stt == 'processing') return '#f1c40f';
                                if($stt == 'Successful') return '#009432';
                                if($stt == 'Canceled') return '#EA2027';
                            }
                        ?>
                            </tbody>
                            <script>
                                function confirm(status, id) {
                                    let url = `confirmstatus.php?id=${id}`;
                                    loadDoc(url, change = (xhttp) => {
                                        {   
                                            if(xhttp.responseText == 'ok') {
                                                status.innerHTML = "Successful";
                                                status.style.color = "#009432"
                                            }else {
                                                window.alert('err');
                                            }
                                        }
                                    });
                                }
                            </script>
                        </table>
                    </div>
                    <div class="pagination-cont">
                    <ul class="pagination">
                    <?php 
                        if($current_page > 1 && $total_page > 1) {
                            echo '<li class="page-item"><a href="manage-product.php?page='.($current_page - 1).'"><span class="glyphicon glyphicon-chevron-left"></span></a></li>';
                        }

                        for($i = 1; $i <= $total_page; $i++) {
                            if($i == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                echo '<li class="page-item"><a href="manage-product.php?page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($current_page < $total_page && $total_page > 1) {
                            echo '<li class="page-item"><a href="manage-product.php?page='.($current_page + 1).'"><span class="glyphicon glyphicon-chevron-right"></span></a></li>';
                        }
                    ?>
                    </ul>
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