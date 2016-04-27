function checkMenu(id, menu_type)
    {
        if (menu_type == 0) {
            if (document.getElementById("menuCheckB" + id).checked == true)
                checked = true
            else
                checked = false

            document.getElementById("menuCheckB" + id + "_add").checked = checked;
            document.getElementById("menuCheckB" + id + "_edit").checked = checked;
            document.getElementById("menuCheckB" + id + "_del").checked = checked;
        }
    }

    function checkAll(count, id, id1, menu_type)
    {
        if (document.getElementById("menuCheckA" + id1).checked == true)
            checked = true
        else
            checked = false

        if (menu_type == 0) {
            document.getElementById("menuCheck_" + id1 + "_add").checked = checked;
            document.getElementById("menuCheck_" + id1 + "_edit").checked = checked;
            document.getElementById("menuCheck_" + id1 + "_del").checked = checked;
        }

        for (var i = 0; i < count; i++)
        {
            document.getElementById("menuCheckB" + id).checked = checked;

            var ctr = 0;
            var field_name = '';
            var frm = document.frmUser;

            for (ctr = 0; ctr < frm.length; ctr++)
            {
                field_name = frm.elements[ctr].id;
                if ((field_name == "menuCheckB" + id + "_add") || (field_name == "menuCheckB" + id + "_edit") || (field_name == "menuCheckB" + id + "_del"))
                {
                    frm.elements[ctr].checked = checked;
                }
            }
            id++;
        }

    }

    function checkAllSingle(id1, menu_type)
    {
        if (menu_type == 0) {
            if (document.getElementById("menuCheck").checked == true)
                checked = true
            else
                checked = false

            document.getElementById("menuCheck_" + id1 + "_add").checked = checked;
            document.getElementById("menuCheck_" + id1 + "_edit").checked = checked;
            document.getElementById("menuCheck_" + id1 + "_del").checked = checked;
        }
    }
function validationLogin()
{
	if(document.getElementById('userName').value=="")
	{
		alert("Please enter username");
		document.getElementById('userName').focus();
		return false;
	}
		
	if(document.getElementById('userPassword').value=="")
	{
		alert("Please enter valid password");
		document.getElementById('userPassword').focus();
		return false;
	}
}

function currentTime(){
	var $el = $(".stats .fa-calendar").parent(),
	currentDate = new Date(),
	monthNames = [ "January", "February", "March", "April", "May", "June",
	"July", "August", "September", "October", "November", "December" ],
	dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

	$el.find(".details .big").html(monthNames[currentDate.getMonth()] + " " + currentDate.getDate() + ", " + currentDate.getFullYear());
	$el.find(".details span").last().html(dayNames[currentDate.getDay()] + ", " + currentDate.getHours()+":"+ ("0" + currentDate.getMinutes()).slice(-2));
	setTimeout(function(){
		currentTime();
	}, 10000);
}

$(document).ready(function(){
    
    currentTime();
    $('.single_chk').on('click',function(){
        var id = $(this).attr('id');
        var n = id.lastIndexOf('_');
        var target = id.substring(0,n);
        
//        $('[id^="'+target+'_"]').each(function() { 
//            console.log($(this).attr('id')); 
//                });
        
        if($('[id^="'+target+'_"]').is(':checked'))
        {
            $('#'+target).prop('checked', true);
        }
        else{
          $('#'+target).prop('checked', false);
        }
        
       // alert(target)
       
    });
    
    $('.form-control').on('change keyup',function(){
       
        var id=$(this).attr('id')
        if(id.length > '0')
        {
            $('#srvrerr_'+id).remove();
        }
        
    });
    
            $('.srvrerr').each(function() { 
            $(this).parent().parent("div.form-group").addClass('has-error'); 
                });
    
});

function isFloat(n) {
   if( n.match(/^-?\d*(\.\d+)?$/) && !isNaN(parseFloat(n)) && (n%1!=0) )
      return true;
   return false;
}
