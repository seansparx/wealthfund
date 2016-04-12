var ajax_req;

// When the browser is ready...
$(document).ready(function(){
            
    load_popular_banks();    
    init_searchbox();
    
    $("#form_link_account button").click(function(){
        
        $("#form_link_account button").attr('disabled', true);
        $("#form_link_account button").html('Please Wait..');
        
        var token = $("#site_token").val();
        var param = $("#form_link_account").serialize()+'&token='+token;
        $.post(site_url('dashboard/link_accounts'), param, function(msg){
            
            if(msg == true){
                $('#myModal_link_account').modal('toggle');
                $("#myModal_account_linked").modal();
            }
            $("#form_link_account button").html('Submit');
            $("#form_link_account button").attr('disabled', false);
            

        });
    });
    
});

function init_searchbox()
{
    $("#form_site_search button").click(function(e){
        
        var keyword = $("#form_site_search #search_keyword").val();
        
        if(keyword == ''){
            $("#search_keyword").focus();
            return;
        }
        
        $("#form_site_search button").attr('disabled', true);
        $("#form_site_search button").html('Searching..');

        var token = $("#site_token").val();
        var param = $("#form_site_search").serialize()+'&token='+token;

        $.post(site_url('dashboard/search_sites'), param, function(msg){
            if(msg == '415'){
                window.location.replace($("#site_url").val());
            }
            else if(msg != ''){
                $(".banking-list h2").html('Your results for "'+keyword+'"');
                $(".banking-list #banks_container").html(msg);

                $(".banking-list #banks_container ul a").each(function(){
                    $(this).click(function(){
                        var site_id = $(this).attr('id');
                        var site_title = $(this).attr('title');
                        $("#myModal_link_account #site_id").val(site_id);
                        $("#myModal_link_account .modal-title").html('Link your '+site_title+' account');
                        $("#myModal_link_account").modal();
                    });
                });
            }
            $("#form_site_search button").html('Search');
            $("#form_site_search button").attr('disabled', false);
        });

        return false;
    });
}


function base_url(path)
{
    return $("#base_url").val()+path+"/";
}

function site_url(path)
{
    return $("#site_url").val()+path+"/";
}


function load_popular_banks()
{
    var token = $("#site_token").val();
//    alert(token);
//    return;
    if(ajax_req) { ajax_req.abort(); }

    $('#pop_banks .loading').remove();
    $(".banking-list #pop_banks ul").html('<li><div class="loading">Loading Data..</div><li>');
    //$("#signup_otp_form #resend_otp").attr('disabled', true);

    var flag = false;

    ajax_req = $.post(site_url('dashboard/get_popular_banks'),{'token':token}, function(msg){

        if(msg == '415'){
            window.location.replace($("#site_url").val());
        }
        else if(msg != ''){
            $(".banking-list #pop_banks ul").html(msg);
            
            $(".banking-list #pop_banks ul img").each(function(){
                $(this).click(function(){
                    var site_id = $(this).attr('id');
                    var site_title = $(this).attr('title');
                    $("#myModal_link_account #site_id").val(site_id);
                    $("#myModal_link_account .modal-title").html('Link your '+site_title+' account');
                    $("#myModal_link_account").modal();
                });
            });
        }
        
        $('#pop_banks .loading').remove();
        
//        if(msg == 'sent'){
//            $("#signup_otp_form #submit_activation_code").after('<label class="resend-otp" style="color:green">Verification code has been sent</label>');
//        }
//        else{
//            $("#signup_otp_form #submit_activation_code").after('<label class="resend-otp error">'+msg+'</label>');
//        }
        //$("#signup_otp_form #resend_otp").html('Resend Activation Code');
        //$("#signup_otp_form #resend_otp").attr('disabled', false);
    });
}