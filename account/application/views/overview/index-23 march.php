<?php
$tbl_row = '';
$balances_total = 0;
$credit_cards_total = 0;
$loans_total = 0;
$investments_total = 0;
$property_total = 0;
$total_balance = 0;
$no_of_accounts = sizeof($bank_accounts);
$currency_code = currency_symbol();

$html_banks = '';
$html_credits = '';
$html_stocks = '';
$html_invest = '';
$html_loans = '';
$html_property = '';

if ($no_of_accounts > 0) {

    foreach ($bank_accounts as $sites) {

        $li = '<li>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span>' . substr($sites->site_name, 0, 50) . '</span> <small>' . substr($sites->account_name, 0, 50) . '</small></td>
                                <td>' . $currency_code . number_format($sites->available_balance, 2) . '<small>' . time_ago($sites->last_updated) . '</small></td>
                            </tr>
                        </tbody>
                    </table>
                </li>';
        /**
         * Creating Html of linked accounts.
         */
        switch ($sites->site_container) {

            case 'bank' : $html_banks .= $li;
                break;

            case 'credits' : $html_credits .= $li;
                break;

            case 'loans' : $html_loans .= $li;
                break;

            case 'stocks' : $html_stocks .= $li;
                break;

            case 'insurance': $html_invest .= $li;
                break;

            case 'property' : $html_property .= $li;
                break;
        }


        /**
         * Calculating account balances 
         */
        switch ($sites->site_container) {

            case 'bank' : $balances_total += $sites->available_balance;
                break;

            case 'credits' : $credit_cards_total += $sites->available_balance;
                break;

            case 'loans' : $loans_total += $sites->available_balance;
                break;

            case 'stocks' :
            case 'insurance': $investments_total += $sites->available_balance;
                break;

            case 'property' : $property_total += $sites->available_balance;
                break;
        }
    }

    $total_balance = ($balances_total + $credit_cards_total + $loans_total + $investments_total + $property_total);
}
?>

<section class="account-details">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3 account-overview">
                <div class="module-accounts-header clearfix">
                    <h2>Accounts (<?php echo $no_of_accounts; ?>)</h2>

                    <div class="tooltip-demo">
                        <a href="javascript:;" type="button" data-toggle="tooltip" data-placement="top" title="refresh"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> </a>
                        <a href="javascript:;" type="button" data-toggle="tooltip" data-placement="top" title="edit"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </a>
                    </div>
                </div>

                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li>
                            <a href="javascript:;"><i class="fa fa-money"></i> <span class="nav-label">Balances</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($balances_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Bank</a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php echo $html_banks; ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Wallet</a>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Wallet 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Wallet 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Wallet 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Cash</a>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Cash 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Cash 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Cash 3</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-credit-card"></i> <span class="nav-label">Credit Cards</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($credit_cards_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <?php echo $html_credits; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Loan</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($loans_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Personel Loan</a>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Personel Loan 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Personel Loan 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Personel Loan 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Home Loan</a>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Home Loan 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Home Loan 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Home Loan 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Education Loan</a>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Education Loan 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Education Loan 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Education Loan 3</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="glyphicon glyphicon-signal"></i> <span class="nav-label">Investments</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($investments_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Stocks</a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php echo $html_stocks; ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mutual Funds</a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-othervalue" href="javascript:;">Gold</a>
                                </li>
                                <li>
                                    <a href="#">Real Estates</a>
                                </li>
                                <li>
                                    <a href="#">Insurance</a>
                                </li>
                                <li>
                                    <a href="#">FD</a>
                                </li>
                                <li>
                                    <a href="#">PPF</a>
                                </li>
                                <li>
                                    <a href="#">EPF</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-home"></i> <span class="nav-label">Property</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($property_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                        <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-realState" href="javascript:;">House</a>
                                </li>
                                <li>
                                        <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-carvalue" href="javascript:;">Car</a>
                                </li>
                                <li>
                                        <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-carvalue" href="javascript:;">Bike</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <td>Assets</td>
                            <td><?php echo $currency_code . number_format($total_balance, 2); ?></td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Debts</td>
                            <td><?php echo $currency_code . number_format(0, 2); ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Net Worth</th>
                            <th><?php echo $currency_code . number_format($total_balance, 2); ?></th>
                        </tr>
                </table>
                <a href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-primary">Configure More</a>
            </div>
            <div class="col-sm-8 col-md-9 dashboard-content">
                <?php
                if ($no_of_accounts == 0) {
                    ?>
                    <div class="widget red-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-warning fa-4x"></i>
                            <h3 class="font-bold no-margins">
                                You have not linked any bank account yet.
                            </h3>
                            <small>Click on following link to add your bank accounts.</small><br/><br/>
                            <h3 class="font-bold no-margins"><a href="#" onClick="javascript:launch();">Add Bank Account</a></h3>
                        </div>
                    </div>    
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <?php
                        // pr($incomes);
                        //pr($expenses);
                        ?>
                        <div class="col-sm-12 col-md-8">
                           
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                     <h2>Net Income </h2>
                                    <div id="morris-bar-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <h2>Expenses</h2>
                                    <canvas id="doughnutChart" width="200" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                           
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                     <h2>Net Worth</h2>
                                    <div id="morris-one-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>
<!-- model for enter credentials information of your netbanking  -->
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Make Your Choice</h4>

            </div>
            <div class="modal-body credentials_info text-center">
                <a href="bank_account_listing.html" class="btn btn-primary"><i class="fa fa-briefcase"></i> Add Your Account</a><span class="separator">or</span>
                <a href="#" data-toggle="modal" data-target="#myModal-properties" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-home"></i> Add Your Property </a>
            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Properies information-->
<div class="modal inmodal" id="myModal-properties" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Add Your Properties</h4>
                <small class="font-bold">Select the kind of propertiy you'do like to add </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <div class="circle-success property-types text-center">
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-realState" href="#"><span>Real Estates</span><i class="fa fa-home"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-cash" href="#"><span>Cash or Debt</span><i class="fa fa-briefcase"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-vahicle" href="#"><span>Vehicle</span><i class="fa fa-automobile"></i></a>
                    <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-otherinfo" href="#"><span>Other</span><i class="fa fa-database"></i></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal2" data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>

                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Real Estate information-->
<div class="modal inmodal" id="myModal-realState" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your home</h4>
                <small class="font-bold">Please enter your address</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <input type="text" placeholder="Street Address" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" placeholder="Apartment" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="text" placeholder="Zip" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#myModal-realStatevalue">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Real Estate Value information-->
<div class="modal inmodal" id="myModal-realStatevalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit your real estate's details </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What kind of residence is this ?</label>
                            </div>
                            <div class="col-sm-7">
                                <select class="form-control m-b">
                                    <option>Primary Residence</option>
                                    <option>Primary Residence</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="$" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder=" " class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-success">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-realState"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- model for enter Success Value information-->
<div class="modal inmodal" id="myModal-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Success ! We got your property</h4>
                <small class="font-bold">This will now be counted in your net worth on your financial overview. </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <a href="#" class="btn btn-primary"><i class="fa fa-briefcase"></i> Go to Overview</a><span class="separator">or</span>
                <a href="#" data-toggle="modal" data-target="#myModal-properties" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-home"></i> Add another Property </a>
            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter cash or debt information-->
<div class="modal inmodal" id="myModal-cash" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your Cash or Debt</h4>
                <small class="font-bold">Please select what you'do like to add.</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <select class="form-control m-b">
                            <option>Debt</option>
                            <option>Cash</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit"  data-dismiss="modal"  data-toggle="modal" data-target="#myModal-cashvalue">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal"  data-dismiss="modal" data-target="#myModal-properties" >
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Cash Value information-->
<div class="modal inmodal" id="myModal-cashvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your cash </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder=" " class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="cash" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-success">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-cash"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter vahicle information-->
<div class="modal inmodal" id="myModal-vahicle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Lets find the value of your Vahicle</h4>
                <small class="font-bold">Please select what you'do like to add.</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <select class="form-control m-b">
                            <option>Automobile</option>
                            <option>Car</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-carvalue">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Car Value information-->
<div class="modal inmodal" id="myModal-carvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Let's find the value of your car </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-4">
                                <select class="form-control m-b">
                                    <option>Year</option>
                                    <option>2016</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control m-b">
                                    <option>Make</option>
                                    <option>2016</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control m-b">
                                    <option>Model</option>
                                    <option>2016</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-7">
                                <select class="form-control m-b">
                                    <option>Trim</option>
                                    <option>2016</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="form-control m-b">
                                    <option>Miles</option>
                                    <option>2016</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-edit-carvalue">
                            Show me
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-vahicle"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for Edit detail of Car information-->
<div class="modal inmodal" id="myModal-edit-carvalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Acura ILX </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Acure ILX " class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="19990" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-success">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-carvalue"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- model for enter Other information-->
<div class="modal inmodal" id="myModal-otherinfo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">What would you like to add ?</h4>
                <small class="font-bold">Please select below</small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        <select class="form-control m-b">
                            <option>Artwork</option>
                            <option>assets</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-othervalue">
                            Next
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-properties"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>
<!-- model for enter Other Value information-->
<div class="modal inmodal" id="myModal-othervalue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Edit the details of your Artwork </h4>
                <small class="font-bold">Please answer the following questions</small>
            </div>
            <div class="modal-body credentials_info">
                <form class="form-horizontal">
                    <div class="central-form">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>How would you like to see it ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Artwork" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label>What is its estimated value ?</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" placeholder="$" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal"  data-toggle="modal" data-target="#myModal-success">
                            Add It
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-back" data-toggle="modal" data-target="#myModal-otherinfo"  data-dismiss="modal">
                    Back
                </button>
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>
                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('popups/fastlink'); ?>

<script>
    $("#myModal-fastlink .btn-close").click(function () {
        $("#myModal-fastlink").modal('toggle');
    });
</script>
<!-- model for enter credentials information of your netbanking  -->
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Make Your Choice</h4>
                <small class="font-bold">Providing your account credentials allow us to import your account details </small>
            </div>
            <div class="modal-body credentials_info text-center">
                <form class="form-horizontal ">
                    <div class="form-group text-center">
                        We are continue with designing.
                        <!-- <input type="text" placeholder="Online ID" class="form-control"> -->
                    </div>
                    <div class="form-group text-center">
                            <!-- <input type="password" placeholder="IPIN(Password)" class="form-control"> -->
                    </div>
                    <div class="form-group text-center">

                        <!-- <button class="btn btn-lg btn-primary" type="submit" data-dismiss="modal" data-toggle="modal" data-target="#myModal22">
                                Submit
                        </button> -->
                    </div>
                </form>

                <a href="#" class="redirect-bank"> Don't remember your credentials?</a>

            </div>
            <div class="modal-footer">
                <span  class="bank-level-securtiy text-capitalize"><a href="#"   data-container="body" data-toggle="popover" data-placement="top" data-title="Bank level security" data-content="The same 128-bit encryption and physical security standards as your bank. "  ><i class="fa fa-lock"></i> bank lavel security</a></span>

                <button type="button" class="btn btn-white" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/morris/morris.js'); ?>"></script>
<!-- Morris demo data-->
<script>
    $(document).ready(function () {

        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function (event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });

        $.getJSON(site_url('overview/graph_data'), {action: 'net_income'}, function (result) {
            Morris.Bar({
                element: 'morris-bar-chart',
                data: result,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Income', 'Expenses'],
                hideHover: 'auto',
                resize: true,
                barColors: ['#0ac775', '#ef1d3b'],
            });
        });


        $.getJSON(site_url('overview/graph_data'), {action: 'expense'}, function (result) {
//            Morris.Donut({
//                element: 'morris-donut-chart',
//                data: result,
//                resize: true,
//                colors: ['#87d6c6', '#0ac775', '#ef1d3b', '#ffdb4e', '#eeeeee'],
//            });

            var doughnutData = [{
                    value: 300,
                    color: "#ffa500",
                    highlight: "#1ab394",
                    label: "Expenses"
                }, {
                    value: 50,
                    color: "#1ab394",
                    highlight: "#1ab394",
                    label: "Expenses"
                }, {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Expenses"
                }];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(result, doughnutOptions);

        });


        Morris.Line({
            element: 'morris-one-line-chart',
            data: [{
                    year: '2008',
                    value: 5
                }, {
                    year: '2009',
                    value: 10
                }, {
                    year: '2010',
                    value: 8
                }, {
                    year: '2011',
                    value: 22
                }, {
                    year: '2012',
                    value: 8
                }, {
                    year: '2014',
                    value: 10
                }, {
                    year: '2015',
                    value: 5
                }],
            xkey: 'year',
            ykeys: ['value'],
            resize: true,
            lineWidth: 4,
            labels: ['Value'],
            lineColors: ['#1ab394'],
            pointSize: 5,
        });

    });

    var cbpAnimatedHeader = (function () {
        var docElem = document.documentElement, header = document.querySelector('.navbar-default'), didScroll = false, changeHeaderOn = 200;
        function init() {
            window.addEventListener('scroll', function (event) {
                if (!didScroll) {
                    didScroll = true;
                    setTimeout(scrollPage, 250);
                }
            }, false);
        }

        function scrollPage() {
            var sy = scrollY();
            if (sy >= changeHeaderOn) {
                $(header).addClass('navbar-scroll')
            } else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }

        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }

        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>



