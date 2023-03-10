<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monde Floral | Orders</title>

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

    <section class="heading">
        <h3>your orders</h3>
        <p> <a href="home.php">home</a> / order </p>
    </section>

    <section class="placed-orders">
        <h1 class="title">placed orders</h1>
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Orders Id</th>
                                <th>Name</th>
                                <th>Order Date</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Your Orders</th>
                                <th>Price</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_orders = mysqli_query($conn, "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY payment_status = 'completed'") or die('query failed');
                            if (mysqli_num_rows($select_orders) > 0) {
                                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                            ?>
                                    <tr>
                                        <td><?php echo $fetch_orders['id']; ?></td>
                                        <td><a><?php echo $fetch_orders['name']; ?></a></td>
                                        <td><?php echo $fetch_orders['placed_on']; ?></td>
                                        <td><?php echo $fetch_orders['number']; ?></td>
                                        <td><?php echo $fetch_orders['email']; ?></td>
                                        <td><?php echo $fetch_orders['address']; ?></td>
                                        <td><?php echo $fetch_orders['total_products']; ?></td>
                                        <td><?php echo $fetch_orders['total_price']; ?></td>
                                        <td><?php echo $fetch_orders['method']; ?></td>
                                        <td><span class="status text-success" style="font-size:13px"><span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                                                                            echo 'tomato';
                                                                                                                        } else {
                                                                                                                            echo 'green';
                                                                                                                        } ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<p class="empty">no orders placed yet!</p>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>
    <script src="js/admin_script.js"></script>
    <script src="js/loader.js"></script>

</body>

</html>