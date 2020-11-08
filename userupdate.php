<?php
    $ID = $_REQUEST['id'];
    $conn = mysqli_connect('localhost', 'root','mysql','giuaky');

    if(isset($_POST['submitform'])) {
        $edited = "UPDATE `taikhoan` SET 
        `username` = '".$_POST['username']."', 
        `email` = '".$_POST['email']."', 
        `permission` = '".$_POST['permission']."'
        WHERE `taikhoan`.`id` =".$ID;

        $update = mysqli_query($conn, $edited);
        if($update) header("location:manage-account.php");
    }

    $query = "SELECT * FROM `taikhoan` WHERE id =".$ID;
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $name = $result['username'];
    $email = $result['email'];
    $quantity = $result['permission'];

    $isadmin = $result['permission'] == 1? "selected" : "";
    $iseditor = $result['permission'] == 2? "selected" : "";
    $iscustomer = $result['permission'] == 0? "selected" : "";
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
        <h1 class="text-center mt-3">Chỉnh sửa : <span class="text-muted font-italic"><?php echo $name ?></span></h1>

        <div class="container">
            <div class="editorCont">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">ID: </label>
                        <input type="number" class="form-control" name="id" id="id" value="<?php echo $ID ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên người dùng: </label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Tên người dùng" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Email: </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Quyền hạn: </label>
                        <select class="form-control" name="permission" id="permission">
                            <option value="1" <?php echo $isadmin ?> >Quản trị viên</option>
                            <option value="2" <?php echo $iseditor ?>>Người chỉnh sửa</option>
                            <option value="0" <?php echo $iscustomer ?>>Người dùng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-warning w-100" name="submitform" type="submit" value="Hoàn tất">
                        <a class="btn btn-primary" href="manage-account.php">Về trang quản lý</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>