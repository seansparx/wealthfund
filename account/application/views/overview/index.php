<script>
    $(document).ready(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
    });

    toastr.success('Wealthfund Group', 'Welcome <?php echo $this->session->userdata['wealthfund_session']['wealthfund_name']; ?>');</script>
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
        $li = '<li> <i id="'.encode($sites->site_account_id.":::XXXX:::".$sites->account_id).'" class="label label-warning remove-list">Remove</i>
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
            case 'bank':
                $html_banks.=$li;
                break;
            case 'credits':
                $html_credits.=$li;
                break;
            case 'loans':
                $html_loans.=$li;
                break;
            case 'stocks':
                $html_stocks.=$li;
                break;
            case 'insurance':
                $ins_type = strtolower(str_replace(" ", "", $sites->site_name));
                if ($ins_type == 'lifeinsurance') {
                    $html_life_insurance.=$li;
                } else if ($ins_type == 'healthinsurance') {
                    $html_health_insurance.=$li;
                } else if ($ins_type == 'long-termdisabilitycoverage') {
                    $html_disability_insurance.=$li;
                } else if ($ins_type == 'autoinsurance') {
                    $html_auto_insurance.=$li;
                } else {
                    $html_other_insurance.=$li;
                }
                break;
            case 'fd':
                $html_fd.=$li;
                break;
            case 'gold':
                $html_gold.=$li;
                break;
            case 'property':
                $html_property.=$li;
                break;
        }
        /**
         * Calculating account balances
         */
        switch ($sites->site_container) {
            case 'bank':
                $balances_total+=$sites->available_balance;
                break;
            case 'credits':
                $credit_cards_total+=$sites->available_balance;
                break;
            case 'loans':
                $loans_total+=$sites->available_balance;
                break;
            case 'stocks':
            case 'fd':
            case 'gold':
            case 'insurance':
                $investments_total+=$sites->available_balance;
                break;
            case 'property':
                $property_total+=$sites->available_balance;
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
                <div class="dropdown profile-element"> 
                    <span>
                        <img src="<?php echo base_url('assets/img/profile_small.jpg'); ?>" class="img-circle" alt="image">
                    </span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata['wealthfund_session']['wealthfund_name']; ?></strong>
                            </span> <span class="text-muted text-xs block">Wealth Fund</span> </span> 
                    </a>                       
                </div>
                <div class="module-accounts-header clearfix">
                    <h2>Accounts (<?php echo $no_of_accounts; ?>)</h2>

                    <div class="tooltip-demo">
                        <a href="javascript:;" type="button" data-toggle="tooltip" data-placement="top" id="refresh" title="refresh"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> </a>
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
                                            <a href="#">Cash <?php echo currency_symbol().$cash_balance; ?></a>
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
                                    <?php
                                    if (trim($html_loans) != '') {
                                        ?>
                                        <a href="javascript:;"><span class="fa arrow"></span>Personal Loan</a>
                                        <ul class="nav nav-second-level collapse">
                                            <li>
                                                <a href="#">Personal Loan 1</a>
                                            </li>
                                            <li>
                                                <a href="#">Personal Loan 2</a>
                                            </li>
                                            <li>
                                                <a href="#">Personal Loan 3</a>
                                            </li>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="javascript:;" class="openfastlink">Personal Loan</a>
                                        <?php
                                    }
                                    ?>

                                </li>
                                <li>
                                    <?php
                                    if (trim($html_loans) != '') {
                                        ?>
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
                                        <?php
                                    } else {
                                        ?>
                                        <a href="javascript:;" class="openfastlink">Home Loan</a>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                    if (trim($html_loans) != '') {
                                        ?>
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
                                        <?php
                                    } else {
                                        ?>
                                        <a href="javascript:;" class="openfastlink">Education Loan</a>
                                        <?php
                                    }
                                    ?>
                                </li>
                            </ul>                             
                        </li>
                        <li>
                            <a href="javascript:;"><i class="glyphicon glyphicon-signal"></i> <span class="nav-label">Investments</span> <span class="fa arrow"></span><span class="pull-right"><?php echo $currency_code . number_format($investments_total, 2); ?></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span><i class="label label-primary openfastlink">Add</i>Stocks</a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php echo $html_stocks; ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mutual Funds</a>
                                </li>
                                <li>
                                    <a id="gold" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>Gold</a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php
                                        if (trim($html_gold) != '') {
                                            echo $html_gold;
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Real Estate</a>
                                </li>
                                <li>
                                    <a href="javascript:;"><span class="fa arrow"></span>Insurance</a>
                                    <ul class="insurance-block nav nav-second-level collapse">
                                        <li>
                                            <a id="life_insurance" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>Life Insurance</a>
                                            <ul class="nav nav-second-level collapse">
                                                <?php
                                                if (trim($html_life_insurance) != '') {
                                                    echo $html_life_insurance;
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="health_insurance" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>Health Insurance</a>
                                            <ul class="nav nav-second-level collapse">
                                                <?php
                                                if (trim($html_health_insurance) != '') {
                                                    echo $html_health_insurance;
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="disable_coverage" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>Long-Term Disability Coverage</a>
                                            <ul class="nav nav-second-level collapse">
                                                <?php
                                                if (trim($html_disability_insurance) != '') {
                                                    echo $html_disability_insurance;
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <li>
                                            <a id="auto_insurance" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>Auto Insurance</a>
                                            <ul class="nav nav-second-level collapse">
                                                <?php
                                                if (trim($html_auto_insurance) != '') {
                                                    echo $html_auto_insurance;
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                        if (trim($html_other_insurance) != '') {
                                            echo $html_other_insurance;
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li>
                                    <a id="fd" href="javascript:;"><span class="fa arrow"></span><i class="label label-primary">Add</i>FD</a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php
                                        if (trim($html_fd) != '') {
                                            echo $html_fd;
                                        }
                                        ?>
                                    </ul>
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
                            <?php
                            if (trim($html_property) != '') {
                                echo '<a href="javascript:;"><i class="fa fa-home"></i> <span class="nav-label">Property</span> <span class="fa arrow"></span><span class="pull-right">' . $currency_code . number_format($property_total, 2) . '</span></a>';
                                echo '<ul class="nav nav-second-level collapse">';
                                echo $html_property;
                                echo '</ul>';
                            } else {
                                echo '<a data-toggle="modal" data-dismiss="modal" data-target="#myModal-properties" href="javascript:;"><i class="fa fa-home"></i> <span class="nav-label">Property</span> <span class="fa arrow"></span><span class="pull-right">' . $currency_code . number_format($property_total, 2) . '</span></a>';
                                //#myModal-properties
                                ?>
                                <!--                                        <li>
                                                                            <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-realState" href="javascript:;">House</a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-carvalue" href="javascript:;">Car</a>
                                                                        </li>
                                                                        <li>
                                                                            <a data-toggle="modal" data-dismiss="modal" data-target="#myModal-carvalue" href="javascript:;">Bike</a>
                                                                        </li>    -->
                                <?php
                            }
                            ?>

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
                                    <h2>Net Worth</h2>
                                    <!--  <div id="morris-one-line-chart"></div> -->
                                    <div>
                                        <canvas id="lineChart"></canvas></div>
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
                                    <h2>Net Income </h2>
                                    <div id="morris-bar-chart"></div>
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


<?php
include 'investment_popups.php';
include 'configure_more_popups.php';
$this->load->view('popups/fastlink');
?>

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
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/morris/morris.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/overview.js'); ?>"></script>
<!-- Morris demo data-->
<script>
    $(document).ready(function () {
        $('body').scrollspy({
            target: '.navbar-fixed-top', offset: 80
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
        
        $.getJSON(site_url('overview/graph_data'), {
            action: 'net_income'
        }, function (result) {
            Morris.Bar({
                element: 'morris-bar-chart', data: result, xkey: 'y', ykeys: ['a', 'b'], labels: ['Income', 'Expenses'], hideHover: 'auto', resize: true, barColors: ['#0ac775', '#ef1d3b'],
            });
        });
        
        
        $.getJSON(site_url('overview/graph_data'), {
            action: 'expense'
        }, function (result) {
//            var doughnutData = [{
//                    value: 300, color: "#ffa500", highlight: "#1ab394", label: "Expenses"
//                }, {
//                    value: 50, color: "#1ab394", highlight: "#1ab394", label: "Expenses"
//                }, {
//                    value: 100, color: "#A4CEE8", highlight: "#1ab394", label: "Expenses"
//                }];
            var doughnutOptions = {
                segmentShowStroke: true, segmentStrokeColor: "#fff", segmentStrokeWidth: 2, percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100, animationEasing: "easeOutBounce", animateRotate: true, animateScale: false
            };
            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(result.graph_data, doughnutOptions);
        });




        var lineData = {
            labels: ["January", "February", "March", "April", "May"], datasets: [{
                    label: "Example dataset", fillColor: "rgba(220,220,220,0.0)", strokeColor: "rgba(220,220,220,0)", pointColor: "rgba(220,220,220,0)", pointStrokeColor: "#fff", pointHighlightFill: "#fff", pointHighlightStroke: "rgba(220,220,220,0)", data: [10, 59, 40, 20, 56]
                }, {
                    label: "Example dataset", fillColor: "rgba(26,179,148,0.5)", strokeColor: "rgba(26,179,148,0.7)", pointColor: "rgba(26,179,148,1)", pointStrokeColor: "#fff", pointHighlightFill: "#fff", pointHighlightStroke: "rgba(26,179,148,1)", data: [28, 48, 40, 19, 35]
                }]
        };
        var lineOptions = {
            scaleShowGridLines: true, scaleGridLineColor: "rgba(0,0,0,.05)", scaleGridLineWidth: 1, bezierCurve: true, bezierCurveTension: 0.4, pointDot: true, pointDotRadius: 4, pointDotStrokeWidth: 1, pointHitDetectionRadius: 20, datasetStroke: true, datasetStrokeWidth: 2, datasetFill: true, responsive: true,
        };
        var ctx = document.getElementById("lineChart").getContext("2d");
        var myNewChart = new Chart(ctx).Line(lineData, lineOptions);



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



