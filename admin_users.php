   <?php

   @include 'config.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if (!isset($admin_id)) {
      header('location:login.php');
   };

   if (isset($_GET['delete'])) {

      $delete_id = $_GET['delete'];
      $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
      $delete_users->execute([$delete_id]);
      header('location:admin_users.php');
   }

   // Filter by user type if provided
   $user_type = isset($_GET['type']) ? $_GET['type'] : 'all';

   if ($user_type == 'admin') {
      $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'admin'");
   } elseif ($user_type == 'user') {
      $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'user'");
   } else {
      $select_users = $conn->prepare("SELECT * FROM `users`");
   }
   $select_users->execute();

   ?>


   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>users</title>
      <link rel="stylesheet" href="css/admin_style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   </head>

   <body>

      <?php include 'admin_header.php';     ?>

      <section class="user-accounts">
         <h1 class="title"><?php
                              if ($user_type == 'admin') {
                                 echo "Admin Accounts";
                              } elseif ($user_type == 'user') {
                                 echo "User Accounts";
                              } else {
                                 echo "All Accounts";
                              }
                           ?>
         </h1>

         <div class="box-container">
            <?php while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) { ?>
               <div class="box" style="<?php if ($fetch_users['id'] == $admin_id) {
                                          echo 'display:none';
                                       } ?>">
                  <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt="">
                  <p> user id : <span><?= $fetch_users['id']; ?></span></p>
                  <p> username : <span><?= $fetch_users['name']; ?></span></p>
                  <p> email : <span><?= $fetch_users['email']; ?></span></p>
                  <p> user type :
                     <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                             echo 'orange';
                                          } ?>">
                        <?= $fetch_users['user_type']; ?>
                     </span>
                  </p>
                  <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
               </div>
            <?php } ?>
         </div>

      </section>


      <script src="js/script.js"></script>

   </body>

   </html>