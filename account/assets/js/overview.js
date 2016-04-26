var investment_type;
var insurance_type;
var property_type;
var vehicle_type;
var vehicle_param2;
var vehicle_param3;
var realestate_param;
var cash_param;
var validator_insurance;

$(function(){

    /** Delete linked accounts */
    $("#side-menu .remove-list").bind('click', function () {

        var element = $(this);
        var item_id = element.attr('id');

        if (confirm("Are you sure want to unlink ?")) {
            
            //var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
            //$(this).parent('td').html(spinner);

            $.post(site_url('bankaccounts/remove'), {"item_id": item_id, "token": site_token()}, function (resp) {
                if (resp) {
                    element.parent().fadeOut();
                }
            });
        }

    });


    /** Refresh all linked accounts */
    $(".account-details #refresh").bind('click', function () {

        var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
        $(this).html(spinner);
        $.post(site_url('overview/refresh'), {"token": site_token()}, function (resp) {
            if (resp) {
                window.location.reload();
            }
        });

    });
    
    
    /** Add GOLD ( Investments ) */
    $("#myModal-gold #btn_add").click(function() {
        
        investment_type = 'Gold';
        
        if($("#form_add_gold").valid()) {
            $("#myModal-gold #btn_add").attr('disabled', true);            
            var param = $("#form_add_gold").serialize()+'&investment_type='+investment_type+'&token='+site_token();            
            $.post(base_url('overview/add_gold'), param, function(response){

                $("#myModal-gold #btn_add").attr('disabled', false);

                if(response == 1) {
                    $("#myModal-success .modal-title").text('Success ! We got your '+toTitleCase(investment_type));
                    $("#myModal-gold").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_add_gold')[0].reset();
                    //document.location.reload();
                }
            });
        }
    });
    
    
    /** Add Fixed Deposite ( Investments ) */
    $("#model-fd #btn_add").click(function() {
        
        investment_type = 'Fixed Deposit';
        
        if($("#form_add_fd").valid()) {
            $("#model-fd #btn_add").attr('disabled', true);            
            var param = $("#form_add_fd").serialize()+'&investment_type='+investment_type+'&token='+site_token();            
            $.post(base_url('overview/add_fd'), param, function(response){

                $("#model-fd #btn_add").attr('disabled', false);

                if(response == 1) {
                    $("#myModal-success .modal-title").text('Success ! We got your '+toTitleCase(investment_type));
                    $("#model-fd").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_add_fd')[0].reset();
                    //document.location.reload();
                }
            });
        }
    });
    

    /** Life Insurance */
    $(".account-details #life_insurance").click(function(e) {
    	
    	// + icon code
    	if(e.target.tagName == 'I'){
    		insurance_type = 'Life Insurance';
                $("#model-insurance .modal-title").text('Edit the details of your '+toTitleCase(insurance_type));
                validator_insurance.resetForm();
                $("#model-insurance").modal('show');
    		e.stopPropagation();
    		e.preventDefault();
    	}
    });
    
    /** Health Insurance */
    $(".account-details #health_insurance").click(function(e) {    	
    	// + icon code
    	if(e.target.tagName == 'I'){
            insurance_type = 'Health Insurance';
            $("#model-insurance .modal-title").text('Edit the details of your '+toTitleCase(insurance_type));
            validator_insurance.resetForm();
            $("#model-insurance").modal('show');
            e.stopPropagation();
            e.preventDefault();
    	}
    });
    
    /** Long-Term Disability Coverage */
    $(".account-details #disable_coverage").click(function(e) {
    	
    	// + icon code
    	if(e.target.tagName == 'I'){
            insurance_type = 'Long-Term Disability Coverage';
            $("#model-insurance .modal-title").text('Edit the details of your '+toTitleCase(insurance_type));
            validator_insurance.resetForm();
            $("#model-insurance").modal('show');
            e.stopPropagation();
            e.preventDefault();
    	}
    });
    
    /** Auto Insurance */
    $(".account-details #auto_insurance").click(function(e) {
    	// + icon code
    	if(e.target.tagName == 'I'){
            insurance_type = 'Auto Insurance';
            $("#model-insurance .modal-title").text('Edit the details of your '+toTitleCase(insurance_type));
            validator_insurance.resetForm();
            $("#model-insurance").modal('show');
            e.stopPropagation();
            e.preventDefault();
    	}
    });
    
    
    /** Gold */
    $(".account-details #gold").click(function(e) {
    	// + icon code
    	if(e.target.tagName == 'I'){
            $("#myModal-gold").modal('show');
            e.stopPropagation();
            e.preventDefault();
    	}
    });
    
    
    /** FD */
    $(".account-details #fd").click(function(e) {
    	// + icon code
    	if(e.target.tagName == 'I'){
            $("#model-fd").modal('show');
            e.stopPropagation();
            e.preventDefault();
    	}
    });
    
    
    
    /** Add Insurance ( Investments ) */
    $("#model-insurance #btn_add").click(function() {
        
        if($("#form_add_insurance").valid()) {

            $("#model-insurance #btn_add").attr('disabled', true);            
            var param = $("#form_add_insurance").serialize()+'&insurance_type='+insurance_type+'&token='+site_token();            
            $.post(base_url('overview/add_insurance'), param, function(response){

                $("#model-insurance #btn_add").attr('disabled', false);

                if(response == 1) {
                    $("#myModal-success .modal-title").text('Success ! We got your '+toTitleCase(insurance_type));
                    $("#model-insurance").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_add_insurance')[0].reset();
                    //document.location.reload();
                }
            });
        }
    });
    
    
    /** Configure More Other Property step 1 */
    $("#myModal-otherinfo #btn_next").click(function() {
        if($("#form_other_property_step-1").valid()) {
            property_type = 'Others';
            var property_name = $("#myModal-otherinfo #form_other_property_step-1 #property_type").val();
            $("#myModal-othervalue .modal-title").text('Edit the details of your '+toTitleCase(property_name));
            $("#myModal-othervalue #form_other_property_step-2 #property_name").val(toTitleCase(property_name));
            $("#myModal-otherinfo").modal('hide');
            $("#myModal-othervalue").modal('show');
        }
    });
    
    
    /** Configure More Other Property step 2 */
    $("#myModal-othervalue #btn_add").click(function() {
        
        if($("#form_other_property_step-2").valid()) {
            
            $("#myModal-othervalue #btn_add").attr('disabled', true);
            
            var param = $("#form_other_property_step-2").serialize()+'&property_type='+property_type+'&token='+site_token();
            
            $.post(base_url('overview/configure_more'), param, function(response){

                $("#myModal-othervalue #btn_add").attr('disabled', false);

                if(response == 1) {
                    $("#myModal-othervalue").modal('hide');
                    $("#myModal-success").modal('show');
                    $('#form_other_property_step-1')[0].reset();
                    $('#form_other_property_step-2')[0].reset();
                }
            });
        }
    });
    
    
    /** Configure More Vehicle step 1 */
    $("#myModal-vahicle #btn_next").click(function() {
        property_type = 'Vehicle';
        vehicle_type = $("#form_vehicle_step1 #vehicle_type").val();
        $("#myModal-edit-carvalue .modal-title").text('Edit the details of your '+toTitleCase(vehicle_type));
        $("#myModal-edit-carvalue #form_vehicle_step3 #property_name").val(toTitleCase(vehicle_type));
        $("#myModal-vahicle").modal('hide');        
        $("#myModal-edit-carvalue").modal('show');
    });
        
    
    /** Configure More Vehicle step 3 */
    $("#myModal-edit-carvalue #btn_add").click(function() {
        
            if($("#form_vehicle_step3").valid()){
                    $("#myModal-edit-carvalue #btn_add").attr('disabled', true);        
                    vehicle_param2 = $("#form_vehicle_step1").serialize();        
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
    
    validate_other_property_form();
    
    validate_insurance_form();
    
    validate_fd_form();
    
    validate_gold_form();
    
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



function validate_other_property_form()
{
    $("#form_other_property_step-1").validate({
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
    
    
    $("#form_other_property_step-2").validate({
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


function validate_insurance_form()
{
    validator_insurance = $("#form_add_insurance").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            policy_name: {
                required :true,
                maxlength: 100,
                minlength: 2
            },
            monthly_amt: {
                required :true,
                max: 99999999999,
                min: 1,
                number:true
            },
            coverage_amt: {
                required :true,
                max: 99999999999,
                min: 1,
                number:true
            },
            no_of_yrs: {
                required :true,
                maxlength: 3,
                minlength: 1
            }
        },
        // Specify the validation error messages
        messages: {
            policy_name: {
                required: "Enter policy name."
            },
            monthly_amt: {
                required: "Enter amount."
            },
            coverage_amt: {
                required: "Enter amount."
            },
            no_of_yrs: {
                required: "Enter no of years."
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


function validate_fd_form()
{
    $("#form_add_fd").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            bank_name: {
                required :true
            },
            fd_amount: {
                required :true,
                max: 99999999999,
                min: 1,
                number:true
            },
            mt_period: {
                required :true
            }
        },
        // Specify the validation error messages
        messages: {
            bank_name: {
                required: "Select a bank."
            },
            fd_amount: {
                required: "Enter amount."
            },
            mt_period: {
                required: "Select maturity period."
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


function validate_gold_form()
{
    $("#form_add_gold").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            gold_name: {
                required :true,
                minlength:2,
                maxlength:50
            },
            gold_amt: {
                required :true,
                max: 99999999999,
                min: 1,
                number:true
            }
        },
        // Specify the validation error messages
        messages: {
            gold_name: {
                required: "Enter name."
            },
            gold_amt: {
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