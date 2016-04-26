var ajax_req;
var oTable;
var availableDesc;
var canvas = document.getElementById("doughnutChart");
var ctx = canvas.getContext("2d");
var DoughnutChart;
var have_spent;

function refresh_doughnut(acc_id) 
{
    var duration = $("#graph-acc_during").val();
    
    if (DoughnutChart != null) {
        DoughnutChart.destroy();
    }
    
    $.getJSON(site_url('transactions/graph_data'), {"action": 'spending', "acc_id": acc_id, "duration": duration, "token": site_token()}, function (result) {
        if (result.success) {
            $("#no_transaction").hide();
            $("#doughnutChart").show();
            var doughnutOptions = {
                segmentShowStroke: true, segmentStrokeColor: "#fff", segmentStrokeWidth: 2, percentageInnerCutout: 70, // This is 0 for Pie charts
                animationSteps: 100, animationEasing: "easeOutBounce", animateRotate: true, animateScale: false
            };
            DoughnutChart = new Chart(ctx).Doughnut(result.graph_data, doughnutOptions);
        } 
        else {
            $("#doughnutChart").hide();
            $("#no_transaction").show();
            ctx.font = "15px bold";
            ctx.fillText(result.message, 50, 150);
        }
    });
}


/** 
 * Calculate percentage & move progress bar of budget amount.
 * 
 * @param {double} valueSpent
 * @param {int} nexvalue
 */
function move_progress_bar(element, hv_spent, amount) 
{
    var percentage = ((hv_spent * 100) / amount);
    var bg_color = '#1ab394'; //green.
    
    if(percentage >= 75){
        bg_color = '#f8ac59'; //orange.
    }
    
    if(percentage >= 99.99){
        bg_color = '#f15c5e'; //red.
    }
    
    $(element).find('.progress-bar-default').css({"border-color":bg_color});
    $(element).find('.progress-bar').css({"width":percentage+"%", "background-color":bg_color});
}


/** 
 * Calculate spend percentage of budget amount.
 */
function refresh_doughnut_by_duration(duration) 
{
    var acc_id = $("#graph-acc_filter").val();
    
    if (DoughnutChart != null) {
        DoughnutChart.destroy();
    }
    
    $.getJSON(site_url('transactions/graph_data'), {
        "action": 'spending', "acc_id": acc_id, "duration": duration, "token": site_token()
    }, function (result) {
        if (result.success) {
            var doughnutOptions = {
                segmentShowStroke: true, segmentStrokeColor: "#fff", segmentStrokeWidth: 2, percentageInnerCutout: 70, // This is 0 for Pie charts
                animationSteps: 100, animationEasing: "easeOutBounce", animateRotate: true, animateScale: false
            };
            DoughnutChart = new Chart(ctx).Doughnut(result.graph_data, doughnutOptions);
        } else {
            ctx.font = "15px bold";
            ctx.fillText(result.message, 50, 150);
        }
    });
}

    
$(document).ready(function () {
    
    refresh_doughnut();
    
    init_buttons();
    
    init_datepicker();


    $('#graph-acc_filter').change(function () {
        var acc_id = $(this).val();
        refresh_doughnut(acc_id);
    });
    
    
    $('#graph-acc_during').change(function () {
        var duration = $(this).val();
        refresh_doughnut_by_duration(duration);
    });


    /** Edit detail Transaction Row */
    $("#edit-option .edit-btn").bind('click', function () {
        $(".edit-options-list").show();
        $("#edit-option .edit-btn").hide();
    });
    
    
    /** Cancel button Transaction row edit details */
    $(".edit-options-list #cancel").bind('click', function () {
        $(".edit-options-list").hide();
        $("#edit-option .edit-btn").show();
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
    
    
    /** Get auto suggeston data for add/edit transaction. */
    $.getJSON(base_url('transactions/get_descriptions'),{token:site_token()},function(data){
            availableDesc = data;            
            init_autocomplete();
    });
        
    oTable = $('#transactions').DataTable({
        initComplete: function () {
            filter_dropdowns(this);
        },
        sPlaceHolder: "head:before",
        bDestroy: true
    });
        
    $('#transactions_filter').hide();
    
    $("#transactions_length select").addClass('form-control');
    
    $('#search_box').keyup(function(){
            oTable.search($(this).val()).draw() ;
      });

    /** Click event on datatable rows.*/
    $('#transactions tbody').unbind('click').bind('click', 'tr', function () {
        var data = oTable.row( this ).data();
    } );
    
    /** Bind event on edit options .*/
    $('#transactions').unbind('click').bind('click', function () {
        init_edit_options();
    } );
    
    init_edit_options();
    
    default_edit_options();
    
    /** filter by account */
    $("#nav_accounts li").click(function () {
        var id = $(this).attr('id');
        var title = $(this).children('a').html();
        var li_index = $(this).index();
        
        if(li_index == 0){
            title = title+'<small><a onclick="javascript:launch();" href="javascript:void(0);">Add another ?</a></small>';
        }
        
        if (ajax_req) {
            ajax_req.abort();
        }

        ajax_req = $.post(base_url('transactions/filter'), {'id': id, 'action': 'by_account'}, function (resp) {
            
                var resp = $.parseJSON(resp);
                
                /** Refresh datatable */
                refresh_transaction_table(resp);
                
                /** Change top labels */
                $(".account-search h2").html(title);
                change_top_labels(resp);
        });
    });

});


/**
 * Bind all buttons on transaction page.
 * */
function init_buttons()
{
    $("#adtxn").unbind('click').bind('click',function() {
        $("#edit-option").hide();
        $("#add-transaction").show();
        
        var tableOffset = $('.table-responsive').offset().top;
        $('html, body').animate({
                scrollTop : tableOffset
        }, 1000);
    });
    
    
    $(".edit-elements #cancel").unbind('click').bind('click',function() {
        $("#edit-option").show();
        $("#add-transaction").hide();
    });
    
    
    $(".edit-elements #t_entry_type").unbind('change').bind('change',function() {
        
        var tp = $(this).val();
        
        if(tp == 'cheque'){
            $("#t_account_row").show();
            $("#t_cheque_no").show();
        }
        else if(tp == 'pending'){
            $("#t_account_row").show();
            $("#t_cheque_no").hide();
        }
        else{
            $("#t_account_row").hide();
        }
        
    });
    
    
    $("#form_add_transaction #done").unbind('click').bind('click',function() {
        
        $(".edit-option input, .edit-option select").removeClass('error');
        
        $(".edit-elements #done").attr('disabled', true);
        
        var param = $("#form_add_transaction").serialize()+'&token='+site_token();
        
        $.post(base_url('transactions/add_entry'), param, function(result) {
            
            $(".edit-elements #done").attr('disabled', false);

            result = $.parseJSON(result);
            
            if(result.success) {
                $('#form_add_transaction')[0].reset();				
                $("#add-transaction").hide();
                document.location.reload();                
            }
            else {
                $("#"+result.message).addClass('error');
                $("#"+result.message).focus();
            }

        });
    });
}


/**
 * Set default values of edit option.
 * */
function default_edit_options()
{
    var elm_tr = $('#transactions tbody tr:first');

    var tid = $(elm_tr).children('td').eq(0).children('input[name="tid"]').val();
    $(".edit-option #edit_id").val(tid);

    var a = $(elm_tr).children('td').eq(1).text();
    $(".edit-option #edit_date").val(a);

    var b = $(elm_tr).children('td').eq(2).text();
    $(".edit-option #edit_description").val(b);

    var c = $(elm_tr).children('td').eq(0).children('input[name="cat_id"]').val();
    
    $(".edit-option #edit_category").val(c);
    
    var d = $(elm_tr).children('td').eq(4).text();
    $(".edit-option #edit_amount").val(d);
    
    $.getJSON(base_url('transactions/get_entry'), {"t_id":tid,"token":site_token()}, function(result) { 
        //result.tags;
        $("#form_edit_transaction #t_date").html('You entered this '+result.category_name+' on <strong>'+date("M d", strtotime(result.post_date))+'</strong>');
        $("#form_edit_transaction #t_notes").val(result.notes);
    });
}


/**
 * Bind change event on edit options.
 * */
function init_edit_options()
{
    /** Mark selected datatable row.*/
    $('#transactions tbody tr').unbind('click').bind( 'click', function () {
        
        var position = $(this).offset();
        var t_pos = $("#transactions").offset(); 
        var top = (position.top - t_pos.top) + 40;
        
        $('#edit-option').css({'top':top});
        
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            
            var tid = $(this).children('td').eq(0).children('input[name="tid"]').val();
            $(".edit-option #edit_id").val(tid);
                        
            var a = $(this).children('td').eq(1).text();
            $(".edit-option #edit_date").val(a);

            var b = $(this).children('td').eq(2).text();
            $(".edit-option #edit_description").val(b);

            var c = $(this).children('td').eq(0).children('input[name="cat_id"]').val();
            $(".edit-option #edit_category").val(c);

            var d = $(this).children('td').eq(4).text();
            $(".edit-option #edit_amount").val(d);
            
            $.getJSON(base_url('transactions/get_entry'), {"t_id":tid,"token":site_token()}, function(result) { 
                //result.tags;
                $("#form_edit_transaction #t_date").html('You entered this '+result.category_name+' on <strong>'+date("M d", strtotime(result.post_date))+'</strong>');
                $("#form_edit_transaction #t_notes").val(result.notes);
            });
        }
    } );
    
    
    /** change event on datatable edit option.*/
    $('.edit-option #edit_description, .edit-option #edit_date, .edit-option #edit_category').unbind('change').bind('change', function () 
    {
        if(confirm('Do you want to save changes ?')) {
            var tid = $(".edit-option #edit_id").val();
            var tbl_tr = $("tr#row_"+tid);

            var a = $(".edit-option #edit_date").val();
            var b = $(".edit-option #edit_description").val();
            var c = $(".edit-option #edit_category").val();
            var d = $(".edit-option #edit_category option:selected").html();
            
            tbl_tr.children('td').eq(0).children('input[name="cat_id"]').val(c);
            tbl_tr.children('td').eq(1).html(a);                    
            tbl_tr.children('td').eq(2).html(b);                    
            tbl_tr.children('td').eq(3).html(d);
            
            if(ajax_req){ ajax_req.abort(); }

            var param = $("#form_edit_transaction").serialize()+'&token='+site_token();
            ajax_req = $.post(base_url('transactions/update_entry'), param, function(result){
                    if(result){
                        document.location.reload();
                    }
            });
        }
    } );

}


/** 
 * Change label above datatable.
 * 
 * @param json
 * 
 * @return void
 */
function change_top_labels(resp)
{    
    var head = '<tr><td>Total Cash</td><td>Total Debt</td></tr>'; 
    var foot = '<tr><th>'+resp.currency+''+resp.balance_amt+'</th><th>'+resp.currency+'0.00</th></tr>';
    
    switch(resp.site_container){
        
        case 'credits'  :   head = '<tr><td>Balance</td><td>Available Credit</td><td>Total Credit</td><td>APR</td><td>Total Fees</td></tr>'; 
                            foot = '<tr><th>'+resp.currency+''+resp.balance_amt+'</th><th>'+resp.currency+''+resp.available_credit+'</th><th>'+resp.currency+''+resp.total_credit+'</th><th>0.00%</th><th>'+resp.currency+'0.00</th></tr>';
                            break;
        
        case 'stocks'   :           
        case 'credits'  :           
        case 'bank'     :   head = '<tr><td>Balance</td><td>Total Fees</td></tr>'; 
                            foot = '<tr><th>'+resp.currency+''+resp.balance_amt+'</th><th>'+resp.currency+'0.00</th></tr>';
                            break;
    }
    
    $(".trasaction-details .fee thead").html(head);
    $(".trasaction-details .fee tfoot").html(foot);
}



/** Initialize datatable filters
  */
function filter_dropdowns(elem)
{
    elem.api().columns().every(function () {
        var column = this;

        if((column.index() == 0) || column.index() == 4) { return; }

        var select = $('<select class="form-control"><option value=""> -- Filter by -- </option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                    default_edit_options(); // place value edit option.
                });

        column.data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
        });
    });
}


/** 
 * Refresh transaction datatable.
 * 
 * @param json
 * 
 * @return void
 */
function refresh_transaction_table(records)
{                
    $('#search_box').val('');

    oTable = $('#transactions').DataTable({
        initComplete: function () {
            filter_dropdowns(this);
        },
        sPlaceHolder: "head:before",
        bDestroy: true
    });
    
    oTable.clear().draw();
    
    $("#transactions_length select").addClass('form-control');

    if (records.transaction) {
        $.each(records.transaction, function (k, v) {
            oTable.row.add([
                '<input type="checkbox" value=""><input type="hidden" readonly="readonly" name="tid" value="'+v.id+'"/><input type="hidden" readonly="readonly" id="cat_type" name="cat_type" value="'+v.category_type_id+'"/>',
                date('d/M/Y',strtotime(v.post_date)),
                v.description,
                v.category_name,
                currency_symbol()+''+v.amount
            ]).draw();
        });
    }
    
    if(records.transaction.length > 0) {
        $('.edit-option').show();
        default_edit_options();
        //init_edit_options();
    }
    else{
        $('.edit-option').hide();
    }
    
    
    $('#transactions_filter').hide();
        
    $('#search_box').keyup(function(){
            oTable.search($(this).val()).draw() ;
      });
      
      $("#add-transaction").hide();
}


/** 
 * datepicker for add edit popup
 * --------------------------------- */
function init_datepicker()
{
    $('#edit_date, #t_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/M/yyyy",
        maxDate:'0'
    });
}


/** 
 * Bind autocomplete for add edit popup
 * -----------------------------------*/
function init_autocomplete()
{
    $( "#form_edit_transaction .edit_desc, #add-transaction .t_desc" ).autocomplete({
        minLength: 2,
        source: availableDesc
    });
}




/** Start Budget Section .
 * ----------------------------------*/

$(document).ready(function () {

    /** Bind event on create budget.*/
    $('#create-budget #btn_save').bind('click', function() {
        if($("#form_create_budget").valid()) {
            $('#create-budget #btn_save').attr('disabled', true);            
            var param = $("#form_create_budget").serialize()+'&token='+site_token();            
            $.post(base_url('transactions/create_budget'), param, function(response){

                $('#create-budget #btn_save').attr('disabled', false);

                if(response == 1) {
                    refresh_budget_progress_bar();
                    $("#create-budget").modal('hide');
                    $("#budget-success").modal('show');
                    
                    $('#form_create_budget')[0].reset();
                    //document.location.reload();
                    
                }
                else{
                    alert(response);
                }
            });
        }
    });
    
    
    /** Bind event on update budget.*/
    $('#edit-budget #btn_save').bind('click', function() {
        var amt = $("#form_edit_budget #b_amount").val();
        if(amt < have_spent) {
            alert("You cannot set your budget less than of your spendings, you have spent "+currency_symbol()+number_format(have_spent)+" this month.");
        }
        else if($("#form_edit_budget").valid()) {
            
            $('#edit-budget #btn_save').attr('disabled', true);
            var param = $("#form_edit_budget").serialize()+'&token='+site_token();            
            
            $.post(base_url('transactions/create_budget'), param, function(response){

                $('#edit-budget #btn_save').attr('disabled', false);

                if(response == 1) {
                    refresh_budget_progress_bar();
                    $("#edit-budget").modal('hide');                    
                    $('#form_edit_budget')[0].reset();                    
                }
                else{
                    alert(response);
                }
            });
        }
    });
    
    
    /** button create budget .*/
    $('#btn_create_budget').bind('click', function () {
        $("#create-budget .modal-title").text('Create a Budget');
        $("#create-budget").modal('show');
    } );
        
    
    init_edit_budget();   
    
    init_del_budget();   
    
    init_budget_count();   
    
    validate_createbudget_form();
});

    

function validate_createbudget_form()
{
    $("#form_create_budget, #form_edit_budget").validate({
        // Specify the validation rules
        "onkeyup":true,
        rules: {
            b_category: {
                required :true
            },
            b_amount: {
                required :true,
                max: 99999999999,
                min: 1,
                number:true
            }
        },
        // Specify the validation error messages
        messages: {
            b_category: {
                required: "Select category."
            },
            b_amount: {
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


/** 
 * Bind budget counter 
 * */
function init_budget_count()
{
    /** decrease budget counter .*/
    $('.pre-count').unbind('click').bind('click', function () {
        var elment = $(this);
        if(ajax_req){ ajax_req.abort(); }
        
        var valueSpent = parseFloat(elment.siblings('input').val());
        var valuePre   = parseInt(elment.siblings('span').text());
        var nexvalue   = --valuePre;

        if(nexvalue < valueSpent){ return false; }

        elment.siblings('span').text(nexvalue);
        var b_div = elment.parent().parent();
        var budget_id = b_div.attr('id');

        ajax_req = $.post(base_url('transactions/update_budget'), {"budget_id" : budget_id, "amount" : nexvalue, "token" : site_token()}, function(response){
            var b_limit = currency_symbol()+' '+number_format(nexvalue, 2);
            elment.parent().parent().children('span').eq(1).children('strong').eq(1).html(b_limit);
            move_progress_bar(b_div, valueSpent, nexvalue);
        });
    }); 

    /** increase budget counter .*/
    $('.next-count').unbind('click').bind('click', function () {
        var elment = $(this);
        if(ajax_req){ ajax_req.abort(); }

        var valueSpent = parseFloat(elment.siblings('input').val());
        var valuePre   = parseInt(elment.siblings('span').text());
        var nexvalue   = ++valuePre;

        if(nexvalue < 0){ return false; }
                
        elment.siblings('span').text(nexvalue);
        var b_div = elment.parent().parent();
        var budget_id = b_div.attr('id');

        ajax_req = $.post(base_url('transactions/update_budget'), {"budget_id" : budget_id, "amount" : nexvalue, "token" : site_token()}, function(response){
            console.log(response);
            var b_limit = currency_symbol()+' '+number_format(nexvalue, 2);
            elment.parent().parent().children('span').eq(1).children('strong').eq(1).html(b_limit);
            move_progress_bar(b_div, valueSpent, nexvalue);
        });
    });
}
    
    
/** 
 * Bind event on delete budget button.
 * */
function init_del_budget() 
{
    $('.del_budget').unbind('click').bind('click', function (){

        if(ajax_req){ ajax_req.abort(); }

        var budget_id = $(this).parent().attr('id');
        if(confirm("Are you sure want to delete budget?")){
            ajax_req = $.getJSON(base_url('transactions/del_budget'), {"budget_id":budget_id, "token" : site_token()}, function(response) {
                            if(response){
                                refresh_budget_progress_bar();
                            }
                        });
        }

    });
}
    
/** 
 * Bind event on edit budget .
 * */
function init_edit_budget() {
    $('.edit_budget').unbind('click').bind('click', function () {

        if(ajax_req){ ajax_req.abort(); }

        var budget_id = $(this).parent().attr('id');
        have_spent  = $(this).parent().find('.hv-spent').val();

        $("#edit-budget .modal-title").text('Edit Your Budget');
        $("#edit-budget").modal('show');
        
        ajax_req = $.getJSON(base_url('transactions/get_budget'), {"budget_id":budget_id, "token" : site_token()}, function(response) {
                        $("#form_edit_budget #b_category").val(response.category_id);
                        $("#form_edit_budget #b_amount").val(response.amount);
                    });

    } );
}
    
/** 
 * Refresh budget progress bars.
 * 
 * @return void
 */
function refresh_budget_progress_bar()
{
    $.get(base_url('transactions/refresh_budget'), {"token" : site_token()}, function(response) {
        $("div#budget_bars").html(response);
        init_edit_budget();       
        init_del_budget();   
        init_budget_count();
    });
}