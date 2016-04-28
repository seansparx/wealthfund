<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Wealthfund | Forgot password</title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>font-awesome/assets/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="passwordBox animated fadeInDown">
            <div class="row">

                <div class="col-md-12">
                    <div class="ibox-content">

                        <h2 class="font-bold">Forgot password</h2>

                        <p>
                            Enter your email address and your password will be reset and emailed to you.
                        </p>

                        <div class="row">

                            <div class="col-lg-12">
                                <form action="" method="post" id="form-forgot" class="m-t" role="form">
                                    <div class="form-group">
                                        <input type="text" name="email_id" maxlength="100" class="form-control" placeholder="Email address">
                                    </div>

                                    <button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
                                    <a href="<?php echo site_url('admin/login'); ?>" class="btn btn-default block full-width m-b">Back to Login</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    Copyright Wealthfund
                </div>
                <div class="col-md-6 text-right">
                    <small>© <?php echo date('Y'); ?></small>
                </div>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/admin/login.js') ?>"></script>
        <script>
            validate_forgot_form();

            function validate_forgot_form()
            {
                $("#form-forgot").validate({
                    // Specify the validation rules
                    rules: {
                        email_id: {
                            required: true,
                            email: true
                        }
                    },
                    // Specify the validation error messages
                    messages: {
                        email_id: {
                            required: "Enter your email address."
                        }
                    },
                    errorPlacement: function (error, element) {
                        //var el_id = $(element).attr('id');
                        error.insertAfter(element);
                    },
                    success: function (label, element) {
                        //console.log(element.id);
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            }
        </script>
    </body>

</html>
