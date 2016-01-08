<?php
ob_start();
session_start();

if(isset($_SESSION['myusername'])){
   header("location:requests_admin.php");
}
else {
  require_once("../dbConfig.php");

  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  if (mysqli_connect_errno()){
      exit();
  }

if(isset($_POST['myusername']) && isset($_POST['mypassword']))
{

  // Define $myusername and $mypassword
  $myusername=$_POST['myusername'];
  $mypassword=$_POST['mypassword'];

  // To protect MySQL injection (more detail about MySQL injection)
  $myusername = stripslashes($myusername);
  $mypassword = stripslashes($mypassword);
  $myusername = ($myusername);
  $mypassword = ($mypassword);

  $tbl_name="members"; // Table name
  $sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
  $result=mysqli_query($link,$sql);

  // Mysql_num_row is counting table row
  $count=mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row

  if($count==1){
    echo "1";
    $_SESSION["myusername"] = $myusername;
    //$_SESSION["mypassword"] = $mypassword;
    //header("location:requests_admin.php");
  }
  else {
  echo "0";
  //echo "<br><br>";
  //echo "<a href='index.php'>Back</a>";
  }
}
else {
  header("location:index.php");
}

}
ob_end_flush();
?>
