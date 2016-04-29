
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Administrators</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
            </li>
            <li>
                <a>Settings</a>
            </li>
            <li class="active">
                <strong>Administrators</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?php echo site_url('admin/users/add');?>" class="btn btn-outline btn-primary">Add User</a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Here you can manage admin users.</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table id="dataTables-admin_users" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Added On</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($all_users as $records) { 
                                        $super_admin = ($records->adminLevelId == SUPER_ADMIN_LVL_ID);
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $records->username; ?></td>
                                            <td><?php echo $records->emailId; ?></td>
                                            <td><?php echo date_time($records->addDate); ?></td>
                                            <td>
                                                <?php echo is_active($records->id, $records->status, $super_admin); ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo action_edit($records->id, $super_admin, 'users/editUser'); 
                                                    echo action_permission($records->id, $super_admin, 'users/admin_permission'); 
                                                    echo action_delete($records->id, $super_admin, 'users/delete'); 
                                                ?>
                                            </td>
                                        </tr>
                                    <?php 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/dataTables/datatables.min.js'); ?>"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('#dataTables-admin_users').DataTable({
            "aoColumns":[
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": false}
            ],
            buttons: [{
                    extend: 'copy'
                }, {
                    extend: 'csv'
                }, {
                    extend: 'excel',
                    title: 'ExampleFile'
                }, {
                    extend: 'pdf',
                    title: 'ExampleFile'
                }, {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                }]

        });

    });
</script>