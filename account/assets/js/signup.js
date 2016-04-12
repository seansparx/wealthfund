var ajax_req;

// When the browser is ready...
$(document).ready(function(){
    // Setup form validation on the #register-form element
    validate_signup_form();
    validate_otp_form();
    btn_resend_otp();
    
    custom_rules(); // keep in last.
});

function btn_resend_otp()
{
    $("#resend_otp").click(function(){
        var token = $(this).attr('token');
        
        if(ajax_req) { ajax_req.abort(); }
        
        $('.resend-otp').remove();
        $("#signup_otp_form #resend_otp").html('Please Wait..');
        $("#signup_otp_form #resend_otp").attr('disabled', true);
        
        var flag = false;
        
        ajax_req = $.post(site_url('ajax/resend_otp'),{'token':token}, function(msg){
            if(msg == 'sent'){
                $("#signup_otp_form #submit_activation_code").after('<label class="resend-otp" style="color:green">Verification code has been sent</label>');
            }
            else{
                $("#signup_otp_form #submit_activation_code").after('<label class="resend-otp error">'+msg+'</label>');
            }
            $("#signup_otp_form #resend_otp").html('Resend Activation Code');
            $("#signup_otp_form #resend_otp").attr('disabled', false);
        });
    });
}

function loginModalShow() {
	$('#modal-form').modal('show');
}
function showForgetPassword() {
	$('#myModal-forget').modal('show');
}

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
    /** Rule to check duplicate email of user. */
    $.validator.addMethod("signup_unique_email", function (value, element) {
                
        if(ajax_req) { ajax_req.abort(); }
        
        var flag = false;
        
        ajax_req = $.ajax({
            url : site_url('ajax/unique_email'),
            data:{"action": "signup", "value": value},
            type:'post',
            async: false,
            success: function(response){
                if (response) {
                    flag = true;
                }
                else {
                    flag = false;
                }
            },
            complete:function(response){
                
            }
        });
       
        return flag;

    }, "User Already Registered."); 
    
    
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



    /** Rule to validate image format. */
    $.validator.addMethod("image_format", function (value, element) {

        var fd = new FormData();
        fd.append('file', input.files[0]);

        if (ajax_req) {
            ajax_req.abort();
        }
        var flag = false;

        ajax_req = $.ajax({
            url: base_url() + 'admin/ajax/is_valid_image',
            type: 'post',
            data: fd,
            processData: false,
            contentType: false,
            async: false,
            success: function (response) {
                if (response) {
                    flag = true;
                }
                else {
                    flag = false;
                }
            },
            complete: function (response) {

            }
        });

        return flag;

    }, "Invalid image format.");


    //Validation rules for alphanumeric    
    $.validator.addMethod("alphanumeric", function (value, element) {
        return /^[a-zA-Z][a-zA-Z0-9/'._\s]+$/.test(value);
    }, "Enter valid characters");

}


function validate_otp_form()
{
    $("#signup_otp_form").validate({
        // Specify the validation rules
        rules: {
            otp: {
                required: true
            }
        },
        // Specify the validation error messages
        messages: {
            otp: {
                required: "Enter 6 digits Activation Code."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            verify_mobile();
            //form.submit();
        }
    });
}


function verify_mobile()
{
        $("#submit_activation_code").attr("disabled", true);
        $("#submit_activation_code").html('Please Wait..');
        
        if (ajax_req) {
            ajax_req.abort();
        }

        var param = $("#signup_otp_form").serialize();

        ajax_req = $.post(base_url('signup/verify_mobile'), param, function(response){   
            if($.trim(response) == 'complete'){
                $("#signup_otp_form #otp").after('<label style="color:green">OTP Verified.</label>');
                window.location.replace(site_url('signup/complete'));
            }
            else{
                $("#signup_otp_form #otp").after(response);
            }
            $("#submit_activation_code").html('Verify');
            $("#submit_activation_code").attr("disabled", false);
            
        });
}


function validate_signup_form()
{
    $("#user_signup").validate({
        // Specify the validation rules
        "onkeyup":false,
        rules: {
            user_email: {
                required: true,
                email : true,
                signup_unique_email :true
            },
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
            },
            user_mobile: {
                required :true,
                maxlength: 15,
                minlength: 10,
                mobile_no:true
            },
            country_code: {
                required :true                
                
            },
            prefix: {
                required :false
            },
            full_name: {
                required :true,
                maxlength: 100,
                minlength: 2,
                alphanumeric:true
            },
            captcha_code: {
                required :true,
                maxlength: 50,
                minlength: 1
            },
            terms:{
                required :true
            }
        },
        // Specify the validation error messages
        messages: {
            user_email: {
                required: "Enter your email address."
            },
            password: {
                required: "Enter password."
            },
            passconf: {
                required: "Retype your password.",
                equalTo: "Password does not match.",
            },
            user_mobile: {
                required: "Enter your mobile number."
            },
            prefix: {
                required: "please select title."
            },
            full_name: {
                required: "Enter your full name."
            },
            terms:{
                required: "Terms and policy is required."
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
            
            label.addClass("valid").html(msg);
        },
        submitHandler: function (form) {
            save_and_ask_otp();
        }
    });
}


function save_and_ask_otp()
{
        $("#submit_signup").attr("disabled", true);
        $("#submit_signup").html('Please Wait..');
        
        $(".signup-msg").remove();
        
        if (ajax_req) {
            ajax_req.abort();
        }

        var param = $("#user_signup").serialize();

        ajax_req = $.post(base_url('signup/index'), param, function(response){
            if(response == 'sent'){
                $("#myModal_actCode").modal();
            }
            else{
                $("#submit_signup").before('<label class="signup-msg error">'+response+'</label>');
            }
            $("#submit_signup").html('Register');
            $("#submit_signup").attr("disabled", false);
            
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
