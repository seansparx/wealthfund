<!-- =============Markup of Model for Forget Password Section  ==================== -->
<div class="modal inmodal" id="myModal-forget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">

            <div class="modal-body">
                <?php
                echo form_open('login/forget_password', array('role' => "form", 'method' => 'post', 'name' => 'forget_password_form', 'id' => 'forget_password_form'));
                ?>
                <div class="form-group">
                    <?php
                    echo form_label('Password Recover', 'password_recover');

                    $data = array(
                        'name' => 'forget_user_email',
                        'id' => 'forget_user_email',
                        'placeholder' => 'Enter Email Address to recover Password',
                        'class' => 'form-control',
                        'value' => set_value('forget_user_email'),
                        'autocomplete' => 'off'
                    );
                    echo form_input($data);
                    echo form_error('forget_user_email');
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary  m-b " id="submit_forget_password" name="submit_forget_password" token="<?php echo encode('forgetpassword'); ?>" data-toggle="modal" href="#myModal-otp"  data-dismiss="model">
                        Submit
                    </button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
            <div class="modal-footer">
                <a   class="btn btn-primary" data-dismiss="modal" onclick="javascript:loginModalShow();" data-toggle="modal" href="#">
                    Click to Login
                </a>

            </div>
        </div>
    </div>
</div>
