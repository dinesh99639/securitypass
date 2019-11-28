<?php session_start(); ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="js/jquery.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
            <a class="navbar-brand" href="index.php">Security</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active navclick"><a href="index.php">Home</a></li>
                <li class="navclick"><a href="#">services</a></li>
                <li class="navclick"><a href="#">Admin</a></li>
                <li class="navclick"><a href="#">Contact us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['username']))
                { ?>
                    <li class="navclick"><a href="dashboard.php?logout=1"><?php echo $_SESSION['username']; ?></a></li>
                    <li class="navclick"><a href="dashboard.php?logout=1">Logout</a></li>
                    <!-- <li class="dropdown">
                        <ul class="dropdown-menu">
                            <li class="navclick"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $userdata['userid']; ?>">Profile</a></li>
                            <li class="navclick"><a href="#">Extras</a></li>
                        </ul>
                    </li> -->
                <?php }
                else
                { ?>
                <li class="navclick"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li class="navclick"><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>