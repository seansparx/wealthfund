
    <div class="row">
        <?php

            /** Arrange spendings of this month */
            if(sizeof($spend_of_month) > 0) {
                foreach ($spend_of_month as $spend) {
                    $spent[$spend->category_id] = $spend->amt;
                }
            }
//pr($spent);die;
            /** Display Budget bars */
            if(sizeof($budgets) > 0) {
                
                foreach ($budgets as $budget) {
                    $budget_ids[]  = $budget->category_id;
                    $amount        = $budget->amount;
                    $cat_type      = ucwords($budget->type_name);
                    $cat_name      = ucwords($budget->category_name);
                    $hv_spent      = isset($spent[$budget->category_id]) ? $spent[$budget->category_id] : 0;
                    $spent_percent = ($hv_spent * 100) / $amount;
                    $bg_color      = '#1ab394'; //green.
                    
                    if($spent_percent >= 75) {
                        $bg_color = '#f8ac59;'; //orange.
                    }

                    if($spent_percent >= 99.99) {
                        $bg_color = '#f15c5e;'; //red.
                    }
                    
                    $bar_border = 'border-color: '.$bg_color;
                    $bar_color  = 'background-color: '.$bg_color;
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
                            <a style="margin-left:80px;color:red;" class="del_budget" href="javascript:;">delete</a>
                            <small> <?php echo currency_symbol().number_format($hv_spent, 2); ?> spent this month</small>
                            <div class="caunter">
                                <i class="fa fa-caret-left pre-count">&nbsp;</i>
                                <span><?php echo $budget->amount; ?></span>
                                <i class="fa fa-caret-right next-count">&nbsp;</i>
                                <input type="hidden" class="hv-spent" value="<?php echo $hv_spent; ?>"/>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            else{

            }
        ?>
    </div>
