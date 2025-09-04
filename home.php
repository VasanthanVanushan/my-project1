<?php

    @include 'config.php';

    session_start();

    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)) {
        header('location:login.php');
    };

    if (isset($_POST['add_to_wishlist'])) {

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $p_name = $_POST['p_name'];
        $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
        $p_price = $_POST['p_price'];
        $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
        $p_image = $_POST['p_image'];
        $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$p_name, $user_id]);

        if ($check_wishlist_numbers->rowCount() > 0) {
            $message[] = 'already added to wishlist!';
        } elseif ($check_cart_numbers->rowCount() > 0) {
            $message[] = 'already added to cart!';
        } else {
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
            $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
            $message[] = 'added to wishlist!';
        }
    }

    if (isset($_POST['add_to_cart'])) {

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $p_name = $_POST['p_name'];
        $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
        $p_price = $_POST['p_price'];
        $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
        $p_image = $_POST['p_image'];
        $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
        $p_qty = $_POST['p_qty'];
        $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$p_name, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message[] = 'already added to cart!';
        } else {

            $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
            $check_wishlist_numbers->execute([$p_name, $user_id]);

            if ($check_wishlist_numbers->rowCount() > 0) {
                $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
                $delete_wishlist->execute([$p_name, $user_id]);
            }

            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
            $message[] = 'added to cart!';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <?php include 'header.php'; ?>


    <div class="home-bg">

        <section class="home">
            <div class="content">
                <h3>Reach For A Healthier You With Organic Foods</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto natus culpa officia quasi, accusantium explicabo?</p>
                <a href="about.php" class="btn">about us</a>
            </div>
        </section>
    </div>



    <section class="home-category">

        <h1 class="title">shop by category</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/groceries_main.webp" alt="groceries">
                <h3>Groceries & Essentials</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=groceries" class="btn">Groceries</a>
            </div>

            <div class="box">
                <img src="images/spreads_main.webp" alt="spreads">
                <h3>Spreads & Breakfast Items</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=spreads" class="btn">Spreads</a>
            </div>

            <div class="box">
                <img src="images/snacks_main.png" alt="snacks">
                <h3>Snacks & Biscuits</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=snacks" class="btn">Snacks</a>
            </div>

            <div class="box">
                <img src="images/beverages_main.png" alt="beverages">
                <h3>Beverages & Drinks</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=beverages" class="btn">Beverages</a>
            </div>

            <div class="box">
                <img src="images/household_main.png" alt="household_items">
                <h3>Cleaning & Household Items</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=household" class="btn">Cleaning Items</a>
            </div>

            <div class="box">
                <img src="images/personalcare_main.png" alt="personal care">
                <h3>Personal Care & Hygiene</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                <a href="category.php?category=personalcare" class="btn">Care Items</a>
            </div>
        </div>
    </section>





    <section class="products">

        <h1 class="title">latest products</h1>

        <div class="box-container">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" class="box" method="POST">
                        <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                        <input type="number" min="1" value="1" name="p_qty" class="qty">
                        <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>

        </div>

    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>