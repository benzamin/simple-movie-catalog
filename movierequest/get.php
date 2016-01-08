<?php
@ob_start();
session_start();

$is_admin = isset($_POST['type']) && $_POST['type'] =='admin' &&  isset($_SESSION['myusername']);

require_once("dbConfig.php");

$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()){
    exit();
}
$sql = "SELECT * FROM `requests`\n"
    . "ORDER BY `requests`.`createdtime` DESC LIMIT 0, 100";
$result = mysqli_query($link,$sql);

echo "<table id='requestsTable' class='tg'>";
  echo "<tr>";
if($is_admin){
    echo "<th class='tg-baqh' colspan='9'><h4>Movie Request List &nbsp;&nbsp;|&nbsp;&nbsp; Logged in as: ".$_SESSION["myusername"]." &nbsp;&nbsp;|&nbsp;&nbsp; <a href='logout.php'>Logout</a></h4></th>";
  }
  else {
    echo "<th class='tg-baqh' colspan='7'>Movie Request List&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='./admin/index.php'>Login</a><br></th>";
  }
  echo "</tr>";
  echo "<tr>";
    echo "<td class='tg-rmb8'>User</td>";
    echo "<td class='tg-rmb8'>Movie</td>";
    echo "<td class='tg-rmb8'>IMDB</td>";
    echo "<td class='tg-rmb8'>Donation</td>";
    echo "<td class='tg-rmb8'>Message</td>";
    echo "<td class='tg-rmb8'>Date</td>";
    echo "<td class='tg-rmb8'>Status</td>";
    if($is_admin){
        echo "<td class='tg-rmb8'>Toggle</td>";
        echo "<td class='tg-rmb8'>Delete</td>";
      }
  echo "</tr>";


  while ($row = mysqli_fetch_array($result)) {
      $isUploaded = strcmp($row["status"],'0');  // if 0 then both are equal
      echo "<tr>";
      echo "<td class='tg-yw4l'>" . $row["username"] . "</td>";
      echo "<td class='tg-yw4l'>" . $row["moviename"] . "</td>";
      echo "<td class='tg-yw4l'>   <a href='" . $row["movielink"] . "'>IMDB Link</a> </td>";
      echo "<td class='tg-yw4l'>" . (strcmp($row["donate"], '0') == 0 ? "HD Movie" : "5 Taka") . "</td>";
      echo "<td class='tg-yw4l'>" . $row["message"] . "</td>";
      echo "<td class='tg-yw4l'>" . $row["createdtime"] . "</td>";
      if($isUploaded == 0) echo "<td class='tg-red'>Pending<br></td>";
      else                echo "<td class='tg-green'>Uploaded<br></td>";
      if($is_admin){
        //echo "<td class='tg-yw4l'><a href='edit.php?id=".$row['Id']."'>&#9998</a></td>";
        //echo "<td class='tg-yw4l'><a href='delete.php?id=".$row['Id']."'>&#10008</a></td>";
        echo "<td><a href ='#' class='linkedit' rel='" .$row['Id'] . "' val='".$row["status"]."'>&#9998</a></td>";
        echo "<td><a href ='#' class='linkdelete' rel='" .$row['Id'] . "'>&#10008</a></td>";
      }
      echo "</tr>";
  }

  echo "</table>";

  mysqli_close($link);

?>
