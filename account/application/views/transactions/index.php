<?php
$HTML = '';
$currency = currency_symbol();
$graph_filter = '<option value=""> All Accounts ('.count($bank_accounts).')</option>';

if (isset($transactions) && count($transactions) > 0) {

    foreach ($transactions as $entry) {
        $id = $entry->id;
        $postDate = isset($entry->post_date) ? date('d/M/Y', strtotime($entry->post_date)) : '-';
        $description = $entry->description;
        $amount = $currency . number_format($entry->amount, 2);
        $category = $entry->category_name;
        $category_type = $entry->category_type_id;
        $category_id = $entry->category_id;

        $HTML .= '<tr id="row_' . $id . '" class="gradeX">'
                . '<td><input type="checkbox" value=""/><input type="hidden" readonly="readonly" name="tid" value="' . $id . '"/><input type="hidden" id="cat_id" name="cat_id" value="' . $category_id . '"/><input type="hidden" id="cat_type" name="cat_type" value="' . $category_type . '"/></td>'
                . '<td>' . $postDate . '</td>'
                . '<td>' . $description . '</td>'
                . '<td>' . $category . '</td>'
                . '<td>' . $amount . '</td>'
                . '</tr>';

        $autocomplete[] = $description;
    }
}
?>
<section class="account-details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 account-overview">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="active">
                            <a href="javascript:void(0);">
                                <span class="nav-label">Accounts</span> 
                                <a href="javascript:;" type="button" data-toggle="tooltip" data-placement="top" id="refresh" title="refresh"><span id="refresh" class="glyphicon glyphicon-repeat pull-right"></span></a>
                            </a>
                            <ul id="nav_accounts" class="nav nav-second-level">
                                <li id="<?php echo encode('all'); ?>">
                                    <a href="javascript:void(0);">All Accounts <small>You have added <?php echo count($bank_accounts); ?> accounts</small> </a>
                                </li>
                                <?php
                                foreach ($bank_accounts as $account) {
                                    ?>
                                    <li id="<?php echo encode($account->account_id); ?>">
                                        <a href="javascript:void(0);"><?php echo $account->site_name; ?> <small><?php echo $account->account_name; ?></small> </a>
                                    </li>
                                    <?php
                                    $graph_filter .= '<option value="'.$account->account_id.'">'.$account->account_name.'</option>';
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-9 dashboard-content trasaction-details">
                <?php
                    include 'graphs.php';
                    include 'transactions.php';
                ?>
            </div>
        </div>
    </div>
</section>

<style>
    #transactions tfoot {
        display: table-row-group;
    }

    table.dataTable tbody tr.selected {
        background-color: #B0BED9;
    }
</style>

<script src="<?php echo base_url('assets/js/datatable/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/datatable/shCore.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/datatable/demo.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery-ui-1.10.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/transaction.js'); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
