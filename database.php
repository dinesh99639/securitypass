<?php
$cserver=2;
//localhost
if($cserver==1) $db = mysqli_connect("localhost","root","","dthon") or die("Database connection error");
//infinityfree.com server
if($cserver==2) $db = mysqli_connect("sql313.epizy.com","epiz_23899948","dinesh99639","epiz_23899948_securitypass") or die("Database connection error");
?>