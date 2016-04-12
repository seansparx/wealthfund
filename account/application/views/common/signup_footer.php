<!-- Mainly scripts -->
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>"/>
<input type="hidden" id="site_token" value="<?php echo encode(ACCESS_TOKEN); ?>" />

<!-- Custom and plugin javascript -->              
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/user_login.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/forget_password.js'); ?>"></script>


<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/js/inspinia.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/pace/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>

<script>
    $(document).ready(function() {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

    });
    

</script>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function() {
        var widget_id = 'hq3S3U6mRx';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();
    $(window).load(function() {
        setTimeout(function() {

            $('#jivo_container').contents().find('head').append('<style>.jivo-bottom-left-square{background-color: #ffa500 !important;}</style>');
        }, 1000)
    })
</script>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>
