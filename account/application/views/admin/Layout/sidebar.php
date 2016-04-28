<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile_small.jpg'); ?>" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                            </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('admin/login/logout');?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    WF
                </div>
            </li>
            <li class="active">
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="active">
                <a href="javascript:void(0);">
                    <i class="fa fa-gear"></i> 
                    <span class="nav-label">System</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo site_url('admin/users'); ?>">Administrators</a></li>
                    <li><a href="<?php echo site_url('admin/configuration'); ?>">Settings</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>