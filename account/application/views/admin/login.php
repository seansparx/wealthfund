<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Wealthfund | Login</title>

        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>

                    <!--                <h1 class="logo-name">IN+</h1>-->

                </div>
                <h3>Welcome to Admin Panel</h3>

                <p>Login in. To see it in action.</p>
                <?php if ($this->session->flashdata('flashdata')) { ?>
                    <div class="">
                        <p class="error" style="color:#368EE0"><i></i><?php echo $this->session->flashdata('flashdata'); ?></p>
                    </div>
                <?php } ?>
                <form class="m-t" method="post" onsubmit="return validationLogin();" role="form" action="<?php echo site_url('admin/login') ?>">
                    <div class="form-group">
                        <div class="username">
                            <input type="text" name='userName' id="userName" value="<?= (isset($remember['userName'])) ? $remember['userName'] : '' ?>" class="form-control" placeholder="Username" >
                            <?php echo form_error('userName'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="password">
                            <input type="password" name='userPassword' id="userPassword" value="<?= (isset($remember['userPassword'])) ? $remember['userPassword'] : '' ?>" class="form-control" placeholder="Password" >
                            <?php echo form_error('userPassword'); ?>
                        </div>
                    </div>


                    <div class="remember">
                        <input type="checkbox" name="remember" class='icheck-me' <?php if (isset($remember)) { ?>checked="" <?php } ?> data-skin="square" data-color="blue" id="remember" value="1">
                        <label for="remember">Remember me</label>
                    </div>
                    <button type="submit" id= "submit" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="<?php echo site_url('admin/login/forgot'); ?>"><small>Forgot password?</small></a>
                </form>
                <p class="m-t"> <small>Wealthfund &copy; <?php echo date('Y'); ?></small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="<?php echo base_url() ?>assets/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    </body>

</html>
