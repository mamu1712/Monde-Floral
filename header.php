<?php
@include 'config.php';

session_start();

@$user_id = $_SESSION['user_id'];

if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    
</body>
</html>
  <style>
    .logo {
    margin-top: -0.2%;
    margin-right: -3%;
    margin-left: -4%;
}
     
      .img1{
        margin-bottom: -10%;
        margin-right: -5%;
        height: 50px;
        width: 50px;
        margin-top: -10%;
      }
     
    
  </style>

<header class="header">

    <div class="flex">

    <img src="images/flowerlogo.png" alt="" class="img1"><a href="home.php" class="logo" style="text-decoration: none;">Monde Floral</a>

    

    

        <nav class="navbar navbar2 ">
            <ul>
                <li><a href="home.php" style="text-decoration: none;">home</a></li>
                <li><a href="shop.php" style="text-decoration: none;">shop</a></li>
                <?php
                if (isset($user_id)) {
                ?>
                    <li><a href="orders.php" style="text-decoration: none;">orders</a></li>
                <?php } ?>

                <li><a href="#" style="text-decoration: none;">pages +</a>
                    <ul>
                        <li><a href="about.php" style="text-decoration: none;">about</a></li>
                        <li><a href="contact.php" style="text-decoration: none;">contact</a></li>
                    </ul>
                </li>
                <?php
                if (!isset($user_id)) {
                ?>
                    <li><a href="#" style="text-decoration: none;">account +</a>
                        <ul>
                            <li><a href="login.php" style="text-decoration: none;">login</a></li>
                            <li><a href="register.php" style="text-decoration: none;">register</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars" style="text-decoration: none;"></div>
            <a href="search_page.php" class="fas fa-search" style="text-decoration: none;"></a>
            <?php
              if(isset($user_id)){
              ?>
            <div id="user-btn" class="fas fa-user" style="text-decoration: none" ></div>
            <?php }?>
            <?php
            $select_wishlist_count = mysqli_query($conn, "SELECT * FROM tbl_wishlist WHERE user_id = '$user_id'") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart" style="text-decoration: none;"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
            $select_cart_count = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart" style="text-decoration: none;"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

    <script src="js/admin_script.js"></script>
    <script src="js/script.js"></script>

</header>