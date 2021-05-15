<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    unset($_SESSION['permission']);

    $conn = mysqli_connect("localhost","root","","doan");
    
    $err ="";
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "SELECT * FROM `taikhoan` WHERE username = '".$_POST['username']."'"; 
        $query = mysqli_query($conn, $sql);
        $info = mysqli_fetch_row($query);
        if($info <= 0) {
            $err = "Người dùng không tồn tại";
        } else {
            if(md5($_POST['password']) == $info[3]) {
                $_SESSION['username'] = $info[1];
                $_SESSION['permission'] = $info[4];
                $_SESSION['userid'] = $info[0];
                header("location:index.php");
            } else {
                $err = "Mật khẩu không chính xác";
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
               <h1 class="text-center">Xin chào</h1>
               <form action="" method="POST">
                   <div class="form-group">
                     <!-- <label for="username">Email</label> -->
                     <input type="text"
                       class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Tên đăng nhập" required>
                   </div>
                    <div class="form-group">
                      <!-- <label for=""></label> -->
                      <input type="password"
                        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Mật khẩu" required>
                    </div>
                    <span class="text-danger"><?php echo $err ?></span>
                    <button type="submit" class="btn btn-submit">Đăng nhập</button>
               </form>
           </div>
       </div>
   </main>
   <?php include("footer.php") ?>
</body>
</html>