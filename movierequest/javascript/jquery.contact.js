
var userHandler = {
    username : '',
    status : ''
}

$(document).on('pagecontainershow', function (e, ui) {
               var activePage = $(':mobile-pagecontainer').pagecontainer('getActivePage');
               if(activePage.attr('id') === 'feedback')
               {
                    $(document).on('click', '#send', function()  // catch the form's submit event
                    {
                            if(1)//$('#name').val().length > 0 && $('#subject').val().length > 0 && $('#message').val().length > 0)
                            {
                                  userHandler.username = $('#name').val();
                                  
                                  // Send data to server through the Ajax call
                                  // action is functionality we want to call and outputJSON is our data
                                  $.ajax
                                   ({
                                         type         : 'POST',
                                         url          : 'php/contact.php?ts='+new Date().getTime(),
                                         dataType     : 'json',
                                         data         : $('#ContactForm').serialize(),
                                         async: 'true',
                                         beforeSend: function()
                                         {
                                             // This callback function will trigger before data is sent
                                             $.mobile.loading('show'); // This will show Ajax spinner
                                         },
                                         complete: function()
                                         {
                                             // This callback function will trigger on data sent/received complete
                                             $.mobile.loading('hide'); // This will hide Ajax spinner
                                         },
                                        success: function(data,textStatus)
                                         {
                                             // Check if authorization process was successful
                                             if(data.result == '1')
                                             {
                                                $('#ContactForm')[0].reset();
                                                 userHandler.status = 'success';
                                                 $.mobile.changePage("#second");
                                             }
                                             else
                                             {
                                                var allMessage = '';
                                                for(var i=0; i < data.errors.length; ++i )
                                                {
                                                    if(data.errors[i].value!='')
                                                    {
                                                        allMessage = allMessage  + data.errors[i].value + '; ';
                                                    }
                                    
                                                }
                                                //$('#message').parent().css('border-color','red');
                                                alert('Something went wrong! ' + allMessage);
                                             }
                                         },
                                         error: function (request,error)
                                            {
                                             // This callback function will trigger on unsuccessful action
                                             alert('Network error has occurred please try again!');
                                            }
                                    });
                            }
                            else{
                                   alert('Please fill all necessary fields started with *');
                              }         
                              return false; // cancel original event to prevent form submitting
                    });
               }
               else if(activePage.attr('id') === 'second')
               {
                    activePage.find('.ui-content').text('Your feedback was submitted successfully, ' + userHandler.username);
               }
});

