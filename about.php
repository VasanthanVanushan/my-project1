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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>


    <section class="about">
        <div class="row">
            <div class="box">
                <img src="images/about-img-1.png" alt="">
                <h3>why choose us?</h3>
                <p>At VK3 Mart, we believe shopping should be simple, convenient, and enjoyable. That’s why we bring together everything you need under one roof—from daily groceries to household essentials—so you don’t have to run from store to store. With our commitment to trusted quality, affordable prices, and friendly service, we make sure every customer leaves with a smile and the satisfaction of a stress-free shopping experience.</p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

            <div class="box">
                <img src="images/about-img-2.png" alt="">
                <h3>what we provide?</h3>
                <p>We provide a wide range of products to meet all your daily needs. From groceries and staples like flour and sugar, to delicious spreads, breakfast items, and biscuits, our shelves are stocked with care. You’ll also find refreshing beverages including juice packets, Smak juices, and Milo, alongside reliable household items such as soaps, shampoos, and cleaning powders. Whatever you need for your home or family, VK3 Mart is here to provide it with quality and convenience.</p>
                <a href="shop.php" class="btn">our shop</a>
            </div>
        </div>

    </section>


    <section class="reviews">
        <h1 class="title">clients reviews</h1>
        <div class="box-container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <h3>Amillthan</h3>
                <p>“Every trip to VK3 Mart is a pleasure—always find what I need, plus something delightful!”</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <h3>Krishnapiriyan</h3>
                <p>“Great selection and helpful staff. It feels like they know exactly what I’m shopping for.”</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <h3>Ronald</h3>
                <p>“Clean aisles, warm service, and good prices—shopping here always puts me in a good mood.”</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
        </div>
    </section>






    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>