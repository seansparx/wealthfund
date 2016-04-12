<!-- =============Markup of Model for activation code section  ==================== -->
<div class="modal inmodal" id="forget_actCode" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <?php
        echo form_open('login/checkPassVerifyCode', array('method' => 'post', 'name' => 'forgetpassword_otp_form', 'id' => 'forgetpassword_otp_form'));
        ?>
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-group">
                    <label>Enter code to reset password</label>
                    <?php
                    $data = array(
                        'name' => 'forgetpassword_otp',
                        'id' => 'forgetpassword_otp',
                        'maxlength' => '6',
                        'placeholder' => 'Enter code to reset Password',
                        'class' => 'form-control',
                        'value' => set_value('forgetpassword_otp')
                    );
                    echo form_input($data);
                    echo form_error('forgetpassword_otp');
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit_forgetpassword_activation_code" id="submit_forgetpassword_activation_code" class="btn btn-primary  m-b ">
                        Verify
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Back
                </button>
                <button type="button" id="resend_otp" token="<?php echo encode('otp'); ?>" class="btn btn-primary">
                    Resend Activation Code
                </button>
            </div>
        </div>
        <?php
        echo form_close();
        ?>
    </div>
</div>