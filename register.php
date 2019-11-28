<?php

if (isset($_POST['register']))
{
    include ("database.php");

	$username = mysqli_escape_string($db,$_POST['username']);
    $password = mysqli_escape_string($db,$_POST['password']);
    $confirm_password = mysqli_escape_string($db,$_POST['confirm_password']);

    if ($password==$confirm_password)
    {
    	$query = "SELECT * FROM login WHERE username='$username'";
    	$res = mysqli_query($db, $query);
    	$row = mysqli_fetch_array($res);
    	$sameusers = mysqli_num_rows($res);

    	if ($sameusers==0)
    	{
    		$query = "INSERT INTO login(username, opassword) VALUES('$username', '$password')";
    		$res = mysqli_query($db, $query);

    		header ("Location:index.php");
    	}
    	else header ("Location:register.php");
    }
    else header ("Location:register.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Project</title>

	<link rel="stylesheet" href="header.css">
	<link rel="stylesheet" href="login.css">

</head>
<body>
    <?php include ("header.php"); ?>
	
	<div class="login">
		<p class="text">Register</p>	
		<form method="post" action="register.php">
			<div class="input"><input type="text" name="username" placeholder="Username" required></div>
			<div class="input"><input type="password" name="password" placeholder="Password" required></div>
			<div class="input"><input type="password" name="confirm_password" placeholder="Confirm Password" required></div>
			<div class="submit"><input type="submit" name="register" value="Register"></div>
		</form>
	</div>

	</body>
</html>