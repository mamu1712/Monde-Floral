<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['add_product'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/' . $image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM tbl_products WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already exist!';
   } else {

         if ($image_size > 2000000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folter);
            $insert_product = mysqli_query($conn, "INSERT INTO tbl_products (name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('query failed');
            $message[] = 'product added successfully!';

         

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
   <title>Monde Floral | Add Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

     <!-- favicon icon -->
     <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="add-products">

      <form action="" method="POST" enctype="multipart/form-data">
         <h3>add new product</h3>
         <input type="text" class="box" required placeholder="enter product name" name="name">
         <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
         <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
         <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
         <input type="submit" value="add product" name="add_product" class="btn">
         <a href="admin_products.php" class="option-btn">go back</a>
      </form>

   </section>



   
   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>