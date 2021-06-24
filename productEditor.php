<?php
    $ID = $_REQUEST['id'];
    $conn = mysqli_connect('localhost', 'root','doan');

    if(isset($_POST['submitform'])) {
        $edited = "UPDATE `sanpham` SET 
        `name` = '".$_POST['pname']."', 
        `CategoryID` = '".$_POST['cateId']."',  
        `quantity` = '".$_POST['quantity']."', 
        `price` = '".$_POST['price']."', 
        `img` = '".$_POST['pimage']."',
        `descript` = '".$_POST['describe']."' 
        WHERE `sanpham`.`id` =".$ID;

        $update = mysqli_query($conn, $edited);
        if($update) header("location:manage-product.php");
    }

    $query = "SELECT * FROM `sanpham` WHERE id =".$ID;
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $name = $result['name'];
    $cateId = $result['CategoryID'];
    $quantity = $result['quantity'];
    $price = $result['price'];
    $describe = $result['descript'];
    $image = $result['img'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa</title>
    <?php include("import.php") ?>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <style>
        .hide {
            display: none;
        }
        label {
            font-size: 2em;
            font-weight: bold;
        }
        @media screen and (max-width: 720px) {
            label {
                display: none;
            }
            h3 {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <h1 class="text-center mt-3">Chỉnh sửa : <span class="text-muted font-italic"><?php echo $ID ."-". $name ?></span></h1>

        <div class="container">
            <div class="editorCont">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">ID: </label>
                        <input type="number" class="form-control" name="id" id="id" value="<?php echo $ID ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên sản phẩm: </label>
                        <input type="text" class="form-control" name="pname" id="pname" placeholder="Tên sản phẩm" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="cateId">Danh mục: </label>
                        <select class="form-control" name="cateId" id="cateId">
                            <?php
                                $browse = "SELECT * FROM danhmuc";
                                $browser = mysqli_query($conn, $browse);
                                while($row = mysqli_fetch_assoc($browser)) {
                                    $selected ="";
                                    if($row['id'] == $cateId) {
                                        $selected = 'selected';
                                    }
                                    echo '<option value ="'.$row['id'].'"'.$selected.'>'.$row['tendanhmuc'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng: </label>
                        <input type="number" min="0" class="form-control" name="quantity" id="quantity" placeholder="Số lượng" value="<?php echo $quantity ?>">
                    </div>
                    <div  class="form-group">
                        <label for="price">Đơn giá: </label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Đơn giá" value="<?php echo $price ?>">
                    </div>
                    <div class="form-group">
                        <div><label for="describe">Mô tả: </label></div>
                        <textarea placeholder="Mô tả" name="describe" id="describe"><?php echo $describe ?></textarea>
                            <script>
                                CKEDITOR.replace( 'describe' );
                            </script>
                    </div>
                    <div class="form-group">
                        <label for="image">Link ảnh: </label>
                        <input placeholder="Link ảnh" type="text" class="form-control" name="pimage" id="pimage" value="<?php echo $image ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-warning w-100" name="submitform" type="submit" value="Hoàn tất">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>