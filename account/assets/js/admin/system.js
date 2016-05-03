
// When the browser is ready...
$(document).ready(function () {
    
    validate_add_user_form();
    validate_system_config_form();
    validate_website_users_form();

    custom_rules(); // keep in last.
    
    init_active_button();
});


function init_active_button()
{
    $("#dataTables-admin_users .active").unbind('click').bind('click', function() {
        var element = $(this);
        var id = element.data('key');
        $.post(site_url('admin/ajax/change_status'), {"action":"0", "id": id, "token" : get_token()}, function(resp) {
            element.parent().html('<a class="btn btn-default btn-rounded btn-outline ladda-button inactive" href="javascript:void(0);" data-style="zoom-in" data-key="'+id+'"><i class="fa fa-eye-slash"></i> Inactive</a>');
            init_active_button();
            init_loading_buttons();
        });
    });
    
    $("#dataTables-admin_users .inactive").unbind('click').bind('click', function() {
        var element = $(this);
        var id = element.data('key');
        $.post(site_url('admin/ajax/change_status'), {"action":"1", "id": id, "token" : get_token()}, function(resp){
            element.parent().html('<a class="btn btn-primary btn-rounded btn-outline ladda-button active" href="javascript:void(0);" data-style="zoom-in" data-key="'+id+'"><i class="fa fa-eye"></i> Active</a>');
            init_active_button();
            init_loading_buttons();
        });
    });
    
    $("#dataTables-manage_users .active").unbind('click').bind('click', function() {
        var element = $(this);
        var id = element.data('key');
        $.post(site_url('admin/ajax/change_user_status'), {"action":"0", "id": id, "token" : get_token()}, function(resp) {
            element.parent().html('<a class="btn btn-default btn-rounded btn-outline ladda-button inactive" href="javascript:void(0);" data-style="zoom-in" data-key="'+id+'"><i class="fa fa-eye-slash"></i> Inactive</a>');
            init_active_button();
            init_loading_buttons();
        });
    });
    
    $("#dataTables-manage_users .inactive").unbind('click').bind('click', function() {
        var element = $(this);
        var id = element.data('key');
        $.post(site_url('admin/ajax/change_user_status'), {"action":"1", "id": id, "token" : get_token()}, function(resp){
            element.parent().html('<a class="btn btn-primary btn-rounded btn-outline ladda-button active" href="javascript:void(0);" data-style="zoom-in" data-key="'+id+'"><i class="fa fa-eye"></i> Active</a>');
            init_active_button();
            init_loading_buttons();
        });
    });
}


function validate_add_user_form()
{
    $("#form-add-user").validate({
        
        // Specify the validation rules
        rules: {
            username: {
                required: true,
                maxlength: 100,
                minlength: 2,
                alphanumeric: true
            },
            user_email: {
                required: true,
                email: true,
                admin_unique_email: true
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
        success: function (label, element) {
            //console.log(element.id);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}

function validate_website_users_form()
{
     $("#form-website_user").validate({
         
        // Specify the validation rules
        rules: {
            full_name: {
                required: true,
                maxlength: 100,
                minlength: 2,
                alphanumeric: true
            },
            user_email: {
                required: true,
                email: true,
                admin_unique_user_email: true
            },
            mobile: {
              required: true,
              //maxlength:10,
              minlength:10,
              numeric: true
            }
           
        },
        // Specify the validation error messages
        messages: {
            full_name: {
                required: "Enter User full name."
            },
            user_email: {
                required: "Enter email address."
            },
            mobile: {
                required: "Enter mobile number"
            }            
           
        },
        errorPlacement: function (error, element) {
            //var el_id = $(element).attr('id');
            error.insertAfter(element);
        },
        success: function (label, element) {
            //console.log(element.id);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}

function validate_system_config_form()
{
    $("#form_system_config").validate({
        // Specify the validation rules
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
                minlength: 6
            },
            CONF_SMTP_PASSWORD: {
                required: true,
                equalTo: "#SMTP_PASSWORD",
                maxlength: 30,
                minlength: 6
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
                required: "Retype smtp password."
            },
            CURRENCY_CODE: {
                required: "Enter currency code"
            },
            CURRENCY_SYMBOL: {
                required: "Enter currency symbol"
            }

        },
        errorPlacement: function (error, element) {
            //var el_id = $(element).attr('id');
            error.insertAfter(element);
        },
        success: function (label, element) {
            //console.log(element.id);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}
