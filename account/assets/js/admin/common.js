
function custom_rules()
{
    /** Rule to check duplicate email of user. */
    $.validator.addMethod("admin_unique_email", function (value, element) {
                
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


    //Validation rules for alphanumeric    
    $.validator.addMethod("alphanumeric", function (value, element) {
        return /^[a-zA-Z][a-zA-Z0-9/'._\s]+$/.test(value);
    }, "Enter valid characters");

}
