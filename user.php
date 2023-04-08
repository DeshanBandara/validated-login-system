<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name']))
{
    header('location:sign_in.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-admin">
        <div class="content">
            <h3 class="content-h3">Hi, <span>user</span></h3>
            <h1 class="content-h1">Welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
            <p class="content-p">This is an user page</p>
            <button><a href="sign_in.php">Sign In</a></button>
            <button><a href="sign_up.php">Sign Up</a></button>
            <button><a href="logout.php">LogOut</a></button>
        </div>
    </div>
</body>
</html>