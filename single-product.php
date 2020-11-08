<?php
    session_start();

    $productid = "";
    $disable = "";
    $notfound = "";
    $conn = mysqli_connect("localhost","root","mysql","giuaky");
    if(isset($_POST['editor'])) {
        $edit = "UPDATE `sanpham` SET `descript` = '" . $_POST['editor'] .  "' WHERE `sanpham`.`id` =". $_REQUEST['id'];
        $update = mysqli_query($conn, $edit); 
    } 
    $sql = "";
    $query = null;
    if(isset($_REQUEST['id'])) {
        $sql = "SELECT * FROM sanpham WHERE id =".$_REQUEST['id'];
        $query = mysqli_query($conn, $sql);
    } elseif(isset($_REQUEST['nameSearch']) && !empty($_REQUEST['nameSearch']) ) {
        $sql = "SELECT * FROM sanpham WHERE `name` ='".$_REQUEST['nameSearch']."'";
        $query = mysqli_query($conn, $sql);
    } else {
        $disable = "disabled";
        $notfound = "<h1 class='text-danger'>Không tìm thấy sản phẩm</h1>";
    }
    if(isset($query)) {
    $product = mysqli_fetch_assoc($query);
    if(!isset($product)) $notfound = "<h1 class='text-danger'>Không tìm thấy sản phẩm</h1>";
    }

    $productid = $product["id"];
    $name = $product["name"];
    $category = $product["CategoryID"];
    $price = $product["price"];
    $description = $product["descript"];
    $image = $product["img"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?></title>
    <?php include("import.php") ?>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>
<body>
   <header>
    <?php include("header.php"); ?>
   </header>

    <main>
        <div class="container">
        <?php echo $notfound ?>
            <div class="row">
                <div class="col-sm-5">
                    <div class="productImg"> 
                        <img class="fit" src="<?php echo $image ?>" alt="anh san pham">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="productDetail">
                        <h1 class="text-uppercase"><?php echo $name ?></h1>
                        <p class="price"><?php echo number_format($price, 3) ?> VND 
                            <a class="addBtn" href="add.php?item=<?php echo $productid ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                            </a>
                        </p>
                        <p class="desC"><?php echo $description ?></p>
                        <div class="hide" id="editCont">
                            <form action="" method="POST">
                                <textarea name="editor" id="editor"><?php echo $description ?></textarea>
                                <script>
                                    CKEDITOR.replace( 'editor' );
                                </script>
                                <div class="text-right"><input class="btn btn-done" type="submit" value="Hoàn tất"></div>
                            </form>
                            <hr>
                        </div>
                        <?php 
                            if($_SESSION['permission'] == 1 || $_SESSION['permission'] == 2)
                                echo '<p><button onclick="editToggle()" id="editBtn" class="btn btn-primary mt-1">Sửa mô tả</button></p>
                                '; 
                        ?>
                        <script>
                        function editToggle() {
                            let editor = document.getElementById('editCont');
                            if(editor.classList.contains('hide')) {
                                editor.classList.remove('hide');
                                document.getElementById('editBtn').innerHTML="Đóng";
                            } else {
                                document.getElementById('editBtn').innerHTML="Sửa mô tả";
                                editor.classList.add('hide');
                            }
                        }
                    </script>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-8">
                    <div class="comment-section">
                        <div class="comments" id="comments">
                            <?php 
                                if(isset($productid)) {
                                    $sql = "SELECT * FROM `comment` WHERE IDproduct =".$productid;
                                    $query = mysqli_query($conn, $sql);
                                    $userid = $_SESSION['userid'];
                                    while($cmt = mysqli_fetch_assoc($query)) {
                                    $comment = $cmt['cmt'];
                                    $date = $cmt['date'];
                                    $sql2 = "SELECT id, username FROM `taikhoan` WHERE id = ".$cmt['userID'];
                                    $query2 = mysqli_query($conn, $sql2);
                                    $userinfo = mysqli_fetch_row($query2);
                                    $user = $userinfo[1];

                                    //render
                                    echo "
                                        <div class='comment'>
                                            <p class='cmt-user'><span class='glyphicon glyphicon-user'></span>".$user."<span class='text-muted small'> - ".$date."</span></p>
                                            <div class='cmt-commment'>
                                                ".$comment."
                                            </div>                                         
                                        </div>
                                    ";
                                }
                                }
                            ?>
                        </div>
                        <div class="comment-form">
                                <h3>Đăng bình luận của bạn</h3>
                                <textarea name="post" id="post" rows="5"></textarea>
                                <?php
                                    if(isset($_SESSION['username'])) {
                                        ?>
                                        <button class="btn btn-primary" onclick="load();" <?php echo $disable ?>>Đăng</button>
                                        <?php
                                    }
                                ?>
                                <script>
                                    function load() {
                                        let cmt = document.getElementById("post").value;
                                        console.log(cmt);
                                        let url = "loadComment.php?userid=<?php echo $userid ?>&productid=<?php echo $productid ?>&cmt=" + cmt;
                                        loadDoc(url, loadCmt);
                                        document.getElementById("post").value = "";
                                    }
                                </script>
                            </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h1>Liên quan</h1>
                    <div class="related-product">
                        <?php 
                            if(isset($productid)) {
                                $query = "SELECT * FROM `sanpham` WHERE CategoryID =".$category." AND id <>".$productid ." LIMIT 3";
                            $sql = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_assoc($sql)) {
                                echo "
                                    <div class='product-show'>
                                    <div class='product-image'>
                                        <a href='single-product.php?id=".$row['id']."'><img class='fit' src='".$row['img']."' alt='".$row["name"]."-img'></a>
                                    </div>
                                    <div class='info'>
                                        <p class='product-name h6'><a href='single-product.php?id=".$row['id']."'>".$row['name']."</a></p>
                                        <p class='price'>VND ".number_format($row['price'], 3)."</p>
                                    </div>
                                    </div>
                                ";
                            }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include("footer.php") ?>
    <script src="js/ajax.js"></script>
</body>
</html>