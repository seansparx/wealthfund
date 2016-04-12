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
    <div class="row">
        <?php

            /** Arrange spendings of this month */
            if(sizeof($spend_of_month) > 0) {
                foreach ($spend_of_month as $spend) {
                    $spent[$spend->category_id] = $spend->amt;
                }
            }
        
            /** Display Budget bars */
            if(sizeof($budgets) > 0) {
                foreach ($budgets as $budget) {
                    $amount   = $budget->amount;
                    $cat_type = ucwords($budget->type_name);
                    $cat_name = ucwords($budget->category_name);
                    $hv_spent = isset($spent[$budget->category_id]) ? $spent[$budget->category_id] : 0;
                    $spent_percent = ($hv_spent * 100) / $amount;
                    $bar_border = ($spent_percent > 50) ? 'border-color: #f15c5e;' : 'border-color: #1ab394;';
                    $bar_color = ($spent_percent > 50) ? 'background-color: #f15c5e;' : 'background-color: #1ab394;';
                    ?>
                    <div class="col-sm-6">
                        <div id="<?php echo encode($budget->id);?>" class="bar-wrapper">
                            <span class="text-income"><?php echo $cat_type; ?>: <strong><?php echo $cat_name; ?></strong> </span>
                            <span class="text-spent"><strong><?php echo currency_symbol().number_format($hv_spent, 2); ?></strong> of <strong class="b_limit"><?php echo currency_symbol().  number_format($amount, 2); ?></strong></span>
                            <div class="progress progress-bar-default" style="<?php echo $bar_border; ?>">
                                <div style="width: <?php echo $spent_percent;?>%;<?php echo $bar_color; ?>" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar">
                                    <span class="sr-only">43% Complete (success)</span>
                                </div>
                            </div>
                            <a class="edit_budget" href="javascript:;">Edit Details</a>
                            <small> <?php echo currency_symbol().number_format($hv_spent, 2); ?> spent this month</small>
                            <div class="caunter">
                                <i class="fa fa-caret-left pre-count">&nbsp;</i>
                                <span><?php echo $budget->amount; ?></span>
                                <i class="fa fa-caret-right next-count">&nbsp;</i>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            else{

            }
        ?>
<!--        <div class="col-sm-6">
            <div class="bar-wrapper">
                <span class="text-income">Income <strong>Reimbursment</strong> </span><span class="text-spent"><strong>Rs. 0</strong> of <strong>Rs. 1098</strong></span>
                <div class="progress progress-bar-default">
                    <div style="width: 43%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar">
                        <span class="sr-only">43% Complete (success)</span>
                    </div>
                </div>
                <a href="javascript:;">Edit Details</a>
                <small> Rs. 0 spent this month</small>
                <div class="caunter">
                    <i class="fa fa-caret-left pre-count">&nbsp;</i><span>2080</span><i class="fa fa-caret-right next-count">&nbsp;</i>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="bar-wrapper">
                <span class="text-income">Income <strong>Reimbursment</strong> </span><span class="text-spent"><strong>Rs. 0</strong> of <strong>Rs. 1098</strong></span>
                <div class="progress progress-bar-default">
                    <div style="width: 55%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar">
                        <span class="sr-only">55% Complete (success)</span>
                    </div>
                </div>
                <a href="javascript:;">Edit Details</a>
                <small> Rs. 0 spent this month</small>
                <div class="caunter">
                    <i class="fa fa-caret-left pre-count">&nbsp;</i><span>2080</span><i class="fa fa-caret-right next-count">&nbsp;</i>
                </div>
            </div>
        </div>-->
        
    </div>