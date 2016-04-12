<!-- =============Markup of Model for activation code section  ==================== -->
<div class="modal inmodal" id="myModal_actCode" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <?php
        echo form_open('', array('method' => 'post', 'name' => 'signup_otp_form', 'id' => 'signup_otp_form'));
        ?>
        <div class="modal-content animated bounceInRight">

            <div class="modal-body">
                <div class="form-group">
                    <label>Enter Reset Password code</label>
                    <?php
                    $data = array(
                        'name' => 'otp',
                        'id' => 'otp',
                        'maxlength' => '6',
                        'placeholder' => 'Enter Activation Code',
                        'class' => 'form-control',
                        'value' => set_value('activation_code')
                    );
                    echo form_input($data);
                    echo form_error('activation_code');
                    ?>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit_activation_code" id="submit_activation_code" class="btn btn-primary  m-b ">
                        Verify
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">
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