<?php 
    session_start();

    $conn = mysqli_connect("localhost","root","mysql","giuaky");

    // if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $update = "UPDATE `taikhoan` SET `permission` = '".$_POST['permission']."' WHERE `taikhoan`.`id` = ".$_POST['updateId'];
    //     $excute = mysqli_query($conn, $update);
    // }
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $delete = "DELETE FROM `taikhoan` WHERE `id` = ".$_GET['deleteId'];
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
                <h1 class="text-center text-primary">Tài khoản</h1>
                            
                <div class="table-cont">
                    <div class="table-responsive-md">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Quyền hạn</th>
                                <th>Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $result = mysqli_query($conn, "SELECT count(id) as total FROM `taikhoan`");
                             $row = mysqli_fetch_assoc($result);
                             $total_records = $row['total'];
 
                             $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                             $limit = 20;
 
                             $total_page = ceil($total_records / $limit);
 
                             if($current_page > $total_page) $current_page = 1;
                             elseif($current_page < 1) $current_page = 1;
 
                             $start = ($current_page - 1) * $limit;
                            $query = "SELECT * FROM `taikhoan` LIMIT $start, $limit";
                            $rs = mysqli_query($conn, $query);
                            
                            while($row = mysqli_fetch_assoc($rs)) {
                                $isadmin = $row['permission'] == 1? "selected" : "";
                                $iseditor = $row['permission'] == 2? "selected" : "";
                                $iscustomer = $row['permission'] == 0? "selected" : "";
                                echo '<tr>
                                        <td><b style="color:'.permission($row['permission']).'">'.$row['username'].'</b></td>
                                        <td>'.$row['email'].'</td>
                                        <td>
                                            <select class="form-control" name="permission" id="permission">
                                                <option value="1" '.$isadmin.'>Quản trị viên</option>
                                                <option value="2" '.$iseditor.'>Người chỉnh sửa</option>
                                                <option value="0" '.$iscustomer.'>Người dùng</option>
                                            </select>
                                        </td>
                                        <td style="display: flex;">
                                            <div class="mb-1">
                                                <form action ="" method="GET">
                                                    <input class="hide" type="number" name="deleteId" value="'.$row['id'].'">
                                                    <input class="btn btn-danger" type="submit" value="Xóa">   
                                                </form>
                                            </div>
                                            <div style="margin-left: 5px">
                                                <a class="btn btn-success" href="userupdate.php?id='.$row['id'].'">Cập nhật</a>
                                            </div>
                                        </td>
                                    </tr>';
                            }

                            function permission($p) {
                                if($p == 1) {
                                    return "#EE5A24";
                                }
                                elseif($p == 0){
                                    return "#0984e3";
                                }
                                elseif($p == 2){
                                    return "#009432";
                                }
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