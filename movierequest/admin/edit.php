<?php

@ob_start();
session_start();

if(!isset($_SESSION['myusername'])){
  header("location:index.php");
}

require_once('../dbConfig.php');

if(isset($_POST['id']))
{
  $id=$_POST['id'];
  $type = $_POST['type'];
  $stat=$_POST['value'];

  // Create connection
  $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  if($type =='toggle'){
      $sql = "update requests set status=".$stat." where Id='$id'";
    }
    else if ($type =='delete'){
      $sql = "delete from requests where Id='$id'";
    }


  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();
  }
?>
