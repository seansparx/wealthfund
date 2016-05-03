
<link href="<?php echo base_url('assets/css/plugins/chosen/chosen.css'); ?>" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Website User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
            </li>
            <li>
                <a>Settings</a>
            </li>
            <li>
                <a href="<?php echo site_url('admin/manageUsers'); ?>">Administrators</a>
            </li>
            <li class="active">
                <strong>Edit Website user details</strong>
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
                    <h5>Edit Website User Details</h5>
                    
                </div>
                <div class="ibox-content">
					<?php echo form_open('admin/manageUsers/edit', array("id" => "form-website_user", "class" => "form-horizontal")); ?>
                                           
                        <input type="hidden" name="users_id" id="users_id" value="<?php echo $users_details[0]->id; ?>">
                        <div class="form-group has-error"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-5 smtp_host"><input type="text"  name="full_name" id="full_name" placeholder="Enter user full name"  class="form-control" data-rule-required="true" value="<?php echo $users_details[0]->full_name; ?>"><?php echo form_error('full_name'); ?></div>
                        </div>                                                
                        <div class="form-group"><label class="col-sm-2 control-label">User Email</label>
                            <div class="col-sm-5"><input type="text" name="user_email" id="user_email" placeholder="Enter email address" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $users_details[0]->user_email;?>"><?php echo form_error('user_email'); ?></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">User Mobile</label>
                            <div class="col-sm-5"><input type="text" name="mobile" id="mobile" placeholder="Enter mobile number" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $users_details[0]->user_mobile;?>"><?php echo form_error('mobile'); ?></div>
                        </div>
                       
                                                
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?php echo site_url('admin/manageUsers'); ?>" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit" >Submit</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
