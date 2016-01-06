<?php
require_once("dbConfig.php");

$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()){
    exit();
}

$query = "INSERT INTO requests (
                                username,
                                moviename,
                                movielink,
                                donate,
                                message,
                                remoteaddress) VALUES ('" .
                                 $_POST['user'] . "','" .
                                 $_POST['movie'] . "','" .
                                 $_POST['imdb'] . "','" .
                                 $_POST['donate'] . "','" .
                                 $_POST['message'] . "','" .
                                 $_SERVER['REMOTE_ADDR'] . "')";

mysqli_autocommit($link,FALSE);
mysqli_query($link, $query);
if(mysqli_errno($link)){
    echo "Ooops, some error occured!";
    return -1;
  }
else{
  mysqli_commit($link);
  echo '1';
  return 1;
}

mysqli_close($link);
?>
