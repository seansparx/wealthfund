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

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Animation CSS -->
        <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    </head>
    <body id="page-top" class="landing-page ">
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
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="page-scroll" href="#page-top">How It Works</a></li>
                            <li><a class="page-scroll" href="#features">Pricing</a></li>
                            <li><a class="page-scroll" href="#team">Must Read</a></li>
                            <li><a class="page-scroll action-link" href="#modal-form" data-toggle="modal"><button type="submit" class="btn btn-primary block full-width ">Log in</button></a></li>
                            <li><a class="page-scroll action-link" href="<?php echo site_url('signup'); ?>"><button type="submit" class="btn btn-primary block full-width ">Sign up</button></a></li>


                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <?php
        $this->load->view('popups/login');
        $this->load->view('popups/activation_code');
        $this->load->view('popups/forget_act_code');
        $this->load->view('popups/forgot_password');
        $this->load->view('popups/signup_otp');
        ?>
        