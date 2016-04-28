
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard'); ?>">Home</a>
            </li>
            <li class="active">
                <strong>Manage Users</strong>
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
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Joined On</th>
                                    <th>Updated On</th>
                                    <th>Last Login</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($wf_users as $records) { 
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $records->id; ?></td>
                                            <td><?php echo ucwords($records->prefix.'. '.$records->full_name); ?></td>
                                            <td><?php echo strtolower($records->user_email); ?></td>
                                            <td><?php echo $records->country_code.''.$records->user_mobile; ?></td>
                                            <td><?php echo date_time($records->created_on); ?></td>
                                            <td><?php echo date_time($records->updated_on); ?></td>
                                            <td><?php echo date_time($records->last_login); ?></td>
                                            <td><?php echo $records->is_active; ?></td>
                                            <?php 
                                            if ($records->adminLevelId == SUPER_ADMIN_LVL_ID) {
                                                ?>
                                                <td>&nbsp;--</td>
                                                <?php 
                                            } 
                                            else {
                                                ?>
                                                <td width="100">
                                                    <a title="Edit Details" href="ManageUsers/edit/<?php echo $records->id ?>">
                                                        <button type="button" class="btn btn-outline btn-success dim"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                    <button title="Delete" type="button" class="btn btn-outline btn-danger dim"><i class="fa fa-trash-o"></i></button>
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