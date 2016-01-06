
<!DOCTYPE html>
<html>
<head>
<title>WMDB Requests </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="javascript/jquery-1.11.2.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  populateTable();

	var _scroll = true, _timer = false, _floatbox = $("#contact_form"), _floatbox_opener = $(".contact-opener") ;
	_floatbox.css("right", "-322px"); //initial contact form position

	//Contact form Opener button
	_floatbox_opener.click(toggle_floatbox);

  function toggle_floatbox(){
		if (_floatbox.hasClass('visiable')){
            _floatbox.animate({"right":"-322px"}, {duration: 300}).removeClass('visiable');
        }else{
           _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
        }
	};

	//Effect on Scroll
	$(window).scroll(function(){
		if(_scroll){
			_floatbox.animate({"top": "30px"},{duration: 300});
			_scroll = false;
		}
		if(_timer !== false){ clearTimeout(_timer); }
			_timer = setTimeout(function(){_scroll = true;
			_floatbox.animate({"top": "10px"},{easing: "linear"}, {duration: 500});}, 400);
	});


	//Ajax form submit
    $("#submit_btn").click(function() {
        var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields
        $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
            $(this).css('border-color','');
            if(!$.trim($(this).val())){ //if this field is empty
                $(this).css('border-color','red'); //change border color to red
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red
                proceed = false; //set do not proceed flag
            }
        });

        if(proceed) //everything looks good! proceed...
        {
            //get input field values data to be sent to server
            post_data = {
                'user'     : $('input[name=name]').val(),
                'movie'    : $('input[name=movie]').val(),
                'imdb'  : $('input[name=IMDBlink]').val(),
                'donate'        : $('select[name=donate]').val(),
                'message'       : $('textarea[name=message]').val()
            };

            //Ajax post data to server
            var output='';
            $.post('save.php', post_data, function(response){
                if(response !== 1){ //load json data from server and output message
                    output = '<div class="error">Oops! Some error occured.</div>';
                    //alert('Error:'+response);
                }else{
                    output = '<div class="success">You request submitted successfully!</div>';
                    //reset values in all input fields
                    $("#contact_form  input[type=text], #contact_form textarea").val('');
                    $("#contact_form  select option").prop('selected', function() {
                          return this.defaultSelected;
                      });
                    populateTable();
                    setTimeout(function() {
                      toggle_floatbox();
                    }, 2000);
                }
                $("#contact_form #contact_results").hide().html(output).slideDown();
            }, 'json');
        }
    });

    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() {
        $(this).css('border-color','');
        $("#result").slideUp();
    });

});

function populateTable() {
  var tableContent = '';

  //jQuery AJAX call
    $.ajax({
    type: "GET",
    url: 'get.php',
    data: '',
    success: function(data){
      //inject the whole table content string into our existing HTML div
      $('#requestsTable').html(data);
    }
  });

}

</script>

</head>
<body>

  <!-- contact form start -->
<div class="floating-form" id="contact_form">
<div class="contact-opener">Request A Movie</div>
    <div class="floating-form-heading">Request Movie</div>
    <div id="contact_results"></div>
    <div id="contact_body">
        <label><span>UserName<span class="required">*</span></span>
        	<input type="text" name="name" id="name" required="true" class="input-field">
        </label>
        <label><span>MovieName<span class="required">*</span></span>
        	<input type="text" name="movie" required="true" class="input-field">
        </label>
        <label><span>IMDB Link</span>
        	<input type="text" name="IMDBlink" required="false" class="input-field">
        </label>
        <label for="subject"><span>Donation:</span>
            <select name="donate" class="select-field">
            <option value="5">Select an Option</option>
            <option value="0">Donate a HD Movie</option>
            <option value="5">Donate Min Taka 5</option>
            </select>
        </label>
        	<label for="field5"><span>Comment </span>
        	<textarea name="message" id="message" class="textarea-field" required="false"></textarea>
        </label>
        <label>
        	<span>&nbsp;</span><input type="submit" id="submit_btn" value="Submit">
        </label>
    </div>
</div>
<!-- contact form end -->

<div id="requestsTable">
</div>

</body>
</html>
