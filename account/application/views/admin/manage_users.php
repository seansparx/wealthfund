
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
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $records->username; ?></td>
                                            <td><?php echo $records->emailId; ?></td>
                                            <td><?php echo $records->addDate; ?></td>
                                            <td><?php //echo $records->addDate; ?></td>
                                            <?php 
                                            if ($records->adminLevelId == SUPER_ADMIN_LVL_ID) {
                                                ?>
                                                <td>&nbsp;--</td>
                                                <?php 
                                            } 
                                            else {
                                                ?>
                                                <td>
                                                    <a title="Edit Details" href="users/editUser/<?php echo $records->id ?>">
                                                        <button type="button" class="btn btn-outline btn-success dim"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                    <a title="Access Permissions" href="users/admin_permission/<?php echo $records->id ?>">
                                                        <button type="button" class="btn btn-outline btn-warning dim"><i class="fa fa-lock"></i></button>
                                                    </a>
                                                    <a href="users/delete/<?php echo $records->id; ?>"  title="Delete">
                                                    <button title="Delete" type="button" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-outline btn-danger dim"><i class="fa fa-trash-o"></i></button>
                                                    </a>
                                                    </td>
                                                <?php 
                                            } 
                                            ?> 
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
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            "aoColumns":[
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

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData(["Custom row", "New row", "New row", "New row", "New row"]);

    }
</script>