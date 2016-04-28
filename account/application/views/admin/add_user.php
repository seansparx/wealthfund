<link href="<?php echo base_url('assets/css/plugins/chosen/chosen.css'); ?>" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add New User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
            </li>
            <li>
                <a>Settings</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/users'); ?>">Administrators</a>
            </li>
            <li class="active">
                <strong>Add User</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add User</h5>
                    
                </div>
                <div class="ibox-content">
                    <form action="<?php echo site_url('admin/users/add')?>" method="post" id="form-add-user" class="form-horizontal">
                        <div class="form-group has-error"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-5 smtp_host"><input type="text"  name="username" id="username" placeholder="Enter username"  class="form-control" data-rule-required="true" value=""><?php echo form_error('username'); ?></div>
                        </div>                                                
                        <div class="form-group"><label class="col-sm-2 control-label">User Email</label>
                            <div class="col-sm-5"><input type="text" name="user_email" id="user_email" placeholder="Enter email address" class="form-control" data-rule-email="true" data-rule-required="true" value=""><?php echo form_error('user_email'); ?></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-5"><input type="password" name="new_password" id="new_password" placeholder="Choose new password" class="form-control" data-rule-email="true" data-rule-required="true" value=""><?php echo form_error('new_password'); ?></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-5"><input type="password" name="confirm_password" id="confirm_password" placeholder="Retype your password" class="form-control" data-rule-email="true" data-rule-required="true" value=""><?php echo form_error('confirm_password'); ?></div>
                        </div>
                                                
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
