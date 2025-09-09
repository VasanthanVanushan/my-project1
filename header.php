<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
                <div class="message">
                    <span>' . $msg . '</span>
                    <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
?>

<header class="header">

    <div class="flex">
        <a href="home.php"><img src="VK3Logo.png" alt="logo" class="logo"></a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="shop.php">Products</a>
            <a href="orders.php">Orders</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>

            <?php if (!empty($user_id)) : ?>
                <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);

                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_items->execute([$user_id]);
                ?>
                <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
                <div id="user-btn" class="fas fa-user"></div>
            <?php else : ?>
                <!-- Guest (not logged in) -->
                <a href="login.php"><i class="fas fa-heart"></i><span>(0)</span></a>
                <a href="login.php"><i class="fas fa-shopping-cart"></i><span>(0)</span></a>
                <a href="login.php"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </div>

        <div class="profile">
            <?php if (!empty($user_id)) : ?>
                <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>

                <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                <p><?= $fetch_profile['name']; ?></p>
                <a href="user_update_profile.php" class="btn">update profile</a>
                <a href="logout.php" class="delete-btn">logout</a>

            <?php else : ?>
                


            <?php endif; ?>
        </div>

    </div>

</header>