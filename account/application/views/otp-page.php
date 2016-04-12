<section id="features" class="container services">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Verify your mobile number</h3>                    
                </div>
                <div class="ibox-content">
                    <?php
                    echo isset($otp_error) ? $otp_error : '';
                    ?>
                    <?php                        
                        echo form_open('', array('method' => 'post', 'name' => 'signup_otp_form', 'id' => 'signup_otp_form', 'class' => 'form-horizontal'));
                    ?>
                        <div class="form-group"><label class="col-sm-2 control-label">Activation Code</label>
                            <div class="col-sm-10">
                                <?php
                                    $data = array(
                                        'name'        => 'otp',
                                        'id'          => 'otp',
                                        'maxlength'   => '6',
                                        'placeholder' => 'Enter Activation Code',
                                        'class'       => 'form-control',
                                        'value'       => set_value('activation_code')
                                    );
                                    echo form_input($data);
                                    echo form_error('activation_code');
                                ?>
                            </div>
                            <p style="color:red;"><?php //echo isset($otp_value) ? 'OTP is : '.$otp_value : ''; ?></p>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" name="submit_activation_code" id="submit_activation_code">Submit</button> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?php echo site_url('signup'); ?>">< Back</a>
                            </div>
                            <div id="resend_otp" class="col-sm-4 col-sm-offset-2">
                                <a token="<?php echo encode('otp'); ?>" href="javascript:void(0);">Resend Activation Code</a>
                            </div>
                        </div>
                    <?php
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>