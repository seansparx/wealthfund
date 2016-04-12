var ajax_req;

// When the browser is ready...
$(document).ready(function(){
    // Setup form validation on the #register-form element
    validate_signup_form();
    
    custom_rules(); // call in last.
});


function submit_user_form()
{
    if($("#form-add-user").valid()){
        $("#form-add-user").submit();
    }
}


function custom_rules()
{
    /** Rule to check duplicate email of admin user. */
    $.validator.addMethod("admin_unique_email", function (value, element) {
        if(ajax_req) { ajax_req.abort(); }
        
        var flag = false;
        
        ajax_req = $.ajax({
            url : base_url()+'admin/users/is_email_unique',
            data:{"value": value},
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

    }, "Email already exists."); 
    
    
    /** Rule to validate image format. */
    $.validator.addMethod("image_format", function (value, element) {
        
        var fd = new FormData();    
        fd.append( 'file', input.files[0] );
        
        if(ajax_req) { ajax_req.abort(); }
        var flag = false;
        
        ajax_req = $.ajax({
            url : base_url()+'admin/ajax/is_valid_image',
            type:'post',
            data: fd,
            processData: false,
            contentType: false,
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

    }, "Invalid image format."); 
}


function validate_signup_form()
{
    $("#signup").validate({
        // Specify the validation rules
        rules: {
            username: {
                required: true
            },
            mobile: {
                required :true,
                email:true
            },
            password: {
                required: true,
                minlength: 6
            },
            passconf: {
                equalTo: "#password",
                minlength: 6
            }
        },
        // Specify the validation error messages
        messages: {
            username: {
                required: "Please enter username."
            },
            mobile: {
                required: "Please enter mobile number."
            },
            password: {
                required: "Please enter password."
            },
            passconf: {
                required: "Please enter confirm password."
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}


function formhash(form,password) { 
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