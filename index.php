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
                            $conn = mysqli_connect("localhost","root","mysql","giuaky");
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
                            $row = mysqli_fetch_assoc($result);
                            $total_records = $row['total'];

                            $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                            $limit = 9;

                            $total_page = ceil($total_records / $limit);

                            if($current_page > $total_page) $current_page = 1;
                            elseif($current_page < 1) $current_page = 1;

                            $start = ($current_page - 1) * $limit;
                            $sql = "SELECT * FROM `sanpham` LIMIT $start, $limit";
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
                    <ul class="pagination">
                    <?php 
                        if($current_page > 1 && $total_page > 1) {
                            echo '<li class="page-item"><a href="index.php?page='.($current_page - 1).'"><span class="glyphicon glyphicon-chevron-left"></span></a></li>';
                        }

                        for($i = 1; $i <= $total_page; $i++) {
                            if($i == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                echo '<li class="page-item"><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($current_page < $total_page && $total_page > 1) {
                            echo '<li class="page-item"><a href="index.php?page='.($current_page + 1).'"><span class="glyphicon glyphicon-chevron-right"></span></a></li>';
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