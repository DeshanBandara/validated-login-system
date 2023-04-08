<?php

@include 'config.php';

session_start();

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($conn, $select);
	$count = mysqli_num_rows($result);
	if($count>0)
	{
		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_array($result);
			if($row['user_type'] == 'admin')
			{
				$_SESSION['admin_name'] = $row['name'];
				header('location:admin.php');
			}
			elseif($row['user_type'] == 'user')
			{
				$_SESSION['user_name'] = $row['name'];
				header('location:user.php');
			}
		}
	}
	else
	{
		echo '<span class="error-msg">'.$error.'</span>';
		header('location:sign_in.php');
	}

	/*if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
		if($row['user_type'] == 'admin')
		{
			$_SESSION['admin_name'] = $row['name'];
			header('location:admin.php');
		}
		elseif($row['user_type'] == 'user')
		{
			$_SESSION['user_name'] = $row['name'];
			header('location:user.php');
		}
    }
	else
	{
		$error[] = 'incorrect email or password!';
	}*/
   
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">-->
</head>
<body>
    <div class="container">
		<h1 class="label">User Login</h1>
		<form class="login_form" action="" method="post" name="form" onsubmit="return validated()">
			<?php
				if(isset($error))
				{
					foreach($error as $error)
					{
						echo '<span class="error-msg">'.$error.'</span>';
					};
				};
            ?>
			<!--<div class="font">Email or Phone</div>-->
			<input type="email" name="email" required placeholder="Enter your email">
			<div id="email_error">Please fill up your Email or Phone</div>
            <br>
            <br>
			<!--<div class="font font2">Password</div>-->
			<input type="password" name="password" required placeholder="Enter your password">
			<div id="pass_error">Please fill up your Password</div>
			<!--<button type="submit">Login</button>-->
			<br>
			<br>
			<br>
			<input type="submit" name="submit" value="Sign in" class="form-btn">
			<br>
			<br>
			<p>don't have an account? <a href="sign_up.php">register now</a></p>
		</form>
	</div>	
	<script src="valid.js"></script>
</body>
</html>