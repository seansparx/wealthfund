    var ajax_req;

// When the browser is ready...
$(document).ready(function () {

    // Setup form validation on the #login-form element  
    if(getCookie('rememberMe')=='1'){
		
		var userEmail = getCookie('login_email');
		var userPass = getCookie('login_password');
    
		$('#login_password').val(userPass);
		$('#user_login_email').val(userEmail);
		$("#remember").attr('checked', true);
	}
    validate_login_form();
    btn_generate_token();
    custom_login_rules(); // keep in last.

//    $('#submit_login').click(function() {        
//        
//        if ($("#user_login").valid()) {
//            
//            
//        }
//        
//    });
});

function base_url(path)
{
    return $("#base_url").val() + path + "/";
}
function site_url(path)
{
    return $("#site_url").val() + path + "/";
}
function submit_user_form()
{
    if ($("#form-add-user").valid()) {
        $("#form-add-user").submit();
    }
}


function chechPasswordExistence()
{
    /** Rule to check user password exists or not. */
    var userPassword = hex_sha512($('#login_password').val());
    var userEmail = $('#user_login_email').val();
    var flag = false;
    $.ajax({
        url: site_url('ajax/check_password_existence'),
        data: {"action": "signup", "value": userPassword, 'emailId': userEmail},
        type: 'post',
        async: false,
        success: function (responsePassword) {
			
            var resp = JSON.parse(responsePassword);
            if (resp.success && resp.msg==true) {
                flag = true;
            }
            else {
                flag = resp.msg;
            }
        },
        complete: function (responsePassword) {

        }
    });
    return flag;
}


function chechEmailExistence() {

    /** Rule to check user email exists or not. */
    var userEmail = $('#user_login_email').val();
    var flag = false;
    ajax_req = $.ajax({
        url: site_url('ajax/unique_email'),
        data: {"action": "signup", "value": userEmail},
        type: 'post',
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
}
function btn_generate_token()
{
    $("#submit_login").click(function () {
        var token = $(this).attr('token');
        //alert(token);
        if (ajax_req) {
            ajax_req.abort();
        }

        var flag = false;

        ajax_req = $.post(site_url('ajax/login_token'), {'token': token}, function (msg) {
            //alert(msg);
        });
    });
}

function custom_login_rules()
{
    /** Rule to validate strong password. */
    $.validator.addMethod("strong_pwds", function (value, element) {
        if ($.trim(value) == '') {
            return true;
        }
        var filter = /^(?=.*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{6,}$/;
        return filter.test(value);
    }, "Should contain at least 1-digit, 1-alphabet, 1-symbol @#$&.");
}


function validate_login_form()
{
    $("form#user_login").validate({
        // Specify the validation rules
        rules: {
            user_login_email: {
                required: true,
                email: true
            },
            login_password: {
                required: true,
                maxlength: 30,
                minlength: 6
            }
        },
        // Specify the validation error messages
        messages: {
            user_login_email: {
                required: "Enter your email address."
            },
            login_password: {
                required: "Enter password."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function (label, element) {
            $("label:first-child").remove().after('#user_login_email');
            $("p:first-child").remove().after('#user_login_email');
        },
        submitHandler: function (form) {

            $("#submit_login").addClass('disabled');

            var flag = chechPasswordExistence();

            if (flag == true)
            {
                submit_form_hash(form);
            }
            else {
                $('#login_password').addClass('error');
                $("label:first-child").remove().after('#login_password');
                $("p:first-child").remove().after('#login_password');
                $("#user_login_email").after("");

                if ($.trim(flag) != '') {
                    $("#login_password").after("<label for='login_password' generated='true' class='' ><p style='color:#cc5965;'>" + flag + "</p></label>");
                }
                $("#submit_login").removeClass('disabled');
                return false;
            }
        }
    });

}


function submit_form_hash(form)
{
    var password = document.getElementById('login_password');

    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 

    document.getElementById('user_login').appendChild(p);
    p.name = "p";
    p.id = "p";
    p.type = "hidden";
    
    var pwd = hex_sha512(password.value);
    p.value = pwd;
    var oldPassword = password.value;
	
    // Make sure the plaintext password doesn't get sent. 
    
    setLoginCookies(oldPassword);
    
    password.value = pwd;	
    	 
	
    // Finally submit the form. 
    form.submit();
}

// Function to set cookie details for loggedIn user 
 
function setLoginCookies(oldPassword){
	
	var loginEmail = $('#user_login_email').val();
    if($("#remember").is(':checked')){
		setCookie('login_password',oldPassword);
		setCookie('login_email',loginEmail);
		setCookie('rememberMe','1');
		setCookie('WEALTHFUNDUSER','1');
		
	}else{
		setCookie('login_password',"");
		setCookie('login_email',"");
		setCookie('rememberMe',"");
		setCookie('WEALTHFUNDUSER',"");
	}   
}
function setCookie(key, value) {
	var expires = new Date();
	expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000));
	document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
	var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
	return keyValue ? keyValue[2] : null;
}
