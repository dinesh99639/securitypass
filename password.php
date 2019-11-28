<?php
  include ("header.php");
  
  $a=array(array());
  $r=array();
  $un=$_POST['username'];
  $newpwd='';

if (isset($_POST['login']))
{
  include ("database.php");

  $un=$_POST['username'];
  $pwd=$_POST['password'];
  $ip=$_SESSION['ip'];

  $qry = "SELECT * from login_log where username='$un' and ip='$ip'";
  $res = mysqli_query($db,$qry);
  $res_arr=mysqli_fetch_assoc($res);
  $c   = mysqli_num_rows($res);
  if ($c==1)
  {
    $qry = "SELECT * from login where username='$un'";
    $login = mysqli_query($db,$qry);
    $login=mysqli_fetch_assoc($login);

    if ($login['fail_count']>=4)
    {
      if(mysqli_fetch_assoc(mysqli_query($db,"SELECT TIMEDIFF(NOW(),lock_time)+0 as t from login where username='$un'"))['t']<=240000) header("Location:dashboard.php?error=limit");
      else mysqli_query($db,"UPDATE login set fail_count=0 where username='$un'");
    } 
    if($pwd==$res_arr['password'])
    {
      $_SESSION['username'] = $un;
      header("Location:dashboard.php");
    }
    else
    {
      $fc=$login['fail_count']+1;
      $res = mysqli_query($db,"UPDATE login set fail_count=$fc where username='$un'");
      randpass();
      if($fc>=3) mysqli_query($db,"UPDATE login set fail_count=$fc, lock_time=NOW() where username='$un'");
    }

  }
  else
  {
  }
}

function randpass()
{
  include ("database.php");

  $un=$_POST['username'];
  $ip=$_SESSION['ip'];
  $i=mysqli_query($db,"SELECT opassword from login where username='$un'");
    $i=mysqli_fetch_assoc($i);
    $pwd=$i['opassword'];

    global $a,$r,$newpwd;
    $hash=array(0,0,0,0,0,0,0,0,0,0);
    $temp=array();
    $k=0;
    $count=10;

    for(;$count!=0;)
    {
      $t=rand()%10;
      if ($hash[$t]!=1)
      {
        $hash[$t]=1;
        $temp[$k++]=$t;
        $count--;
      }
    }
    $temp[10]='$';
    $temp[11]='#';

    $hash=array(0,0,0,0,0,0,0,0,0,0);
    $k=0;
    for ($i=0;$i<4;$i++) 
      for($j=0;$j<3;$j++)
      {
        $a[$i][$j]=$temp[$k++];
        $hash[$a[$i][$j]]=$i+1;
      }

    for ($i=0;$i<4;$i++) $r[$i]=rand(0,3);

    $l=strlen($pwd);
    $fpwd="";
    for ($i=0;$i<$l;$i++)
    {
      $num=(int)$pwd[$i];
      $temp=($hash[$num]+$r[$hash[$num]-1]);
      if ($temp>4) $temp=$temp%4;
      $fpwd=$fpwd.$temp;
    } 

    $newpwd=$fpwd;;
    ?> <script>//console.log(<?php echo $fpwd; ?>);</script> <?php
    $i=mysqli_query($db,"UPDATE login_log set password='$fpwd' where username='$un' and ip='$ip'");
}

if(isset($_POST['next']))
{
  include ("database.php");

  $un=$_POST['username'];
  $_SESSION['ip']=$_POST['ip'];
  $ip=$_SESSION['ip'];
  $check=mysqli_query($db,"SELECT * from login where username='$un'");
  $login=mysqli_fetch_assoc($check);
  $count=mysqli_num_rows($check);
  
  $qry = "SELECT * from login_log where username='$un' and ip='$ip'";
  $res = mysqli_query($db,$qry);
  $res_arr=mysqli_fetch_assoc($res);
  if ($count==1)
  {
    if ($login['fail_count']>=4)
    {
      if(mysqli_fetch_assoc(mysqli_query($db,"SELECT TIMEDIFF(NOW(),lock_time)+0 as t from login where username='$un'"))['t']<=240000) header("Location:dashboard.php?error=limit");
      else mysqli_query($db,"UPDATE login set fail_count=0 where username='$un'");
    } 
    randpass();
    mysqli_query($db,"INSERT into login_log values('$un', '$ip', '$newpwd')");
  }
  else header("Location:index.php");
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Security</title>

<style>
  body
  {
    /*background-image: linear-gradient( 109.2deg,  rgba(254,3,104,1) 9.3%, rgba(103,3,255,1) 89.5% );*/
    background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
    background-size: cover;
    background-attachment: fixed;
  }
  .card
  {
    position: absolute;
    margin: 60px 0;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    /*height: ght: 300px;*/
    width: 22%;
    min-width: 300px;
    background: white;
    padding: 40px;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,0.5);
    border-radius: 5px;
    top: 250px;
    left: 50%;
    transform: translate(-50%,-50%);
  }
  .button {
    background-color: black;
    outline: none;
    border: none;
    color: white;
    height: 75px;
    width: 75px;
    text-align: center;
    text-decoration: none;
    font-size: 20px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 100;
  }
  .button:hover {
    background-color: gray;
  }

  .grid
  {
    position: relative;
    margin-top: 35px;
    margin-left: 15px; 
    /*transform: translate(35%,10%);*/
  }
  .grid .button1
  {
     position: absolute;
     margin-left: 100px;
  }
  .grid .button2
  {
     position: absolute;
     margin-top: 100px;
     margin-left: 200px;
  }
  .grid .button3
  {
     position: absolute;
     margin-left: 0px;
     margin-top: 100px;
  }
  .grid .button4
  {
     position: absolute;
     margin-top: 200px;
     margin-left: 100px;
  }
  .grid .btn_num1
  {
    position: absolute;
    background-color: white;
    border: none;
    outline: none;
    border-radius: 50%;
    margin-left: 125px;
    margin-top: 79px;
  }
  .grid .btn_num2
  {
    position: absolute;
    background-color: white;
    border: none;
    outline: none;
    border-radius: 50%;
    margin-left: 176px;
    margin-top: 130px;
  }
  .grid .btn_num3
  {
    position: absolute;
    background-color: white;
    border: none;
    outline: none;
    border-radius: 50%;
    margin-left: 125px;
    margin-top: 175px;
  }
  .grid .btn_num4
  {
    position: absolute;
    background-color: white;
    border: none;
    outline: none;
    border-radius: 50%;
    margin-left: 78px;
    margin-top: 130px;
  }
  .r
  {
    position: relative;
    border: none;
    outline: none;
    color: black; 
    height: 30px;
    width: 100px;
    text-align: center;
    border-radius: 30px;
    background-color: rgba(0, 230, 64, 1);
  }
  .gowri
  {
    position: absolute;
    margin-top: 350px;
    margin-left: 300px;
  }
  .password
  {
    position: relative;
    width: 250px;
    height: 30px;
    margin-top: 420px;
    border: 1px solid black;
    outline: none;
    border-radius: 30px;
    padding: 0 10px;
    font-size: 20px;
    text-align: center;
  }
  .login
  {
    border: none;
    outline: none;
    padding: 5px;
    width: 90px;
    background-color: #FF4500;
    color: white;
    border-radius: 30px;
  }

</style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="grid">
         <button id="b1" class="button button1" onclick="append(this.id)"><?php echo $a[0][0]." &nbsp ".$a[0][1]."<br> ".$a[0][2]; ?></button>
         <button class="btn_num1">1</button>
         <button id="b2" class="button button2" onclick="append(this.id)"><?php echo $a[1][0]." &nbsp ".$a[1][1]."<br> ".$a[1][2]; ?></button>
         <button class="btn_num2">2</button>
         <button id="b3" class="button button3" onclick="append(this.id)"><?php echo $a[3][0]." &nbsp ".$a[3][1]."<br> ".$a[3][2]; ?></button>
         <button class="btn_num3">3</button>
         <button id="b4" class="button button4" onclick="append(this.id)"><?php echo $a[2][0]." &nbsp ".$a[2][1]."<br> ".$a[2][2]; ?></button>
         <button class="btn_num4">4</button>
      </div>
    </div>
    <!-- <div class="col-sm-4"></div> -->
  </div>
</div>

<div class="container">
  <div class="row">
    <!-- <div class="col-sm-2"></div> -->
    <div class="col-sm-8">
      <div class="gowri">
          <div class="col-sm-3"><button class="r">1: Add <?php echo $r[0]; ?></button></div>
          <div class="col-sm-3"><button class="r">2: Add <?php echo $r[1]; ?></button></div>
          <div class="col-sm-3"><button class="r">3: Add <?php echo $r[2]; ?></button></div>
          <div class="col-sm-3"><button class="r">4: Add <?php echo $r[3]; ?></button></div>
      </div>
    </div>
    <div class="col-sm-2"></div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <form method="post" action="password.php">
        <input type="text" name="username" value="<?php echo $un; ?>" hidden>
        <input type="text" name="ip" value="<?php echo $ip; ?>" hidden>
        <input type="password" name="password" class="password" autocomplete required>
        <input type="submit" class="login" name="login">
      </form>
    </div>
    <div class="col-sm-4"></div>
  </div>
</div>
<script type="text/javascript">
  document.getElementsByClassName("password")[0].focus();
  var append = (x)=>{
    if(x=="b1") {$(".password").val($(".password").val()+"1");}
    if(x=="b2") {$(".password").val($(".password").val()+"2");}
    if(x=="b4") {$(".password").val($(".password").val()+"3");}
    if(x=="b3") {$(".password").val($(".password").val()+"4");}
    // console.log($(".password").val());
  }
</script>
</body>
</html>
