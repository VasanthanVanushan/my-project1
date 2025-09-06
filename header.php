<?php

if(isset($message))
{
    foreach($message as $message)
    {
        echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fa-solid fa-xmark" onclick="this.parentElement.remove();"></i>
                </div>
             ';
    }
}

?>


<header class="header">

    <div class="flex">
        <a href="admin_page.php"><img src="VK3Logo.png" alt="logo" class="logo"></a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="shop.php">Products</a>
            <a href="orders.php">Orders</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php"><div id="search-btn" class="fas fa-search"></div></a>
            <a href="wishlist.php"><div id="wishlist-btn" class="fas fa-heart"></div></a>
            <a href="cart.php"><div id="cart-btn" class="fas fa-shopping-cart"></div></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>


                <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                <p><?= $fetch_profile['name']; ?></p>
                <a href="user_update_profile.php" class="btn">update profile</a>
                <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>




