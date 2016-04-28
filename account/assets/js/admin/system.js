
// When the browser is ready...
$(document).ready(function(){

    validate_add_user_form();
        
    custom_rules(); // keep in last.
});



function validate_add_user_form()
{
    $("#form-add-user").validate({
        // Specify the validation rules
        rules: {
            username: {
                required :true,
                maxlength: 100,
                minlength: 2,
                alphanumeric:true
            },
            user_email: {
                required: true,
                email : true,
                admin_unique_email :true
            },
            new_password: {
                required: true,
                maxlength: 30,
                minlength: 6,
                strong_pwdcheck: true
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password",
                maxlength: 30
            }
        },
        // Specify the validation error messages
        messages: {
            username: {
                required: "Enter username."
            },
            user_email: {
                required: "Enter email address."
            },
            new_password: {
                required: "Enter new password."
            },
            confirm_password: {
                required: "Retype password.",
                equalTo: "Password does not match."
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
