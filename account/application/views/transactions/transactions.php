<div class="row">
    <div class="col-sm-12">
        <div class="account-search">
            <h2>All Accounts<small>You have added <?php echo count($bank_accounts); ?> accounts</small><small><a href="javascript:void(0);" onClick="javascript:launch();">Add another ?</a></small></h2>
            <div class="input-group">
                <input type="text" placeholder="Search" id="search_box" class="input-sm form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-primary">
                        Go!
                    </button> 
                </span>
            </div>
        </div>
        <table class="table fee">
            <thead>
                <tr>
                    <td>Total Cash</td>
                    <td>Total Debt</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo $account_balance; ?></th>
                    <th><?php echo $currency; ?>0.00</th>
                </tr> </tfoot>
        </table>
    </div>
</div>
<div class="ibox-content">
    <div class="table-responsive">
        <?php include_once 'edit_form.php'; ?>
        <table id="transactions" class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chk_all" value=""/></th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                <?php echo $HTML; ?>
                <!--- gradeX / gradeC / gradeA / gradeU -->

            </tbody>
        </table>
    </div>

</div>