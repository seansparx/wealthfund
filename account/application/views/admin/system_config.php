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
                    <form method="get" class="form-horizontal">
                        <div class="form-group has-error"><label class="col-sm-2 control-label">SMTP Host</label>
                            <div class="col-sm-5"><input type="text" maxlength="100" class="form-control"></div>
                        </div>
                        <div class="form-group">                            
                            <label class="col-sm-2 control-label">SMTP Port</label>
                            <div class="col-sm-2"><input type="text" maxlength="20" class="form-control"></div>
                            <label class="col-sm-1 control-label">Enctype</label>
                            <div class="col-sm-2">
                                <select class="form-control m-b" name="account">
                                    <option selected="selected" value="ssl">SSL</option>
                                    <option value="tsl">TSL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group"><label class="col-sm-2 control-label">SMTP Email</label>
                            <div class="col-sm-5"><input type="text" maxlength="100" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">SMTP Password</label>
                            <div class="col-sm-5"><input type="password" maxlength="100" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-5"><input type="password" maxlength="100" class="form-control"></div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group "><label class="col-sm-2 control-label">Currency Code</label>
                            <div class="col-sm-5"><input type="text" maxlength="20" class="form-control"></div>
                        </div>
                        <div class="form-group has-success"><label class="col-sm-2 control-label">Currency Symbol</label>
                            <div class="col-sm-5"><input type="text" maxlength="10" class="form-control"></div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
