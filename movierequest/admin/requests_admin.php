<?php
@ob_start();
session_start();
if(!isset($_SESSION['myusername'])){
  header("location:index.php");
}
else{
  // echo "<h4>Logged in as: ". $_SESSION["myusername"];
?>

<html>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="../javascript/jquery-1.11.2.min.js"></script>
<script src="../javascript/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  populateTable();

  $('#requestsTable').on('click', 'td a.linkdelete', deleteUser);
  $('#requestsTable').on('click', 'td a.linkedit', editUser);

});

function populateTable() {
  $.post('../get.php', {'type': 'admin'}, function(response, status){
      if(response == -1){ //load json data from server and output message
          alert('Error:'+response);
      }else{ //success
        $('#requestsTable').html(response);
      }

  });
}

function editUser(event) {
  console.log("Edit request");
  //event.preventDefault();
  var confirmation = confirm('Are You Sure you want toggle the status of this request?');

  if(confirmation === true){
    var val = $(this).attr('val');
    var newVal = (val == 0 ? 1 : 0); // if status is 0 then 1, if 1 then 0
    var postData = {'type':'toggle','id': $(this).attr('rel'), 'value': newVal};
    $.post('edit.php', postData, function(response, status){
        if(status != 'success'){ //load json data from server and output message
            alert('Error:'+response);
        }else{ //success
          console.log(response+' status:'+status);
          populateTable();
        }

    });
  }
}

function deleteUser(event) {
  console.log("Delete request");
  //event.preventDefault();
  var rand = getRandomInt(10,99);
  var val = prompt('Are You Sure you want delete this request? If so enter '+rand +' below...');
  if(val == rand){
    var postData = {'type':'delete','id': $(this).attr('rel')};
    $.post('edit.php', postData, function(response, status){
        if(status != 'success'){ //load json data from server and output message
            alert('Error:'+response);
        }else{ //success
          console.log(response+' status:'+status);
          populateTable();
        }

    });
  }
  else {
    alert('Looks like you are not sober enough :)')
  }
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


</script>

<body>

  <div id="requestsTable">
  </div>

</body>
</html>

<?
  }
?>
