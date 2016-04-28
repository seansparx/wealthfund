
// When the browser is ready...
$(document).ready(function(){
    // Setup form validation on the #register-form element
    validate_login_form();
    
    custom_rules(); // keep in last.
});


function validate_login_form()
{
    $("#login-form").validate({
        // Specify the validation rules
        "onkeyup":false,
        rules: {
            userName: {
                required: true,
                username : true
            },
            userPassword: {
                required: true,
                maxlength: 50
            }
        },
        // Specify the validation error messages
        messages: {
            userName: {
                required: "Enter your username."
            },
            userPassword: {
                required: "Enter password."
            }
        },
        errorPlacement: function (error, element) {
            //var el_id = $(element).attr('id');
            error.insertAfter(element);
        },
        success: function(label, element){
            //console.log(element.id);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    
  }
  
    
   



