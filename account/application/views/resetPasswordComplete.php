
<section class="signup-complete-msg">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 text-center">
                <span class="resend-msg">
                <?php
                if ($this->session->flashdata('success') != "") {
                    echo "<h3 style='color: green;'>" . $this->session->flashdata('success') . "</h3>";
                }
                ?>
                </span>
                <lable class="redirect-msg">
                <!--<br/>-->                
                Password has been sent to email address you provided, please check your inbox/junk folder.                
                </label>
                <br>
                <br>
                
            </div>
        </div>
    </div>

</section>

<script>
/*$(document).ready(function(){
    $(".redirect-msg").html('Redirecting to home page within 5 Seconds.');
    setTimeout(function(){
        window.location.replace('<?php echo site_url('../'); ?>');
    },5000);
});*/
$(document).ready(function(){
  var email = '<?php echo $email; ?>';
  var resendmsg = "<h3 style='color: green;'>Your Password has been resend successfully...</h3>";
  var errmsg = "Invalid Emailid";
  jQuery(".resend").click(function(){      
      if(email != '')
      {
        jQuery.ajax({
        method: "POST",
        url: site_url("login/resend_password"),
        data: { user_email: email }
        })
        .done(function( msg ) {           
            if(msg == 1)
            {
                jQuery(".resend-msg").html(errmsg);
            }else if(msg == 2)
            {
                jQuery(".resend-msg").html(resendmsg);
            }
        });
      }      
  })

});
</script>
