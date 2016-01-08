<?php
ob_start();
session_start();

if(isset($_SESSION['myusername'])){
   $username=$_SESSION['myusername'];
   echo "Logged on as " + $username;
   header("location:requests_admin.php");
}
else {
?>
  <html>
    <script src="../javascript/jquery-1.11.2.min.js"></script>
    
    <script type="text/javascript">

    $(document).ready(function(){

      $("#btn_submit").click(function() {
        console.log('submit!');
        var postData = {
            'myusername'     : $('input[name=myusername]').val(),
            'mypassword'    : $('input[name=mypassword]').val()
        };

        $.post('checklogin.php', postData, function(response, status){
            if(status != 'success'){
                alert('Error:'+response);
            }else{ //success
              if(response == '0')
                alert('Wrong Username/Password');
              else
                window.location="requests_admin.php";
            }

          });
    });
  });

    </script>
  <body>
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <!-- <form name="form1" method="post" action="checklogin.php"> -->
      <td>
      <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
      <tr>
      <td colspan="3"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WMDB Admin Login </strong></td>
      </tr>
      <tr>
      <td width="78">Username</td>
      <td width="6">:</td>
      <td width="294"><input name="myusername" type="text" id="myusername"></td>
      </tr>
      <tr>
      <td>Password</td>
      <td>:</td>
      <td><input name="mypassword" type="password" id="mypassword"></td>
      </tr>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" id="btn_submit" value="Login"></td>
      </tr>
      </table>
      </td>
    <!-- </form> -->
    </tr>
    </table>


      <div id="errortext">
      </div>

  </body>
</html>

<?php
  }
?>
