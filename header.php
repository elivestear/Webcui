<?php 
    session_start();
    $conn = mysqli_connect("localhost","root","mysql","giuaky");
    $sql = "SELECT * FROM `danhmuc`";
    $query = mysqli_query($conn, $sql);
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand clouds" href="#">VipPro</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a class="clouds" href="index.php">Trang chủ</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle clouds" data-toggle="dropdown" href="#">Sản phẩm
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="products.php">Tất cả</a></li>
            <?php 
                while($row = mysqli_fetch_assoc($query)) {
                    echo "<li><a href='products.php?category=".$row['id']."'>".$row['name']."</a></li>";
                }
            ?>
        </ul>
      </li>
      <!-- <li><a class="clouds" href="#">Thông tin</a></li> -->
      <li ><a class="sun-fl" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ Hàng</a></li>
    </ul>
    <form autocomplete="off" class="navbar-form navbar-left" action="single-product.php">
        <div class="autocomplete input-group">
            <input type="text" id="nameSearch" name="nameSearch" class="form-control" placeholder="Search">
            <?php
              $arr = ''; 
              $query = mysqli_query($conn, "SELECT * FROM `sanpham`");
              while($product = mysqli_fetch_assoc($query)) {
                $arr.= '"'.$product['name'].'",';
              }
              echo "<script>
                    var names = [".$arr."];
                    autocomplete(document.getElementById('nameSearch'), names);
                    </script>";
            ?>
            <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
            </div>
        </div>
    </form>
    <?php
      if($_SESSION['permission'] == 1) {
        ?>
        <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle clouds" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Quản lý<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="manage-product.php">Hàng hóa</a></li>
            <li><a href="#">Danh mục</a></li>
            <li><a href="#">Tài khoản</a></li>
        </ul>
      </li>
    </ul>
    <?php
      }
    ?>
    <ul class="nav navbar-nav navbar-right">
      <?php 
        if(isset($_SESSION['username'])) {
          ?>
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?> </a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span></a></li>
      <?php 
        } else {
        ?>
          <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a></li>
          <li><a href="register.php"><span class="glyphicon glyphicon-pencil"></span> Đăng ký</a></li>  
        <?php
        }
      ?>
    </ul>
  </div>
</nav>

<div>
  <div class="hero">
    <div class="hero-text">
      <h1>Chào mừng đến với VipPro</h1>
      <p>Thích thì mua, không thích thì xem</p>
      <a class="btn btn-1" href="products.php">Mua sắm ngay</a>
    </div>
  </div>
</div>