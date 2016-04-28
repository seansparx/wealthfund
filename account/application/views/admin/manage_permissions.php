
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
                <strong>Admin User Permission</strong>
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
                    <h5><input type="checkbox" onchange="checkAllMenu(this)" value="" name="check_all">Check All</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               <?php if($menuOptions){
                                   echo $menuOptions; 
                               } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkAllMenu(ele) 
    {
        var checkboxes = document.getElementsByTagName('input');
        if (ele.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                console.log(i)
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    }
    
    function checkMenu(id)
    {
        var checked = document.getElementById("menuCheckB" + id).checked;
        document.getElementById("menuCheck_" + id + "_add").checked = checked;
        document.getElementById("menuCheck_" + id + "_edit").checked = checked;
        document.getElementById("menuCheck_" + id + "_del").checked = checked;
    }
    
    function checkMain(element, id) 
    {
        $(".sub_menu" + id).prop('checked', $(element).prop("checked"));
        $(".sub_menu" + id).trigger('change');
    }
</script>

