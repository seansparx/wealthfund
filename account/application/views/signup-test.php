<style type="text/css">
    .error{
        color:red;
    }
</style>
<section id="features" class="container services">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>User Registration</h3>                    
                </div>
                <div class="ibox-content">
                    <?php
                    echo form_open('signup/test', array('method' => 'post', 'name' => 'signup', 'id' => 'signup', 'class' => 'form-horizontal'));
                    ?>

                    <div class="form-group"><label class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-10"><input type="text" value="<?php echo set_value('email'); ?>" id="email" class="form-control" name="email" placeholder="Email Address">
                            <?php
                            echo form_error('email');
                            ?>                                
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10"><input type="password" value="<?php echo set_value('password'); ?>" class="form-control" id="password" name="password" placeholder="Password">
<?php echo form_error('password'); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Repeat Password</label>

                        <div class="col-sm-10"><input type="password" value="<?php echo set_value('passconf'); ?>" class="form-control" id="passconf" name="passconf" placeholder="Confirm Password">
<?php echo form_error('passconf'); ?>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Mobile Number</label>

                        <div class="col-sm-10"><input type="text" value="<?php echo set_value('mobile'); ?>" placeholder="Mobile Number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
<?php echo form_error('mobile'); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-btn">

                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="salutation" id="salutation">
                                            <option value="mr">Mr</option>
                                            <option value="mrs">Mrs</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="text" class="form-control" value="<?php echo set_value('username'); ?>" id="username" name="username" placeholder="Full Name">
<?php echo form_error('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">

                            <button class="btn btn-primary" name="submit" id="submit" type="submit">Sign Up</button>
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