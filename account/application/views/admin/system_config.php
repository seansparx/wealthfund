<link href="<?php echo base_url('assets/css/plugins/chosen/chosen.css'); ?>" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Configuration</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
            </li>
            <li>
                <a>Settings</a>
            </li>
            <li class="active">
                <strong>System Configuration</strong>
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
                    <h5><small>Here you can edit system configurations.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post"  class="form-horizontal" onsubmit="return validationSystemConfig();" action="<?php echo site_url('admin/configuration')?>">
                        <div class="form-group has-error"><label class="col-sm-2 control-label">SMTP Host</label>
                            <div class="col-sm-5 smtp_host"><input type="text"  name="SMTP_HOST" id="SMTP_HOST" placeholder="Insert SMTP host"  class="form-control" data-rule-required="true" value="<?php echo $SMTP_HOST; ?>"><?php echo form_error('SMTP_HOST'); ?></div>
                        </div>
                        <div class="form-group">                            
                            <label class="col-sm-2 control-label">SMTP Port</label>
                            <div class="col-sm-2 smtp_port"><input type="text" name="SMTP_PORT" id="SMTP_PORT" placeholder="Insert SMTP port" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $SMTP_PORT; ?>"><?php echo form_error('SMTP_PORT'); ?></div>
                            <label class="col-sm-1 control-label">Enctype</label>
                            <div class="col-sm-2">
                                <select class="form-control m-b" name="account">
                                    <option selected="selected" value="ssl">SSL</option>
                                    <option value="tsl">TSL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">SMTP Email</label>
                            <div class="col-sm-5"><input type="text" name="SMTP_MAIL" id="SITE_EMAIL" placeholder="Insert SMTP email" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $SMTP_MAIL; ?>"><?php echo form_error('SMTP_MAIL'); ?></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">SMTP Password</label>
                            <div class="col-sm-5"><input type="password" name="SMTP_PASSWORD" id="SMTP_PASSWORD" placeholder="Insert SMTP password" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $SMTP_PASSWORD; ?>"><?php echo form_error('SMTP_PASSWORD'); ?></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-5"><input type="password" name="CONF_SMTP_PASSWORD" id="SMTP_PASSWORD" placeholder="Insert SMTP confirm password" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $CONF_SMTP_PASSWORD; ?>"><?php echo form_error('CONF_SMTP_PASSWORD'); ?></div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group "><label class="col-sm-2 control-label">Currency Code</label>
                            <div class="col-sm-5"><input type="text" name="CURRENCY_CODE" id="CURRENCY_CODE" placeholder="Insert currency code" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $CURRENCY_CODE; ?>"><?php echo form_error('CURRENCY_CODE'); ?></div>
                        </div>
                        <div class="form-group has-success"><label class="col-sm-2 control-label">Currency Symbol</label>
                           <div class="col-sm-5"><input type="text" name="CURRENCY" id="CURRENCY" placeholder="Insert currency symbol" class="form-control" data-rule-email="true" data-rule-required="true" value="<?php echo $CURRENCY; ?>"><?php echo form_error('CURRENCY'); ?></div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit" >Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
