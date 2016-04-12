<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Wealth Fund Welcome Page</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Animation CSS -->
        <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/plugins/iCheck/custom.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>


    </head>
    <body id="page-top" class="landing-page bank-account-list">
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
                        <a class="navbar-brand" href="<?php echo site_url('../'); ?>">Wealth Fund</a>
                    </div>
                    <?php if ($this->session->userdata['wealthfund_session']['wealthfund_user_id']) { ?>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right logout-wrap">
                                <li>
                                    <a href="#">Get Help</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>login/logout"> <i class="fa fa-sign-out"></i> Log out </a>
                                </li>
                            </ul>
                            <span class="wellcome-msg">Welcome <?php echo $this->session->userdata['wealthfund_session']['wealthfund_name']; ?></span>
                        </div>
                    <?php
                    }
                    
                    ?>
                    
                </div>
            </nav>
        </div>
