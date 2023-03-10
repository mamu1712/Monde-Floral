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
      $insert_product = mysqli_query($conn, "INSERT INTO tbl_products (name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('query failed');

      if ($insert_product) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'product added successfully!';
         }
      }
   }
}

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM tbl_products WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM tbl_products WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM tbl_wishlist WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM tbl_cart WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Monde Floral | Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- favicon icon -->
   <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>
   <br>
   <br>

   <section class="placed-orders">
      <h1 class="title">Products</h1>
      <div class="container-xl">
         <div class="table-responsive">
            <div class="table-wrapper">
               <a href="admin_add_products.php" class="addproduct">Add Products</a>
               <table class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Price(₹)</th>

                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $select_products = mysqli_query($conn, "SELECT * FROM tbl_products ") or die('query failed');
                     if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                     ?>
                           <tr>
                              <td><?php echo $fetch_products['id']; ?></td>
                              <td><a><?php echo $fetch_products['name']; ?></a></td>
                              <td><img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="imageproduct"></td>
                              <td><?php echo $fetch_products['details']; ?></td>
                              <td>₹<?php echo  $fetch_products['price']; ?></td>
                              <td><a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>"><i class="fa fa-pencil" style="color:green;" aria-hidden="true"></i></a></td>
                              <td><a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" onclick="return confirm('delete this product?');"><i class="fa fa-trash" style="color: red;" aria-hidden="true"></i></a></td>

                           </tr>
                     <?php
                        }
                     } else {
                        echo '<p class="empty">No Products Added Yet!</p>';
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>