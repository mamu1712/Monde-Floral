<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM tbl_cart WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE tbl_cart SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monde Floral | Shopping Cart</title>

     <!-- favicon icon -->
   <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/loader.css">

      <!-- favicon icon -->
   <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

              <!-- loader  -->
<!-- <div class="loader-container">
    <img src="images/preloader.gif" alt="">
</div> -->

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Shopping cart</h3>
        <p> <a href="home.php">Home</a> / Cart </p>
    </section>

    <section class="shopping-cart">

        <h1 class="title">Products Added</h1>

        <div class="box-container">

            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <form action="" method="POST" class="box">
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="image">
                                        <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
                                    </a>
                                </div>
                                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete This From Cart?');"></a>
                                <div class="product-content">
                                    <h3 class="title"><a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>"><?php echo $fetch_cart['name']; ?></a></h3>
                                    <div class="price"> ₹<?php echo $fetch_cart['price']; ?>/-</div>

                                    <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                                    <input type="number" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" min="1" id="number">
                                    <input type="submit" value="update"  name="update_quantity" class="update_quantity-btn">

                                    <div class="sub-total"> Sub-total : <span>₹<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Your cart is empty</p>';
            }
            ?>
        </div>

        <div class="more-btn">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>" onclick="return confirm('delete all from cart?');">Delete All</a>
        </div>

        <div class="cart-total">
            <p>Grand Total : <span> ₹<?php echo $grand_total; ?>/-</span></p>
            <a href="shop.php" class="option-btn">Continue Shopping</a>
            <a href="checkout.php" class="btn  <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">Proceed to Checkout</a>
        </div>

    </section>






    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
    <script src="js/admin_script.js"></script>
    <script src="js/loader.js"></script>

</body>

</html>