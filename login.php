<?php

include 'config.php';

session_start();

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $email = filter_var($email,  FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);
    $password = filter_var($password,  FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email,$password]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount() > 0)
    {
        if($row['user_type'] == 'admin')
        {
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        }
        elseif($row['user_type'] == 'user')
        {
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }   
        else
        {
            $message[] = 'no user found!';
        }
    }
    else
    {
        $message[] = 'Incorrect username or password!';
    }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
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
            <h2>Login Now</h2>
            <input type="email" name="email" class="input-box" placeholder="Enter your email" required>
            <input type="password" name="password" class="input-box" placeholder="Enter your password" required>
            <input type="submit" name="submit" value="login now" class="btn">
        
            <p>don't have an account? <a href="register.php">Register Now</a></p>
            <p>Continue as a guest? <a href="home.php">Guest Login</a></p>
        </form>
    </section>


</body>
</html>