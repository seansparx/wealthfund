<!-- =============Markup of Model for activation code section  ==================== -->
<div class="modal inmodal" id="resetpassword_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <?php
        echo form_open('login/reset_password', array('method' => 'post', 'name' => 'resetpassword_form', 'id' => 'resetpassword_form'));
        ?>
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <div class="form-group">
                    <label>Enter password</label>
                    <?php
                    $data = array(
                        'name' => 'reset_password',
                        'id' => 'reset_password',
                        'maxlength' => '6',
                        'placeholder' => 'Enter Password',
                        'class' => 'form-control',
                        'value' => set_value('reset_password')
                    );
                    echo form_input($data);
                    echo form_error('forgetpassword_otp');
                    ?>
                </div>
                <div class="form-group">
                    <label>Enter confirm password</label>
                    <?php
                    $data = array(
                        'name' => 'confirm_reset_password',
                        'id' => 'confirm_reset_password',
                        'maxlength' => '6',
                        'placeholder' => 'Enter Confirm Password',
                        'class' => 'form-control',
                        'value' => set_value('confirm_reset_password')
                    );
                    echo form_input($data);
                    echo form_error('confirm_reset_password');
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit_resetpassword" id="submit_resetpassword" class="btn btn-primary  m-b ">
                        Submit
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Back
                </button>
                
            </div>
        </div>
        <?php
        echo form_close();
        ?>
    </div>
</div>