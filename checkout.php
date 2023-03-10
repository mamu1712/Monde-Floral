<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};


if(isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = 'Cash on delivery';
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] .',' . $_POST['state'] . ','. $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        mysqli_query($conn, "INSERT INTO tbl_orders (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
        header('location:.php');

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monde Floral | Checkout</title>

     <!-- favicon icon -->
   <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

      <!-- favicon icon -->
   <link rel="shortcut icon" href="flowers/favicon.ico" type="image/x-icon">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>Checkout Order</h3>
        <p> <a href="home.php">Home</a> / Checkout </p>
    </section>

    <section>

    <?php

    $user_detail_query = mysqli_query($conn,"SELECT * FROM tbl_users WHERE id = '$user_id'") or die('query failed');
    $user_detail = mysqli_fetch_assoc($user_detail_query);
    
    ?>
        <div class="row">
            <div class="col-75">
                <div class="containers">
                    <form action="" method="POST">
                        <div class="col-50">
                            <h3>Billing Address</h3><br>
                        </div>
                        <div class="col-50">
                            <br><br>

                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" name="name" placeholder="enter your name" value="<?php echo $user_detail['name']; ?>"  required >

                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" placeholder="xyz@example.com" value="<?php echo $user_detail['email']; ?>" required>

                            <label for="fname"><i class="fa fa-mobile"></i> Your Number</label>
                            <input type="number" name="number" min="0" placeholder="enter your number" required>

                            <label for="ccnum">Payment Method :</label>
                            <div class="inputBox">
                                Cash on delivery
                            </div>
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address line 01</label>
                            <input type="text" name="flat" placeholder="e.g. flat no." required>

                            <label for="expmonth">Address line 02</label>
                            <input type="text" name="street" placeholder="e.g.streen name">

                            <div class="row">
                                <div class="col-50">
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" name="city" placeholder="e.g. mumbai" required>
                                </div>
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" name="state" placeholder="e.g. maharashtra" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-50">

                                    <label for="zip">Country</label>
                                    <input type="text" name="country" placeholder="e.g. india">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="pin_code" placeholder="10001" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="order" value="order now" class="btn">
                    </form>
                </div>
            </div>

            <div class="col-25">
                <div class="containers">
                    <h1> Cart <?php

                                $grand_total = 0;
                                $select_cart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE user_id = '$user_id'") or die('query failed');

                                ?>
                        <span class="price" style="color:black">
                            <i class="fa fa-shopping-cart"></i>
                            <b><?php echo mysqli_num_rows($select_cart); ?></b>
                        </span>
                    </h1>
                    <?php
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total += $total_price;
                    ?>
                           <h2> <p>x<?php echo $fetch_cart['quantity']; ?> <a><?php echo $fetch_cart['name']; ?></a> <span class="price"> ₹<?php echo $fetch_cart['price']; ?>/-</span></p> </h2>

                            <hr>

                    <?php
                        }
                    } else {
                        echo '<p class="empty">your cart is empty</p>';
                    }
                    ?>
                   <h1> <p>Total <span class="price" style="color:black"><b> ₹<?php echo $grand_total; ?>/-</b></span></p> </h1>
                </div>
            </div>
        </div>

    </section>



    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>