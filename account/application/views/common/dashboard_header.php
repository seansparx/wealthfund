<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Wealth Fund Welcome Page</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url('assets/css/plugins/dataTables/datatables.min.css');?>" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Animation CSS -->
        <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url('assets/js/inspinia.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/pace/pace.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/wow/wow.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/js/header.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/js/plugins/chartJs/Chart.min.js'); ?>"></script>
        <!-- Toastr -->
        <script src="<?php echo base_url('assets/js/plugins/toastr/toastr.min.js'); ?>"></script>
    </head>
    <body id="page-top" class="landing-page dashboard-page">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('overview'); ?>">Wealth Fund</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="<?php echo site_url('overview'); ?>">Overview</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="<?php echo site_url('bankaccounts'); ?>">bank accounts</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="<?php echo site_url('transactions'); ?>">transactions</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#">Goals</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#">Reports</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#">Investments</a>
                        </li>
                        <?php
                        if ($this->session->userdata['wealthfund_session']['wealthfund_user_id']) {
                            ?>
                            <li>
                                <a class="page-scroll action-link" href="<?php echo site_url('login/logout'); ?>">
                                    <button type="submit" class="btn btn-primary block full-width ">
                                        Log Out
                                    </button>
                                </a>
                            </li>    
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>