<script> 
   jQuery(document).ready(function(){ 
   jQuery.ajax({
  method: "POST",
  url: siteurl+"webservice/get_token",
  data: { str_name: "forgetpassword" }
})
  .done(function( msg ) {
    jQuery(".forgettoken").attr('token',msg);
  }); 

 });
 </script>
<!-- =============Markup of Model for Forget Password Section  ==================== -->
<div class="modal inmodal" id="myModal-forget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">

            <div class="modal-body">
                <form accept-charset="utf-8" id="forget_password_form" name="forget_password_form" method="post" role="form" action="account/login/forget_password" novalidate="novalidate">
                <div class="form-group">
                    <label>Password Recover </label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="Enter Email Address to recover Password" id="forget_user_email" value="" name="forget_user_email">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary  m-b forgettoken" id="submit_forget_password" name="submit_forget_password" token="" data-toggle="modal" href="#myModal-otp"  data-dismiss="model">
                        Submit
                    </button>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <a   class="btn btn-primary" data-dismiss="modal" data-toggle="modal" href="#modal-form">
                    Click to Login
                </a>

            </div>
        </div>
    </div>
</div>