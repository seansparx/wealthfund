
$(document).ready(function(){
    // Setup form validation on the #register-form element
  
});
function validationLogin()
{
	if(document.getElementById('userName').value=="")
	{
              var message = "Please enter username";
		$('.username').append('<span style="color:red">'+ message);
		//document.getElementById('userName').focus();
		return false;
	}
		
	if(document.getElementById('userPassword').value=="")
	{
                 var message = "Please enter valid password";
		$('.password').append('<span style="color:red">'+message);
		//document.getElementById('userName').focus();
		return false;
	}
}

function validationSystemConfig()
{
    
    
	var smtp = $("#SMTP_HOST").val();
        //alert(smtp);
        if(smtp == ''){
            var message = "Please insert smtp host";
            $('.smtp_host').append('<span style="color:red">'+ message);
            return false;
        }
        
        var smtp = $("#SMTP_PORT").val();
        //alert(smtp);
        if(smtp == ''){
            var message = "Please insert smtp port";
            $('.smtp_port').append('<span style="color:red">'+ message);
            return false;
        }
}