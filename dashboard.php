<?php
include ("header.php");
if(isset($_GET['logout']))
{
	session_unset();
	session_destroy();
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Project</title>
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
    	.login
    	{
    		width: 400px;
    	}
    </style>
</head>

<body>

    <div class="login">
    	<?php if (isset($_SESSION['username'])) { ?>
		<h5>You have successfully logged in as <?php echo $_SESSION['username']; ?></h5>
		<!-- <button onclick="window.location.href='dashboard.php?logout=1'">Logout</button> -->
	<?php }else if (isset($_GET['error'])) { ?>
        <h5>Max Limit reached, try after 24 hours...</h5>
        <!-- <button onclick="window.location.href='dashboard.php?logout=1'">Logout</button> -->
    <?php }else { ?>
		<h5>You have not logged in, please login to continue...</h5>
		<!-- <button style="text-align: center;" onclick="window.location.href='index.php'">Login</button> -->
	<?php } ?>
    </div>
</body>

</html>