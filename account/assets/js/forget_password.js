var ajax_req;

// When the browser is ready...
$(document).ready(function() {
    // Setup form validation on the #login-form element  
    validate_forgetpassword_form();

    $('#submit_forget_password').click(function() {
        if ($("#forget_password_form").valid()) {
            emailLabel = "";
            if (checkEmailExistence()) {
                status = checkRegisteredEmailExistence();
                if (status == 'false') {

                    $('#forget_user_email').addClass('error');
                    emailLabel = "<label for='forget_user_email' generated='true' class='' ><p style='color:#cc5965;'>Invalid Email Address.Ensure the email address is the one provided at the time of registration.</p></label>";

                    $("label:first-child").remove().after('#forget_user_email');
                    $("p:first-child").remove().after('#forget_user_email');
                    $("#forget_user_email").after(emailLabel);
                    return false;
                }
            }
            else {
                $('#forget_user_email').addClass('error');
                emailLabel = "<label for='forget_user_email' generated='true' class='' ><p style='color:#cc5965;'>You have not done the registration process.</p></label>";

                $("label:first-child").remove().after('#forget_user_email');
                $("p:first-child").remove().after('#forget_user_email');
                $("#forget_user_email").after(emailLabel);
                return false;
            }
        }
    });
});

function base_url(path)
{
    return $("#base_url").val() + path + "/";
}
function site_url(path)
{
    return $("#site_url").val() + path + "/";
}

function validate_resetpassword_Verify_form()
{

    $("#forgetpassword_otp_form").validate({
        // Specify the validation rules
        rules: {
            forgetpassword_otp: {
                required: true,
                //email: true,
                user_verified_email_exists: false
            }
        },
        // Specify the validation error messages
        messages: {
            user_email: {
                required: "Enter your verification code."
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        success: function(label, element) {
            var msg = '';

            switch (element.id) {
                case 'user_login_email':
                    msg = '<p style="color:green;">Success.</p>';
                    break;
                default          :
                    msg = '<p style="color:green;">Success.</p>';
            }

            //label.addClass("valid").html(msg);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
}
function validate_forgetpassword_form()
{

    $("#forget_password_form").validate({
        // Specify the validation rules
        rules: {
            user_email: {
                required: true,
                //email: true,
                user_verified_email_exists: false
            }
        },
        // Specify the validation error messages
        messages: {
            user_email: {
                required: "Enter your email address."
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        success: function(label, element) {
            var msg = '';

            switch (element.id) {
                case 'user_login_email':
                    msg = '<p style="color:green;">Success.</p>';
                    break;
                default          :
                    msg = '<p style="color:green;">Success.</p>';
            }

            //label.addClass("valid").html(msg);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
}
function matchValidOtp() {

    var verifyOtp = $('#forgetpassword_otp').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('login/verify_otp_password'),
        data: {"action": "signup", "verifyOtp": verifyOtp},
        type: 'post',
        async: false,
        success: function(response) {

            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    alert(flag);
    return false;
    return flag;
}
function sendOtpPassword() {
    var userMobile = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('login/send_otp_password'),
        data: {"action": "signup", "mobile": userMobile},
        type: 'post',
        async: false,
        success: function(response) {

            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return flag;
}
function sendRecoverPassword() {

    var userEmail = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('login/forget_password'),
        data: {"action": "signup", "forget_user_email": userEmail},
        type: 'post',
        async: false,
        success: function(response) {

            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return flag;
}
function checkRegisteredMobileExistence() {
    /** Rule to check user mobile exists or not. */

    var userEmail = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('ajax/registered_mobile_verification'),
        data: {"action": "signup", "value": userEmail},
        type: 'post',
        async: false,
        success: function(response) {

            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return flag;
}
function checkRegisteredEmailExistence() {

    /** Rule to check user email exists or not. */
    var userEmail = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('ajax/registered_email_verification'),
        data: {"action": "signup", "value": userEmail},
        type: 'post',
        async: false,
        success: function(response) {

            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return flag;
}
function checkMobileExistence() {
    /** Rule to check user mobile exists or not. */
    var userMobile = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('ajax/checkMobileExistence'),
        data: {"action": "signup", "value": userMobile},
        type: 'post',
        async: false,
        success: function(response) {
            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return flag;
}
function checkEmailExistence() {

    /** Rule to check user email exists or not. */
    var userEmail = $('#forget_user_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('ajax/unique_email'),
        data: {"action": "signup", "value": userEmail},
        type: 'post',
        async: false,
        success: function(response) {
            if (response) {
                flag = true;
            }
            else {
                flag = false;
            }
        },
        complete: function(response) {

        }
    });
    return !flag;
}
function formhash(form, password) {

    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 

    document.getElementById('user_login').appendChild(p);
    p.name = "p";
    p.id = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    //password.value = p.value;

    return true;
    // Finally submit the form. 
    // form.submit();
}
