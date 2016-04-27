
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Administrators</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('admin/dashboard');?>">Home</a>
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

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic Data Tables example with responsive plugin</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="#">Config option 1</a>
                            </li>
                            <li>
                                <a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Add Date</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($all_users as $records) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $records->username;?></td>
                                    <td><?php echo $records->emailId; ?></td>
                                    <td><?php echo $records->addDate; ?></td>
                            <?php        if ($records->adminLevelId == SUPER_ADMIN_LVL_ID) {
                        ?>
                                    <td>&nbsp;--</td>
                                  <?php }
                     else { ?>
                                    <td><a href="users/admin_permission/<?php echo $records->id ?>">Permission</a></td>
                     <?php } ?> 
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo site_url('assets/js/plugins/dataTables/datatables.min.js'); ?>"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
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

        /* Init DataTables */
        var oTable = $('#editable').DataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable('../example_ajax.php', {
            "callback": function (sValue, y) {
                var aPos = oTable.fnGetPosition(this);
                oTable.fnUpdate(sValue, aPos[0], aPos[1]);
            },
            "submitdata": function (value, settings) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition(this)[2]
                };
            },
            "width": "90%",
            "height": "100%"
        });

    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData(["Custom row", "New row", "New row", "New row", "New row"]);

    }
</script>