<!-- =============Markup of Model for Login section  ==================== -->
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r">
                        <h3 class="m-t-none m-b">Sign in</h3>
                        <p>
                            Sign in today for more experience.
                        </p>
                        <?php
                        echo form_open('login', array('role' => "form", 'method' => 'post', 'name' => 'user_login', 'id' => 'user_login'));
                        ?>
                        <div class="form-group">
                            <?php
                            echo form_label('Email', 'user_login_email');
                            $email = (isset($remember)) ? $remember['email'] : '';
                            $data = array(
                                'name' => 'user_login_email',
                                'id' => 'user_login_email',
                                'placeholder' => 'Email Address/Login id',
                                'class' => 'form-control',
                                'value' => set_value('user_login_email', $email),
                                'autocomplete' => 'off'
                            );
                            echo form_input($data);
                            echo form_error('user_login_email');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo form_label('Password', 'login_password');
                            $pwd = (isset($remember)) ? $remember['password'] : '';
                            $data = array(
                                'name' => 'login_password',
                                'id' => 'login_password',
                                'placeholder' => 'Password',
                                'class' => 'form-control',
                                //'value' => set_value('login_password', $pwd),
                                'autocomplete' => 'off'
                            );
                            echo form_password($data);
                            echo form_error('login_password');
                            ?>
                        </div>
                        <div>

                            <button type="submit" token="<?php echo encode('login'); ?>" class="btn btn-sm btn-primary pull-right m-t-n-xs" name="submit_login" id="submit_login">Log in</button> 

                            <label>
                                <input type="checkbox" class="i-checks" name="remember" id="remember" value="1" <?php if (isset($remember)) { ?>checked="" <?php } ?>>
                                Remember me </label>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <h4>Not a member?</h4>
                            <p>
                                You can create an account:
                            </p>
                            <p class="text-center">
                                <a href="<?php echo base_url(); ?>signup"><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                        <div class="reset-password">
                            <h4><a  data-toggle="modal" href="#myModal-forget" onclick="javascript:showForgetPassword();"  data-dismiss="modal" >Forgot Password</a></h4>

                        </div>
                        <div class="investment-account">
                            <h4><a href="<?php echo base_url(); ?>signup">Open Investment Account</a></h4>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
