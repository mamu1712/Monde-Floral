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
    $product_quantity = $_POST['product_quantity'];

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

            mysqli_query($conn, "INSERT INTO tbl_cart (user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'product added to cart';
        }
    }
}


if (isset($_POST['review_submit'])) {

    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $added_on = date('Y-m-d h:i:s');
    $product_id = $_POST['product_id'];

    $check_products_review = mysqli_query($conn, "SELECT * FROM tbl_products_review WHERE user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_products_review) > 0) {

        $message[] = 'Already Added your Review ';
    } else {
        mysqli_query($conn, "INSERT INTO tbl_products_review (product_id, user_id ,rating, review ,added_on) VALUES('$product_id' ,'$user_id','$rating' ,'$review' ,'$added_on')");

        $message[] = 'Added your Review';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monde Floral | Quick View</title>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">


    <!-- favicon icon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- favicon icon -->
    <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/loader.css">

    <!-- loader  -->
    <!-- <div class="loader-container">
    <img src="images/preloader.gif" alt="">
</div> -->

</head>

<body>

    <?php @include 'header.php'; ?>

    <?php
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $select_products = mysqli_query($conn, "SELECT * FROM tbl_products WHERE id = '$pid'") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
    ?>
                <form action="" method="POST">
                    <div class="container">
                        <div class="product-div">
                            <div class="product-div-left">
                                <div class="img-container">
                                    <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="watch">
                                </div>
                            </div>
                            <div class="product-div-right">
                                <span class="product-name"><?php echo $fetch_products['name']; ?></span>
                                <span class="product-price">₹<?php echo $fetch_products['price']; ?>/-</span>
                                <h2>
                                    <p class="product-description"><?php echo $fetch_products['details']; ?></p>
                                </h2>
                                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                <h1>Quantity:</h1><input type="number" name="product_quantity" value="1" min="0" id="number">

                                <div class="btn-groups">
                                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                                    <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <section>
                    <div class="testimonial-heading">
                        <h1>Customer Reviews</h1>
                    </div>
                    <?php
                    $product_review_list = mysqli_query($conn, "SELECT tbl_users.name , tbl_products_review.rating ,tbl_products_review.review, tbl_products_review.added_on  from tbl_products_review,tbl_users where tbl_products_review.status = 1 and tbl_products_review.user_id= tbl_users.id and tbl_products_review.product_id ='$pid' order by tbl_products_review.added_on DESC");
                    if (mysqli_num_rows($product_review_list) > 0) {
                        while ($product_review_list_row = mysqli_fetch_assoc($product_review_list)) {
                    ?>
                            <div class="testimonial-box-container">
                                <div class="testimonial-box">
                                    <div class="box-top">
                                        <div class="profile">
                                            <div class="name-user">
                                                <strong><?php echo $product_review_list_row['rating']; ?> </strong><span> ( <?php echo $product_review_list_row['name']; ?> )</span><br>
                                                <time>
                                                    <?php
                                                    $added_on = strtotime($product_review_list_row['added_on']);
                                                    echo date('d M Y', $added_on);
                                                    ?>
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="client-comment">
                                        <p><?php echo $product_review_list_row['review']; ?></p>
                                    </div>
                                </div>
                            </div>

                    <?php }
                    } else {
                        echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
                    }
                    ?>

                    <form action="" method="post" class="decor">
                        <div class="form-left-decoration"></div>
                        <div class="form-right-decoration"></div>
                        <div class="circle"></div>
                        <div class="form-inner">
                            <center>
                                <h1>Enter your review</h1><br /><br>
                                <?php
                                if (isset($user_id)) {
                                ?>
                                    <select class="form-control" name="rating" required>
                                        <option value="">Select Rating</option>
                                        <option>Worst</option>
                                        <option>Bad</option>
                                        <option>Good</option>
                                        <option>Very Good</option>
                                        <option>Fantastic</option>
                                    </select> <br />
                                    <textarea name="review" placeholder="Enter your review here..." rows="5"></textarea>
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                                    <input type="submit" value="Add Review" name="review_submit" class="btn">
                            </center>
                        </div>
                    </form>

    <?php } else {
                                    echo "<span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review.</span>";
                                }
                            }
                        } else {
                            echo '<p class="empty">No Review Details available!</p>';
                        }
                    }
    ?>
                </section>

                <?php @include 'footer.php'; ?>

                <script src="js/script.js"></script>
                <script src="js/admin_script.js"></script>
                <script src="js/loader.js"></script>


</body>

</html>