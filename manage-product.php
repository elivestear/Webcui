<?php 
    session_start();

    if($_SESSION['permission'] == 0) {
        header('location:login.php');
    }

    $conn = mysqli_connect("localhost","root","mysql","giuaky");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $add = "INSERT INTO `sanpham` (`name`, `CategoryID`, `price`, `quantity`, `descript`, `img`) VALUES ('".$_POST['prodName']."', '".$_POST['cateId']."', '".$_POST['price']."', '".$_POST['quantity']."', '".$_POST['describe']."', '".$_POST['img']."');";
        $excute = mysqli_query($conn, $add);
    }
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $delete = "DELETE FROM `sanpham` WHERE `id` = ".$_GET['deleteId'];
        $confirm = mysqli_query($conn, $delete);
    }
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
                </div>
            </div>
            <div class="col-sm-9">
                <h1 class="text-center text-primary">Sản phẩm</h1>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" name="prodName" placeholder="Tên sản phẩm" required>
                                            <span class="text-danger"><?php echo $emptyErr ?></span>
                                        </td>
                                        <td>
                                            <select class="form-control" name="cateId" id="cateId">
                                                <?php 
                                                    $sql="SELECT * FROM danhmuc";
                                                    $rs = mysqli_query($conn, $sql);
                                                    while($row = mysqli_fetch_assoc($rs)) {
                                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" name="quantity" type="number" min="1" max="999" placeholder="số lượng" required>
                                        </td>
                                        <td>
                                            <input class="form-control" name="price" type="text" placeholder="đơn giá" required>
                                        </td>
                                        <td>
                                            <!-- <input class="form-control" name="describe" type="text" placeholder="Mô tả"> -->
                                            <textarea class="form-control" name="describe" id="describe" placeholder="Mô tả"></textarea>
                                            <script>
                                                document.getElementById("describe").addEventListener("click",function(){
                                                    CKEDITOR.replace( 'describe' );
                                                });
                                            </script>
                                        </td>
                                        <td>
                                            <input class="form-control" name="img" type="text" placeholder="Link ảnh" required>
                                        </td>
                                        <td>
                                            <input class="form-control btn-success" type="submit" value="Thêm">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                <div class="table-cont">
                    <div class="table-responsive-md">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Tên mặt hàng</th>
                                <th>ID danh mục</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Mô tả sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $result = mysqli_query($conn, "SELECT count(id) as total FROM `sanpham`");
                             $row = mysqli_fetch_assoc($result);
                             $total_records = $row['total'];
 
                             $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                             $limit = 5;
 
                             $total_page = ceil($total_records / $limit);
 
                             if($current_page > $total_page) $current_page = 1;
                             elseif($current_page < 1) $current_page = 1;
 
                             $start = ($current_page - 1) * $limit;
                            $query = "SELECT * FROM `sanpham` LIMIT $start, $limit";
                            $rs = mysqli_query($conn, $query);
                            
                            while($row = mysqli_fetch_assoc($rs)) {
                                echo '<tr>
                                        <td>'.$row['id'].'</td>
                                        <td><a href="single-product.php?id='.$row['id'].'">'.$row['name'].'</a></td>
                                        <td>'.$row['CategoryID'].'</td>
                                        <td>'.$row['quantity'].'</td>
                                        <td>'.$row['price'].'</td>
                                        <td style="overflow-x: scroll">'.$row['descript'].'</td>
                                        <td><div class="img-cont"><img class="fit" src="'.$row['img'].'" alt="'.$row['img'].'"></div></td>
                                        <td style="display: flex">
                                            <div>
                                                <form action ="" method="GET">
                                                    <input class="hide" type="number" name="deleteId" value="'.$row['id'].'">
                                                    <input class="btn btn-danger" type="submit" value="Xóa">   
                                                </form>
                                            </div>
                                            <div style="margin-left: 5px">
                                                <a href="productEditor.php?id='.$row['id'].'" class="btn btn-success">Sửa</a>   
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        ?>
                            </tbody>
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
</body>
</html>