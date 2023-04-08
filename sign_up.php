<?php

@include 'config.php';
if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0)
    {
        $error[] = 'user already exist!';
    }
    else
    {
        if($password != $confirm_password)
        {
            $error[] = 'password not matched!';
        }
        else
        {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$password','$user_type')";
            mysqli_query($conn, $insert);
            header('location:sign_in.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <br>
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
            ?>
            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" title="Password should be of 6-10 length and should contain atleast one character and one number"
             required placeholder="Enter your password">
            <input type="password" name="confirm_password" required placeholder="Confirm your password">
            <br>
            <select name="user_type" id="">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <br>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>Already have an account? <a href="sign_in.php">Sign in now</a></p>
        </form>
    </div>
</body>
</html>