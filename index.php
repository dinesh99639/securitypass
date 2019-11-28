<!DOCTYPE html>
<html>

<head>
    <title>Project</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php include ("header.php"); ?>

    <div class="login">
        <p class="text">Login</p>
        <form method="post" action="password.php">
            <div class="input"><input type="text" name="username" placeholder="Username" required></div>
            <div class="input"><input class="ip" type="text" name="ip" placeholder="ip" hidden></div>
            <div class="submit"><input type="submit" name="next" value="Next"></div>
        </form>
    </div>
<script src="js/jquery.js"></script>
<script>
    $.getJSON("http://jsonip.com?callback=?", function (data) {
        $(".ip").val(data.ip);
    });
</script>
</body>
</html>