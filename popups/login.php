<script>  
   var email = '';
   var pwd = '';
   jQuery(document).ready(function(){ 
   jQuery.ajax({
  method: "POST",
  url: siteurl+"webservice/get_token",
  data: { str_name: "login" }
})
  .done(function( msg ) {
    jQuery(".token").attr('token',msg);
  });
  
  //get cookie
  jQuery.ajax({
  method: "POST",
  url: siteurl+"webservice/get_cookie",
  data: { flag: '1' }
})
  .done(function( msg ) {      
    var obj = jQuery.parseJSON( msg );
    var email = obj.email;
    email = jQuery.trim(email);
    var pwd = obj.password;
    pwd = jQuery.trim(pwd);
    if(email != '' && pwd != '')
    {
        //jQuery("#user_login_email").val(email);
        //jQuery("#login_password").val(pwd);
        //jQuery("#remember").attr('checked', true);
    }
  });
 });
 </script>
<!-- =============Markup of Model for Login section  ==================== -->
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b">Sign in</h3>

                        <p>
                            Sign in today for more expirience.
                        </p>

                        <form id="user_login" name="user_login" method="post" role="form" action="account/login" autocomplete="off">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="Email Address/Login id" class="form-control" id="user_login_email" name="user_login_email" >
                                
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" placeholder="Password" class="form-control" name="login_password" id="login_password">
                                
                            </div>
                            <div>                                
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs token" type="submit" name="submit_login">
                                    <strong>Log in</strong>
                                </button>
                                <label>
                                    <input type="checkbox" class="i-checks" name="remember" id="remember" value="1">
                                    Remember me </label>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <h4>Not a member?</h4>
                            <p>
                                You can create an account:
                            </p>
                            <p class="text-center">
                                <a href="<?php echo BASE_URL; ?>signup"><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                        <div class="reset-password">
                            <h4><a  data-toggle="modal" href="#myModal-forget"  data-dismiss="modal" >Forgot Password</a></h4>

                        </div>
                        <div class="investment-account">
                            <h4><a href="<?php echo BASE_URL; ?>signup">Open Investment Account</a></h4>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
