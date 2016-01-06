<?php

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
    echo "<th class='tg-baqh' colspan='7'>Movie Request List<br></th>";
  echo "</tr>";
  echo "<tr>";
    echo "<td class='tg-rmb8'>User</td>";
    echo "<td class='tg-rmb8'>Movie</td>";
    echo "<td class='tg-rmb8'>IMDB</td>";
    echo "<td class='tg-rmb8'>Donation</td>";
    echo "<td class='tg-rmb8'>Message</td>";
    echo "<td class='tg-rmb8'>Date</td>";
    echo "<td class='tg-rmb8'>Status</td>";
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
      echo "</tr>";
  }

  echo "</table>";

  mysqli_close($link);

?>
