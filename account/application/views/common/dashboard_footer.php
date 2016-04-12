<?php $this->load->view('popups/fastlink'); ?>

<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>"/>
<input type="hidden" id="site_token" value="<?php echo site_token(); ?>" />
<input type="hidden" id="default_currency" value="<?php echo currency_symbol(); ?>" />

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

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function () {
        var widget_id = 'hq3S3U6mRx';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();
    $(window).load(function () {
        setTimeout(function () {

            $('#jivo_container').contents().find('head').append('<style>.jivo-bottom-left-square{background-color: #ffa500 !important;}</style>');
        }, 1000)
    })
</script>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>