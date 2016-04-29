<?php
$mainMenu = $this->configuration_model->read_menu();
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile_small.jpg'); ?>" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo ucwords($this->session->userdata(SITE_SESSION_NAME.'ADMINNNAME'));?></strong>
                            </span> <span class="text-muted text-xs block">Administrator<b class="caret"></b></span> </span> </a>
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
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <?php
            $active_menu = '';
            if (count($mainMenu) > 0) {
                foreach ($mainMenu as $key => $value) {
                    //if ($this->configuration_model->checkMenuPermission($value->menuId)) {
                    $subMenu = $this->configuration_model->read_sub_menu($value->menuId);
                        ?>
                        <li class="<?php echo $active_menu == $value->menuName ? 'active' : ''; ?>">
                            <a href="<?php echo trim($value->menuUrl)!='' ? site_url('admin/' . $value->menuUrl) : 'javascript:void(0);'; ?>">
                                <i class="<?php echo $value->menuClass; ?>"></i> 
                                <span class="nav-label"><?php echo $value->menuName; ?></span> 
                                <?php
                                echo (count($subMenu) > 0) ? '<span class="fa arrow"></span>' : '';
                                ?>
                            </a>
                            <?php
                                if (count($subMenu) > 0) {
                                    echo '<ul class="nav nav-second-level">';
                                    foreach ($subMenu as $subKey => $subValue) {
                                        if ($this->configuration_model->checkMenuPermission($subValue->menuId)) {
                                            ?>
                                        <li><a href="<?php echo site_url('admin/' . $subValue->menuUrl); ?>"><?php echo $subValue->menuName; ?></a></li>
                                        <?php
                                        }
                                    }
                                    echo '</ul>';
                                }
                            ?>
                        </li>
                        <?php
                    //}
                }
            }
            ?>
        </ul>

    </div>
</nav>
