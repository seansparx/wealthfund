
$(document).ready(function () {
    
    $(".banklist #refresh").bind('click', function() {
        
        var acc_id = $(this).parent('td').parent('tr').attr('id');
        var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
        $(this).parent('td').html(spinner);
        $.post(site_url('bankaccounts/refresh'),{"acc_id" : acc_id, "token" : site_token()}, function(resp) {
            if(resp){
                window.location.reload();
            }
        });
        
    });
    
    $(".banklist #remove").bind('click', function() {
        
        var item_id = $(this).parent('td').parent('tr').attr('id');
        
        if(confirm("Are you sure want to unlink ?")) {            
            var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
            $(this).parent('td').html(spinner);
            
            $.post(site_url('bankaccounts/remove'),{"item_id" : item_id, "token" : site_token()}, function(resp) {
                if(resp){
                    window.location.reload();
                }
            });
        }
        
    });
    
});