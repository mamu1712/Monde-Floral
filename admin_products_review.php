<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

$condition = '';
$condition1 = '';
$condition = " and product.added_by='" . $_SESSION['admin_id'] . "'";
$condition1 = " and added_by='" . $_SESSION['admin_id'] . "'";

if (isset($_GET['type']) && $_GET['type'] != '') {

    $type = $_GET['type'];
    if ($type == 'status') {
        $operation =  $_GET['operation'];
        $id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = mysqli_query($conn, "UPDATE tbl_products_review  SET status='$status' where id='$id' ") or die('query failed');

    }
}

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
    <title>Monde Floral | Dashboard</title>

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

        <h1 class="title">Products Review</h1>

        <div class="box-container">

            <?php
            $product_review_list = mysqli_query($conn, "SELECT tbl_users.name ,tbl_products_review.id, tbl_products_review.status, tbl_products_review.rating ,tbl_products_review.review, tbl_products_review.added_on  from tbl_products_review,tbl_users where  tbl_products_review.user_id = tbl_users.id  order by tbl_products_review.added_on DESC");
            if (mysqli_num_rows($product_review_list) > 0) {
                while ($product_review_list_row = mysqli_fetch_assoc($product_review_list)) {
            ?>

                    <div class="box">
                        <p>Product Review id : <span><?php echo $product_review_list_row['id']; ?></span> </p>
                        <p>User Name : <span><?php echo $product_review_list_row['name']; ?></span> </p>
                        <p>Rating : <span><?php echo $product_review_list_row['rating']; ?></span> </p>
                        <p>Review : <span><?php echo $product_review_list_row['review']; ?></span> </p>
                        <p>Add On : <span><?php $added_on = strtotime($product_review_list_row['added_on']);
                                            echo date('d M Y', $added_on); ?></span> </p>
                        <p>Status : <span><?php echo $product_review_list_row['status']; ?></span> </p>

                        <a href="admin_contacts.php?delete=<?php echo $product_review_list_row['id']; ?>" onclick="return confirm('Delete This Products Review?');" class="delete-btn">delete</a>


                        <?php
                        if ($product_review_list_row['status'] == 1) {
                            echo "<span class='btn'><a href='?type=status&operation=deactive&id=" . $product_review_list_row['id'] . "'>Active</a></span>&nbsp;";
                        } else {
                            echo "<span class='btn'><a href='?type=status&operation=active&id=" . $product_review_list_row['id'] . "'>Deactive</a></span>&nbsp;";
                        }

                        ?>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">You have No Product Review!</p>';
            }
            ?>
        </div>

    </section>


    <script src="js/admin_script.js"></script>

</body>

</html>