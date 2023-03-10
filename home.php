<?php

@include 'config.php';

session_start();

@$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_wishlist'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM tbl_wishlist WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (!isset($user_id)) {
      header('location:login.php');
   } else {
      if (mysqli_num_rows($check_wishlist_numbers) > 0) {
         $message[] = 'already added to wishlist';
      } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
         $message[] = 'already added to cart';
      } else {
         mysqli_query($conn, "INSERT INTO tbl_wishlist (user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
         $message[] = 'product added to wishlist';
      }
   }
}

if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (!isset($user_id)) {
      header('location:login.php');
   } else {
      if (mysqli_num_rows($check_cart_numbers) > 0) {
         $message[] = 'already added to cart';
      } else {

         $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM tbl_wishlist WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

         if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            mysqli_query($conn, "DELETE FROM tbl_wishlist WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
         }

         mysqli_query($conn, "INSERT INTO tbl_cart (user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
         $message[] = 'product added to cart';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Monde Floral | Home</title>

   <!-- favicon icon -->
   <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/loader.css">

   


   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- loader  -->
   <!-- <div class="loader-container">
    <img src="images/preloader.gif" alt="">
</div> -->


</head>

<body>

   <?php @include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <!-- <h3>Welcome</h3> -->
         <!-- <p>‘Monde Floral’ is glad to give quality flowers and plants to our customers.</p> -->
         <!-- <a href="about.php" class="btn">discover more</a> -->
      </div>

   </section>

   <section class="icons-container">

      <div class="icons">
         <img src="images/icon-1.png" alt="">
         <div class="info">
            <h3>FREE SHIPING</h3>
            <span>Orders over ₹500</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-2.png" alt="">
         <div class="info">
            <h3>FREE RETURN</h3>
            <span>Within 7 days returns</span>
         </div>
      </div>



      <div class="icons">
         <img src="images/icon-4.png" alt="">
         <div class="info">
            <h3>SECURE PAYMENT</h3>
            <span>100% secure payment</span>
         </div>
      </div>

      <div class="icons">
         <img src="images/icon-3.png" alt="">
         <div class="info">
            <h3>BEST PEICE</h3>
            <span>Guaranteed price</span>
         </div>
      </div>

   </section>


   <section >    
   <h1 class="title">latest products</h1>

      <div class="container">
         <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM tbl_products LIMIT 4") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                  <form action="" method="POST" class="box">
                     <div class="col-md-3 col-sm-6">
                        <div class="product-grid">
                           <div class="product-image">
                              <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="image">
                                 <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                              </a>
                           </div>
                           <div class="product-content">
                              <h3 class="title"><a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>"><?php echo $fetch_products['name']; ?></a></h3>
                              <div class="price"> ₹<?php echo $fetch_products['price']; ?>/-</div>
                              <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                              <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                              <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                              <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                              <input type="submit" value="ADD TO CART" name="add_to_cart" class="add-to-cart">
                              <input type="submit" value="ADD TO WISHLIST" name="add_to_wishlist" class="add-to-wishlist">
                           </div>
                        </div>
                     </div>
                  </form>
            <?php
               }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>
         </div>
      </div>

      <div class="more-btn">
         <a href="shop.php" class="btn">load more</a>
      </div>
   </section>




   <section class="home-contact">

      <div class="content">
         <h3>have any questions?</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio officia aliquam quis saepe? Quia, libero.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </section>




   <?php @include 'footer.php'; ?>

   <script src="js/script.js"></script>
   <script src="js/admin_script.js"></script>
   <script src="js/loader.js"></script>


</body>

</html>