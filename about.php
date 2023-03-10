<?php

@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Monde Floral | About</title>

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
    <h3>about us</h3>
    <p> <a href="home.php">home</a> / about </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p> We have successfully provided flowers for many weddings and occasions, small to large. We know the flower business inside out and will work with you relentlessly to find the most suitable flowers, bouquets styles, arrangements, displays, buttonholes and corsages to make your perfect wedding or event.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>1. Convenience Online flower delivery services are all about convenience <br>
               2. A Variety of Choices <br>
               3. Round the Clock Service <br>
               4. Affordable Prices <br>
               5. Saves Time <br>
               6. Proper Transport Conditions</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>In the early years, ‘Monde Floral’ was a little flower specialist scarcely serving clients inside a mile sweep and attempting to endure, yet there was an extraordinary potential. Executives had a dream and chose to hold on and put each asset into their arrangement for the business.</p>
            <a href="#reviews" class="btn">clients reviews</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">client's reviews</h1>

    <div class="box-container">

        <div class="box" style="height: 100%;" >
            <img src="images/pic-1.png" alt="">
            <p>One of the best online florist I have ever dealt with! The customer service is beyond excellent. </p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Mathias Yip</h3>
        </div>

        <div class="box" style="height: 100%;" >
            <img src="images/pic-2.png" alt="">
            <p>The seller of this flower online shop was good. During CNY ask them for help for my rom flower cause some of the design out of stock. </p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Kenny Wu</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Beautiful flower arrangement and quality materials used to complement the flower bouquet. Color mix was excellent. Keep this up, you'll get many return customers</p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Ju-Lyn</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>The service was fantastic, I had some issues paying for the flowers, and with the help from the support guys I was able to get the payment done. Highly recommend to anybody.</p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Douglas MacKenzie</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Thank u so much! The flowers are so beautiful and the card is so cute ☺ the birthday boy is very happy. Thank u ☺ will definitely purchase flowers from you again. </p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Shasha</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Great!!!!! I’m happy with the flowers!!! 100% Recommended!!! U guys won’t regret….great dealing with you!!! Hope to deal with u again in the future….thank you so much !!!!!!!</p>
            <div class="stars">
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star" style="color: var(--green);"></i>
                <i class="fas fa-star-half-alt" style="color: var(--green);"></i>
            </div>
            <h3>Danny</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="js/admin_script.js"></script>
<script src="js/loader.js"></script>


</body>
</html>