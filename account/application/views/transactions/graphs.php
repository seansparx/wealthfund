<div class="ibox-content period">
    <h2>Spending</h2>
    <div class="row">
        <div class="col-sm-6">
            <span>From:</span>
            <select id="graph-acc_filter" class="form-control">
                <?php echo $graph_filter; ?>
            </select>
        </div>
        <div class="col-sm-6">
            <span> During</span>
            <select name="during" id="graph-acc_during" class="form-control">
                <option>All time</option>
                <option value="7">Last 7 days</option>
                <option value="14">Last 14 days</option>
                <option value="this">This month</option>
                <option value="last">Last month</option>
                <option value="last3">Last 3 month</option>
                <option value="last6">Last 6 month</option>
                <option value="last12">Last 12 month</option>
                <option value="thisyear">This year</option>
                <option value="lastyear">Last year</option>
            </select>
        </div>
    </div>
    <div class="doughnut-wrapper"><canvas id="doughnutChart" width="300" height="300"></canvas></div>  
    <div class="row">
        <div class="col-sm-6">
            <div class="btn-wrp">
                <a class="btn btn-outline btn-info" id="btn_create_budget" href="javascript:;">+ Create A Budget</a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="btn-wrp">
                <a href="javascript:void(0);" id="adtxn" class="btn btn-outline btn-info">+ Transaction</a>
            </div>
        </div>
    </div>
    <div id="budget_bars">
        <?php include 'budgets.php'; ?>
    </div>
</div>
<?php include_once 'create_budget.php'; ?>
<?php include_once 'edit_budget.php'; ?>
