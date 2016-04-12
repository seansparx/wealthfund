var property_type;
var vehicle_type;
var vehicle_param2;
var vehicle_param3;
var realestate_param;
var cash_param;

$(function(){
        
    /** Configure More Vehicle step 1 */
    $("#myModal-vahicle #btn_next").click(function() {
        property_type = 'Vehicle';
        vehicle_type = $("#form_vehicle_step1 #vehicle_type").val();
        $("#myModal-carvalue .modal-title").text("Let's find the value of your "+toTitleCase(vehicle_type));
        $("#myModal-edit-carvalue .modal-title").text('Edit the details of your '+toTitleCase(vehicle_type));
        $("#myModal-edit-carvalue #form_vehicle_step3 #property_name").val(toTitleCase(vehicle_type));
        $("#myModal-vahicle").modal('hide');
        
        /** @todo skiped.
         * $("#myModal-carvalue").modal('show'); */
        
        $("#myModal-edit-carvalue").modal('show');
    });
    
    /** Configure More Vehicle step 2 */
    $("#myModal-carvalue #btn_showme").click(function() {
        vehicle_param2 = $("#form_vehicle_step2").serialize();        
        $("#myModal-carvalue").modal('hide');
        $("#myModal-edit-carvalue").modal('show');
        $("label.error").remove();
        $(".error").removeClass('error');
    });
    
    
    /** Configure More Vehicle step 3 */
    $("#myModal-edit-carvalue #btn_add").click(function() {
        
            if($("#form_vehicle_step3").valid()){
                    $("#myModal-edit-carvalue #btn_add").attr('disabled', true);        
                    vehicle_param3 = $("#form_vehicle_step3").serialize();        
                    var param = vehicle_type+'&'+vehicle_param2+'&'+vehicle_param3+'&property_type='+property_type+'&token='+site_token();

                    $.post(base_url('overview/configure_more'), param, function(response){

                        $("#myModal-edit-carvalue #btn_add").attr('disabled', false);

                        if(response == 1) {
                            $("#myModal-edit-carvalue").modal('hide');
                            $("#myModal-success").modal('show');
                            $('#form_vehicle_step1')[0].reset();
                            $('#form_vehicle_step2')[0].reset();
                            $('#form_vehicle_step3')[0].reset();
                        }
                        else{

                        }
                    });
            }        
        
    });
    
    /** Configure More Realestate step 1 */
    $("#myModal-realState #btn_next").click(function() {
        if($("#form_realestate_step1").valid()){
            property_type = 'Real Estate';
            realestate_param = $("#form_realestate_step1").serialize();
            $("#myModal-realState").modal('hide');
            $("#myModal-realStatevalue").modal('show');
        }
    });
    
    
    /** Configure More Realestate step 2 */
    $("#myModal-realStatevalue #btn_add").click(function() {
        
        if($("#form_realestate_step2").valid()){            
            $("#myModal-realStatevalue #btn_add").attr('disabled', true);            
            var param = $("#form_realestate_step2").serialize()+'&'+realestate_param+'&property_type='+property_type+'&token='+site_token();                        
            
            $.post(base_url('overview/configure_more'), param, function(response) {
                $("#myModal-realStatevalue #btn_add").attr('disabled', false);
                if(response == 1) {
                    $("#myModal-realStatevalue").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_realestate_step1')[0].reset();
                    $('#form_realestate_step2')[0].reset();
                }
                else{
                    //alert(response);
                }
            });

        }
    });
    
    
    /** Configure More cash & debt step 1 */
    $("#myModal-cash #btn_next").click(function() {
        if($("#form_cashdebt_step1").valid()){
            cash_param = $("#form_cashdebt_step1").serialize();
            $("#myModal-cash").modal('hide');
            $("#myModal-cashvalue").modal('show');
        }
    });
    
    
    /** Configure More cash & debt step 2 */
    $("#myModal-cashvalue #btn_add").click(function() {
        if($("#form_cashdebt_step2").valid()){
        
            $("#myModal-cashvalue #btn_add").attr('disabled', true);
            var param = $("#form_cashdebt_step2").serialize()+"&"+cash_param+'&token='+site_token();  
            
            $.post(base_url('overview/configure_more'), param, function(response) {
                $("#myModal-cashvalue #btn_add").attr('disabled', false);
                if(response == 1) {
                    $("#myModal-cashvalue").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_cashdebt_step1')[0].reset();
                    $('#form_cashdebt_step2')[0].reset();
                }
                else{
                    //alert(response);
                }
            });
        }
    });
    
    
    validate_property_form();
    
    validate_realestate_form();
    
    validate_cashdebts_form();
    
    custom_rules(); // Keep it in last.
});


function custom_rules()
{      
    /** Rule to validate mobile no format. */
    $.validator.addMethod("mobile_no", function (value, element) {
        //var filter = /^(\+\d{2}|0)?\d{10}$/;
         var filter = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
        return filter.test(value);
    }, "Enter a valid mobile number.");


    //Validation rules for alphanumeric    
    $.validator.addMethod("alphanumeric", function (value, element) {
        return /^[a-zA-Z][a-zA-Z0-9/'._\s]+$/.test(value);
    }, "Enter valid characters");

}



function validate_property_form()
{
    $("#form_vehicle_step3").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            property_amt: {
                required: true,
                maxlength: 11,
                minlength: 1,
                number:true
            },
            property_name: {
                required :true,
                maxlength: 100,
                minlength: 2,
                alphanumeric:true
            }
        },
        // Specify the validation error messages
        messages: {
            property_amt: {
                required: "Enter Amount."
            },
            property_name: {
                required: "Enter Title."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function(label, element){
            
        },
        submitHandler: function (form) {
            // Not required.
        }
    });
}


function validate_realestate_form()
{
    $("#form_realestate_step1").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            apartment: {
                maxlength: 100,
                minlength: 2,
            },
            street_addr: {
                required :true,
                maxlength: 100,
                minlength: 2
            },
            zipcode: {
                required :true,
                maxlength: 6,
                minlength: 6,
                number:true
            }
        },
        // Specify the validation error messages
        messages: {
            street_addr: {
                required: "Enter street address."
            },
            zipcode: {
                maxlength: "Enter valid zipcode.",
                minlength: "Enter valid zipcode.",
                number:"Enter valid zipcode"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function(label, element){
            
        },
        submitHandler: function (form) {
            // Not required.
        }
    });
    
    
    $("#form_realestate_step2").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            residence_type: {
                required :true,
                maxlength: 100,
                minlength: 1
            },
            property_name: {
                required :true,
                maxlength: 100,
                minlength: 2,
                alphanumeric:true
            },
            property_amt: {
                required :true,
                maxlength: 11,
                minlength: 1,
                number:true
            }
        },
        // Specify the validation error messages
        messages: {
            residence_type: {
                required: "Select Type."
            },
            property_name: {
                required: "Enter name."
            },
            property_amt: {
                required: "Enter amount."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function(label, element){
            
        },
        submitHandler: function (form) {
            // Not required.
        }
    });
}


function validate_cashdebts_form()
{
    $("#form_cashdebt_step1").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            property_type: {
                required :true,
                maxlength: 100,
                minlength: 1
            }
        },
        // Specify the validation error messages
        messages: {
            property_type: {
                required: "Please select."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function(label, element){
            
        },
        submitHandler: function (form) {
            // Not required.
        }
    });
    
    
    $("#form_cashdebt_step2").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            property_name: {
                required :true,
                maxlength: 100,
                minlength: 1,
                alphanumeric:true
            },
            property_amt: {
                required :true,
                maxlength: 11,
                minlength: 1,
                number:true
            }
        },
        // Specify the validation error messages
        messages: {
            property_name: {
                required: "Enter name."
            },
            property_amt: {
                required: "Enter amount."
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        success: function(label, element){
            
        },
        submitHandler: function (form) {
            // Not required.
        }
    });
    
}


