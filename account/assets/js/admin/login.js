
// When the browser is ready...
$(document).ready(function(){
    // Setup form validation on the #register-form element
    validate_login_form();
    validate_system_config_form();
    
    custom_rules(); // keep in last.
});


function custom_rules()
{    
    /** Rule to validate mobile no format. */
    $.validator.addMethod("mobile_no", function (value, element) {
        //var filter = /^(\+\d{2}|0)?\d{10}$/;
         var filter = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
        return filter.test(value);
    }, "Enter a valid mobile number.");


    /** Rule to validate strong password. */
    $.validator.addMethod("strong_pwdcheck", function (value, element) {
        if ($.trim(value) == '') {
            return true;
        }
        var filter = /^(?=.*[A-Za-z])(?=.*[`~!@#$%^&*()+={}|;:'",.<>\/?\\-])(?=.*[0-9])(?=.*[a-z]).{6,}$/;
        return filter.test(value);
    }, "Should contain at least 1-digit, 1-alphabet, 1-symbol @#$&.");

    /** Rule to validate very strong password. */
    $.validator.addMethod("vstrong_pwd", function (value, element) {
        if ($.trim(value) == '') {
            return true;
        }
        var filter = /^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$/;
        return filter.test(value);
    }, "Enter at least 2 upper alphabet, 1 symbol @#$&, 2 digits and 3 lower alphabet.");



    //Validation rules for alphanumeric    
    $.validator.addMethod("alphanumeric", function (value, element) {
        return /^[a-zA-Z][a-zA-Z0-9/'._\s]+$/.test(value);
    }, "Enter valid characters");

}



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
  
    function validate_system_config_form()
   {
       
    $("#system_config").validate({
       
        // Specify the validation rules
        "onkeyup":false,
        rules: {
            SMTP_PORT: {
                required: true
               
            },
            SMTP_MAIL: {
              required: true,
              email: true
            },
            SMTP_PASSWORD: {
                required: true,
                maxlength: 30,
                minlength: 6,
                strong_pwdcheck: true
            },
            CONF_SMTP_PASSWORD: {
                required: true,
                equalTo: "#SMTP_PASSWORD",
                maxlength: 30,
                minlength: 6,
                strong_pwdcheck: true
            },
            CURRENCY_CODE: {
                required: true
               
            },
            CURRENCY_SYMBOL: {
                required: true
               
            }
        },
        // Specify the validation error messages
        messages: {
            SMTP_PORT: {
                required: "Enter smtp port."
            },
            SMTP_MAIL: {
              required: "Enter smtp email"  
            },
            SMTP_PASSWORD: {
                required: "Enter smtp password."
            },
            CONF_SMTP_PASSWORD: {
                required: "Enter confirm smtp password."
            },
            CURRENCY_CODE: {
              required: "Enter smtp email"  
            },
            CURRENCY_SYMBOL: {
              required: "Enter smtp email"  
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
   



