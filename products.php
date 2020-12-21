<?php 
    session_start();
    $conn = mysqli_connect("localhost","root","mysql","giuaky");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <?php include("import.php") ?>
</head>
<body>
    <header>
        <?php include("header.php") ?>
    </header>

    <main>
        <div class="container">
            <?php
                if(isset($_REQUEST['category'])){

                    $result = mysqli_query($conn,"SELECT SUM(if(CategoryID = '".$_REQUEST['category']."', 1, 0)) as total from `sanpham`");
                    $info = mysqli_fetch_assoc($result);
                    $category_records = $info['total'];
                    $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
                    $limit = ($_SESSION['pagin-limit']) ? $_SESSION['pagin-limit'] : 9;

                    $total_page = ceil($category_records / $limit);

                    if($current_page > $total_page) {
                        $current_page = $total_page;
                    } elseif($current_page < 1 ) {
                        $current_page = 1;
                    }

                    $start = ($current_page - 1) * $limit;

                    $category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `danhmuc` WHERE id =".$_REQUEST['category']));
                    echo "<h1 class='category-bg'>".$category['name']."</h1>";
                    echo "<div class='row'>";
                    $sql2 = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE CategoryID =".$category['id']." LIMIT $start, $limit");
                    while($product = mysqli_fetch_assoc($sql2)) {
                        echo "
                            <div class='col-sm-4'>
                            <div class='product-show'>
                            <div class='product-image'>
                                <a href='single-product.php?id=".$product['id']."'>
                                    <img class='fit' src='".$product['img']."' alt='".$product["name"]."-img'>
                                </a>
                            </div>
                            <div class='info'>
                                <p class='product-name'><a href='single-product.php?id=".$product['id']."'>".$product['name']."</a></p>
                                <p class='price'>VND ".number_format($product['price'], 3)."</p>
                            </div>
                            </div>
                            </div>
                            ";
                    }
                    echo "</div>";
                    echo '<div class="pagination-cont">';
                    echo '<ul class="pagination">';
                     
                        if($current_page > 1 && $total_page > 1) {
                            echo '<li class="page-item"><a href="products.php?category='.$_REQUEST['category'].'&page='.($current_page - 1).'"><span class="glyphicon glyphicon-chevron-left"></span></a></li>';
                        }
                        for($i = 1; $i <= $total_page; $i++) {
                            if($i == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                echo '<li class="page-item"><a href="products.php?category='.$_REQUEST['category'].'&page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($current_page < $total_page && $total_page > 1) {
                            echo '<li class="page-item"><a href="products.php?category='.$_REQUEST['category'].'&page='.($current_page + 1).'"><span class="glyphicon glyphicon-chevron-right"></span></a></li>';
                        }
                    
                    echo '</ul>';
                    echo '</div>';
                } else {
                    $sql = mysqli_query($conn, "SELECT * FROM `danhmuc`");
                    while($category = mysqli_fetch_assoc($sql)) {
                        echo "<h1 class='category-bg'>".$category['name']."</h1>";
                        echo "<div class='row'>";
                        $querystr = "SELECT * FROM `sanpham` WHERE CategoryID =".$category['id']." LIMIT 6";
                        $sql2 = mysqli_query($conn, $querystr);
                        while($product = mysqli_fetch_assoc($sql2)) {
                            echo "
                                <div class='col-sm-4'>
                                <div class='product-show'>
                                <div class='product-image'>
                                    <a href='single-product.php?id=".$product['id']."'>
                                        <img class='fit' src='".$product['img']."' alt='".$product["name"]."-img'>
                                    </a>
                                </div>
                                <div class='info'>
                                    <p class='product-name'><a href='single-product.php?id=".$product['id']."'>".$product['name']."</a></p>
                                    <p class='price'>VND ".number_format($product['price'], 3)."</p>
                                </div>
                                </div>
                                </div>
                                ";
                        }
                        echo "</div>";
                        echo "<div class='viewmoreBtn'><a href='products.php?category=".$category['id']."'>Xem thêm</a></div>";
                    }
                }
            ?>
        </div>
    </main>

    <?php include("footer.php") ?>
</body>
</html>