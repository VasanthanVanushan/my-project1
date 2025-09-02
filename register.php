<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name,  FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email,  FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password,  FILTER_SANITIZE_STRING);
    $c_password = md5($_POST['c_password']);
    $c_password = filter_var($c_password,  FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;


    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);

    if($select->rowCount() > 0)
    {
        $message[] = 'User email already exist!';
    }
    else
    {
        if($password != $c_password)
        {
            $message[] = 'Confirm Password not matched!';
        }
        else
        {
            $insert = $conn->prepare("INSERT INTO `users`(name,email,password,image) VALUES(?,?,?,?)");
            $insert->execute([$name,$email,$password,$image]);

            if($insert)
            {
                if($image_size > 2000000)
                {
                    $message[] = 'Image size is too large!';
                }
                else
                {
                    move_uploaded_file($image_tmp_name,$image_folder);
                    $message[] = 'registered successfully!';
                    header('location:login.php');
                }
            }
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


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





    <section class="form-container">
        <form action="" enctype="multipart/form-data" method="post">
            <h2>Register Now</h2>
            <input type="text" name="name" class="input-box" placeholder="Enter your name" required>
            <input type="email" name="email" class="input-box" placeholder="Enter your email" required>
            <input type="password" name="password" class="input-box" placeholder="Enter your password" required>
            <input type="password" name="c_password" class="input-box" placeholder="Confirm your password" required>
            <input type="file" name="image" class="input-box" accept="image/jpg,image/jpeg,image/png">
            <input type="submit" name="submit" value="register now" class="btn">
        
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </section>


</body>
</html>