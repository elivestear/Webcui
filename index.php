<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <?php include("import.php") ?>
</head>
<body>
   <header>
    <?php include("header.php"); ?>
   </header>

   <main>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="list">
                    <h1 class="text-center">Danh mục</h1>
                    <ul>
                        <?php
                            $_SESSION['pagin-limit'] = 9;
                            if(isset($_REQUEST['pagin-limit'])) {
                                $_SESSION['pagin-limit'] = $_REQUEST['pagin-limit'];
                            }
                            $conn = mysqli_connect("localhost","root","","doan");
                            $sql = mysqli_query($conn, "SELECT * FROM `danhmuc`");
                            while($row = mysqli_fetch_assoc($sql)) {
                                $productCount = mysqli_query(($conn), "SELECT SUM(if(CategoryID = '".$row['id']."', 1, 0)) AS quantity FROM `sanpham`");
                                $counter = mysqli_fetch_assoc($productCount);
                                echo "<li><a href='products.php?category=".$row['id']."'>".$row['name']." - (". $counter['quantity'].")</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9">
                <div>
                    <div class="row">
                        <?php
                            $result = mysqli_query($conn, "SELECT count(id) as total FROM `sanpham`");

                            if(isset($_REQUEST['priceS'])) {
                                if($_REQUEST['priceS'] == 7100) {
                                    $result = mysqli_query($conn, "SELECT count(id) as total FROM `sanpham` WHERE price > 7000 AND price < 10000");
                                }
                                if($_REQUEST['priceS'] == 10000) {
                                    $result = mysqli_query($conn, "SELECT count(id) as total FROM `sanpham` WHERE price > 10000");
                                }
                                $result = mysqli_query($conn, "SELECT count(id) as total FROM `sanpham` WHERE price < {$_REQUEST['priceS']}");
                            }

                            $row = mysqli_fetch_assoc($result);
                            $total_records = $row['total'];

                            $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                            $limit = ($_SESSION['pagin-limit']) ? $_SESSION['pagin-limit'] : 9;

                            $total_page = ceil($total_records / $limit);

                            if($current_page > $total_page) $current_page = 1;
                            elseif($current_page < 1) $current_page = 1;

                            $start = ($current_page - 1) * $limit;

                            $extra = "";

                            $sql = "SELECT * FROM `sanpham` LIMIT $start, $limit";

                            if(isset($_REQUEST['priceS'])) {
                                $sql = "SELECT * FROM `sanpham` WHERE price < {$_REQUEST['priceS']} LIMIT $start, $limit";
                                $extra = "?PriceS={$_REQUEST['priceS']}";

                                if($_REQUEST['priceS'] == 7100) {
                                    $sql ="SELECT * FROM `sanpham` WHERE price BETWEEN 7000 AND 10000 LIMIT $start, $limit";
                                }
                                if($_REQUEST['priceS'] == 10000) {
                                    $sql = "SELECT * FROM `sanpham` WHERE price > 10000 LIMIT $start, $limit";
                                }
                            }

                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)) {
                                echo "
                                    <div class='col-sm-4'>
                                    <div class='product-show'>
                                    <div class='product-image'>
                                        <a href='single-product.php?id=".$row['id']."'><img class='fit' src='".$row['img']."' alt='".$row["name"]."-img'></a>
                                    </div>
                                    <div class='info'>
                                        <p class='product-name h6'><a href='single-product.php?id=".$row['id']."'>".$row['name']."</a></p>
                                        <p class='price'>VND ".number_format($row['price'], 3)."</p>
                                    </div>
                                    </div>
                                    </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class="pagination-cont">
                    <div class="pagin-select">
                        <form action="index.php">
                        <label for="pagin-limit">Hiện thị: </label> 
                        <input type="number" id="pagin-limit" name="pagin-limit" value="<?php echo ($_SESSION['pagin-limit'])? $_SESSION['pagin-limit'] : 9 ?>" min=3 max=9>
                        <input class="btn btn-success" type="submit" value="Ok">
                        </form>
                    </div>
                    <ul class="pagination">
                    <?php 
                        if($current_page > 1 && $total_page > 1) {
                            echo '<li class="page-item"><a href="index.php?page='.($current_page - 1) . $extra.'"><span class="glyphicon glyphicon-chevron-left"></span></a></li>';
                        }

                        for($i = 1; $i <= $total_page; $i++) {
                            if($i == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                echo '<li class="page-item"><a href="index.php?page='.$i . $extra.'">'.$i.'</a></li>';
                            }
                        }
                        if($current_page < $total_page && $total_page > 1) {
                            echo '<li class="page-item"><a href="index.php?page='.($current_page + 1) . $extra.'"><span class="glyphicon glyphicon-chevron-right"></span></a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   </main>
    <?php include("footer.php") ?>
</body>
</html>