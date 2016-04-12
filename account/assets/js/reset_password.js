var ajax_req;

// When the browser is ready...
$(document).ready(function(){
    // Setup form validation on the #register-form element
    validate_login_form();
        
    custom_rules(); // keep in last.
});

function base_url(path)
{
    return $("#base_url").val()+path+"/";
}

function site_url(path)
{
    return $("#site_url").val()+path+"/";
}


function submit_user_form()
{
    if($("#form-add-user").valid()){
        $("#form-add-user").submit();
    }
}


function custom_rules()
{
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
    $("#user_resetpassword").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            
            password: {
                required: true,
                maxlength: 30,
                minlength: 6,
                strong_pwdcheck: true
            },
            passconf: {
                required: true,
                equalTo: "#password",
                maxlength: 30,
                minlength: 6,
                strong_pwdcheck: true
            }
        },
        // Specify the validation error messages
        messages: {
            
            password: {
                required: "Enter password."
            },
            passconf: {
                required: "Confirm your password.",
                equalTo: "Password does not match.",
            }
        },
        errorPlacement: function (error, element) {
            var el_id = $(element).attr('id');
            if( el_id == 'terms'){
                $("#"+el_id).parent().after(error);
            }
            else{
                error.insertAfter(element);
            }
            error.insertAfter(element);
        },
        success: function(label, element){
            //console.log(element.id);
            var msg = '';
            
            switch(element.id){
                case 'user_email': msg = '<p style="color:green;">Email Address is available for use.</p>'; break;
                default          : msg = '<p style="color:green;">Success.</p>';
            }
            
            //label.addClass("valid").html(msg);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}


function formhash(form,password) 
{
    //console.log(form)
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    
    document.login_form.appendChild(p);
    p.name = "p";
    p.id = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    return true;
    // Finally submit the form. 
   // form.submit();
}
