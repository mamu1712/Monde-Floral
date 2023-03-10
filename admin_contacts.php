<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM tbl_message WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Monde Floral | Contact Us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- favicon icon -->
   <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="messages">

      <h1 class="title">Messages</h1>

      <div class="box-container">

         <?php
         $select_message = mysqli_query($conn, "SELECT * FROM tbl_message") or die('query failed');
         if (mysqli_num_rows($select_message) > 0) {
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
         ?>
               <div class="box">
                  <p>User Id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
                  <p>Name : <span><?php echo $fetch_message['name']; ?></span> </p>
                  <p>Number : <span><?php echo $fetch_message['number']; ?></span> </p>
                  <p>Email : <span><?php echo $fetch_message['email']; ?></span> </p>
                  <p>Message : <span><?php echo $fetch_message['message']; ?></span> </p>
                  <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">you have no messages!</p>';
         }
         ?>
      </div>

   </section>

   <!-- <section class="placed-orders">
      <h1 class="title">Products</h1>
      <div class="container-xl">
         <div class="table-responsive">
            <div class="table-wrapper">
               <table class="table table-striped table-hover">
                  <thead>
                     <tr>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Message</th>

                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     // $select_message = mysqli_query($conn, "SELECT * FROM tbl_message") or die('query failed');
                     // if (mysqli_num_rows($select_message) > 0) {
                     //    while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                     ?>
                           <tr>
                              <td><?php // echo $fetch_message['id']; ?></td>
                              <td><a><?php // echo $fetch_message['name']; ?></a></td>
                              <td><a><?php // echo $fetch_message['email']; ?></a></td>
                              <td><?php // echo $fetch_message['number']; ?></td>
                              <td><?php // echo  $fetch_message['message']; ?></td>
                              <td><a href="admin_contacts.php?delete=<?php // echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');"><i class="fa fa-trash" style="color: red;" aria-hidden="true"></a></td>

                           </tr>
                     <?php
                     //    }
                     // } else {
                     //    echo '<p class="empty">You Have No Messages!</p>';
                     // }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section> -->











   <script src="js/admin_script.js"></script>

</body>

</html>