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
        <link href="<?php echo base_url('assets/css/plugins/chosen/chosen.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
        
        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js'); ?>"></script>

    </head>
    <body id="page-top" class="landing-page sign-up-page">
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

                </div>
            </nav>
        </div>

        <section class="sign-up-form-wrap">
            <div class="middle-box text-center loginscreen signup-screen  animated fadeInDown">
                <div>
                    <h3>Register to Wealth Fund</h3>
                    <p>
                        Create account to see it in action.
                    </p>
                    <?php
                    echo form_open('', array('method' => 'post', 'name' => 'user_signup', 'id' => 'user_signup', 'class' => 'm-t'));
                    ?>
                    <div class="form-group">
                        <?php
                        $data = array(
                            'name' => 'user_email',
                            'id' => 'user_email',
                            'placeholder' => 'Email Address',
                            'class' => 'form-control',
                            'value' => set_value('user_email')
                        );

                        echo form_input($data);
                        echo form_error('user_email');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $data = array(
                            'name' => 'password',
                            'id' => 'password',
                            'placeholder' => 'Password',
                            'class' => 'form-control',
                            'value' => set_value('password')
                        );

                        echo form_password($data);
                        echo form_error('password');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $data = array(
                            'name' => 'passconf',
                            'id' => 'passconf',
                            'placeholder' => 'Repeat Password',
                            'class' => 'form-control',
                            'value' => set_value('passconf')
                        );

                        echo form_password($data);
                        echo form_error('passconf');
                        ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5 country-code title-name">
                                <?php
                                $attrs = array(
                                    'name' => 'country_code',
                                    'id' => 'country_code',
                                    'class' => 'form-control chosen-select'
                                );
                                $options = $country_codes;
                                echo form_dropdown($attrs, $options, set_value('country_code'));
                                echo form_error('country_code');
                                ?>
                            </div>
                            <div class="col-sm-7 mobile-number ">
                                <?php
                                $data = array(
                                    'name' => 'user_mobile',
                                    'id' => 'user_mobile',
                                    'placeholder' => 'Mobile Number',
                                    'class' => 'form-control',
                                    'value' => set_value('user_mobile')
                                );
                                echo form_input($data);
                                echo form_error('user_mobile');
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 title-name">
                                <?php
                                $attrs = array(
                                    'name' => 'prefix',
                                    'id' => 'prefix',
                                    'class' => 'form-control chosen-select-sex'
                                );
                                $options = array('Mr' => 'Mr', 'Mrs' => 'Mrs');
                                echo form_dropdown($attrs, $options, set_value('prefix'));
                                echo form_error('prefix');
                                ?>
                            </div>
                            <div class="col-sm-8 user-name ">
                                <?php
                                $data = array(
                                    'name' => 'full_name',
                                    'id' => 'full_name',
                                    'placeholder' => 'Full Name',
                                    'class' => 'form-control',
                                    'value' => set_value('full_name')
                                );
                                echo form_input($data);
                                echo form_error('full_name');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <div class="checkbox i-checks">
                            <label>

                                <input name="terms" id="terms" type="checkbox" style="position: absolute; opacity: 0;">
                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                <i></i> Agree to the terms and conditions </label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Captcha HTML Code -->	
                        <div id="captcha-wrap">
                                <div class="captcha-box">
                                    <img src="<?php echo base_url('assets/captcha/get_captcha.php'); ?>" alt="" id="captcha" />
                                </div>
                                <div class="text-box">
                                        <label>Type the two words:</label>
                                        <?php
                                            $data = array(
                                                'name' => 'captcha_code',
                                                'id' => 'captcha_code',
                                                'class' => 'form-control',
                                                'value' => '' );
                                            echo form_input($data);
                                            echo form_error('captcha_code');
                                        ?>
                                </div>
                                <div class="captcha-action col-md-3 col-sm-4">
                                    <a><i id="captcha-refresh" class="fa fa-refresh"></i></a>
<!--                                        <img src="<?php //echo base_url('assets/captcha/refresh.jpg'); ?>"  alt=""  />-->
                                </div>
                        </div>
                    </div>
                    <button type="submit" name="submit_signup" id="submit_signup" class="btn btn-primary block full-width m-b">
                        Register
                    </button>
                    <p class="text-muted text-center">
                        <small>Already have an account?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block"  data-toggle="modal" onclick="javascript:loginModalShow();" href="#">Login</a>

                    <a href="#"  class="activation_code"  data-toggle="modal" data-target="#myModal_actCode"> Have activation code, click here</a>

                    <?php
                    echo form_close();
                    ?>

                </div>
            </div>
        </section>


        <!-- Mainly scripts -->
        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
        <input type="hidden" id="site_url" value="<?php echo site_url(); ?>"/>
        <!-- Custom and plugin javascript -->                
        <script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/signup.js'); ?>"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url('assets/js/inspinia.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/pace/pace.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script type="text/javascript">
                        var config = {
                            '.chosen-select': {no_results_text: "Oops, nothing found!"},
                            '.chosen-select-sex': {disable_search_threshold: 10}
                        }
                        for (var selector in config) {
                            $(selector).chosen(config[selector]);
                        }
        </script>

        <script>
            $(document).ready(function () {

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

            });

        </script>
        
        <!----- Javascript for Re Captcha ---->
        <script>
        $(document).ready(function() { 

         // refresh captcha
         $('i#captcha-refresh').click(function() {  

                        change_captcha();
         });

         function change_captcha()
         {
                document.getElementById('captcha').src="assets/captcha/get_captcha.php?rnd=" + Math.random();
         }

        });

        </script>


    </body>
</html>
