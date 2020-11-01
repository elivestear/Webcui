<?php 
    session_start();
    session_unset();

    function isExisted($conn, $username) {
        $sql = "SELECT * FROM `taikhoan`";
        $query = mysqli_query($conn, $sql);
        while($user = mysqli_fetch_assoc($query)) {
            if($username == $user['username']) return true;
        }
        return false;
    }

    $conn = mysqli_connect("localhost","root","mysql","giuaky");
    $err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['password'] != $_POST['repassword']) {
            $err = "Mật khẩu không trùng khớp";
        } else {
            if(!isExisted($conn, $_POST['username'])) {
                $sql = "INSERT INTO `taikhoan`(`username`,`email`,`password`,`permission`) VALUES ('".$_POST['username']."','".$_POST['email']."','". md5($_POST['repassword']) ."',0)";
                $query = mysqli_query($conn, $sql);
                echo "<script>window.alert('Đăng ký thành công')</script>";
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['permission'] = 0;
                header("location:index.php");
            } else {
                $err = "Tên đăng nhập đã tồn tại";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <?php include("import.php") ?>
</head>
<body>
    <header>
        <?php include("header.php"); ?>
   </header>

   <main>
       <div class="container">
           <div class="form">
               <h1 class="text-center">Chào mừng</h1>
               <form action="" method="POST">
                   <div class="form-group">
                     <!-- <label for="username">Email</label> -->
                     <input type="text"
                       class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Tên đăng nhập" required>
                   </div>
                   <div class="form-group">
                     <!-- <label for=""></label> -->
                     <input type="email"
                       class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Địa chỉ Email" required>
                   </div>
                    <div class="form-group">
                      <!-- <label for=""></label> -->
                      <input type="password"
                        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Mật khẩu" required>
                    </div>
                    <div class="form-group">
                      <!-- <label for=""></label> -->
                      <input type="password"
                        class="form-control" name="repassword" id="repassword" aria-describedby="helpId" placeholder="Nhập lại Mật khẩu" required>
                    </div>
                    <span class="text-danger"><?php echo $err ?></span>
                    <button type="submit" class="btn btn-submit">Đăng ký</button>
                    <br> <br>
                    <button type="reset" class="btn btn-submit">Hủy</button>
               </form>
           </div>
       </div>
   </main>
   <?php include("footer.php") ?>
</body>
</html>