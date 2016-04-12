
<section class="signup-complete-msg">
    <div class="container">

        <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                if (isset($otp_matched) && ($otp_matched == 'yes')) {
                    echo '<h2 style="color: green;">Mobile number verified.</h2>';
                } else {
                    echo '<h2 class="mobile-verification"> mobile not verified </h2>';
                }
                ?>
                <h3>Your account has been created Successfully..</h3>
                <label class="error">A verification link has been sent to your email address you provided,
                    <br/>
                    Please check your Inbox/Junk folder and verify your account.</label>
            </div>
        </div>
    </div>

</section>
<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>
                    Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
                </p>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">Company name, Inc.</span></strong>
                    <br/>
                    795 Folsom Ave, Suite 600
                    <br/>
                    San Francisco, CA 94107
                    <br/>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Consectetur adipisicing elit. Aut eaque, totam corporis laboriosam veritatis quis ad perspiciatis, totam corporis laboriosam veritatis, consectetur adipisicing elit quos non quis ad perspiciatis, totam corporis ea,
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:test@email.com" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p>
                    <strong>&copy; 2015 Company Name</strong>
                    <br/>
                    consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.
                </p>
            </div>
        </div>
    </div>
</section>
