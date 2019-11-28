<?php

// echo DateTime();

$db = mysqli_connect("localhost","root","","dthon") or die("Database connection error");
$i=mysqli_fetch_assoc(mysqli_query($db,"SELECT TIMEDIFF(NOW(),lock_time)+0 as t from login where username='z'"))['t'];
// $qry = "SELECT * from login where username='z'";
//     $login = mysqli_query($db,$qry);
    // $i=mysqli_fetch_assoc($login);
// echo "<br>".time($i['lock_time']);
    echo $i;
?>