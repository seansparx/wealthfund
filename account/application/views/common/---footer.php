<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">Company name, Inc.</span></strong><br/>
                    795 Folsom Ave, Suite 600<br/>
                    San Francisco, CA 94107<br/>
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
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2015 Company Name</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
    </div>
</section>
<!-- chat window start -->
		<div class="small-chat-box fadeInRight animated">

			<div class="heading" draggable="true">
				<small class="chat-date pull-right"> 02.19.2015 </small>
				Small chat
			</div>

			<div class="content">

				<div class="left">
					<div class="author-name">
						Monica Jackson <small class="chat-date"> 10:02 am </small>
					</div>
					<div class="chat-message active">
						Lorem Ipsum is simply dummy text input.
					</div>

				</div>
				<div class="right">
					<div class="author-name">
						Mick Smith
						<small class="chat-date"> 11:24 am </small>
					</div>
					<div class="chat-message">
						Lorem Ipsum is simpl.
					</div>
				</div>
				<div class="left">
					<div class="author-name">
						Alice Novak
						<small class="chat-date"> 08:45 pm </small>
					</div>
					<div class="chat-message active">
						Check this stock char.
					</div>
				</div>
				<div class="right">
					<div class="author-name">
						Anna Lamson
						<small class="chat-date"> 11:24 am </small>
					</div>
					<div class="chat-message">
						The standard chunk of Lorem Ipsum
					</div>
				</div>
				<div class="left">
					<div class="author-name">
						Mick Lane
						<small class="chat-date"> 08:45 pm </small>
					</div>
					<div class="chat-message active">
						I belive that. Lorem Ipsum is simply dummy text.
					</div>
				</div>

			</div>
			<div class="form-chat">
				<div class="input-group input-group-sm">
					<input type="text" class="form-control">
					<span class="input-group-btn">
						<button
						class="btn btn-primary" type="button">
							Send
						</button> </span>
				</div>
			</div>

		</div>
		<div id="small-chat">

			<span class="badge badge-warning pull-right">5</span>
			<a class="open-small-chat"> <i class="fa fa-comments"></i> </a>
		</div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
<input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />
<input type="hidden" id="site_token" value="<?php echo encode(ACCESS_TOKEN); ?>" />
<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/signup.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/user_login.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/forget_password.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/inspinia.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/pace/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/wow/wow.min.js'); ?>"></script>

<!-- ChartJS-->
		<script src="<?php echo base_url('account/assets/js/plugins/chartJs/Chart.min.js'); ?>"></script>
	<script>
			$(document).ready(function() {

				$('body').scrollspy({
					target : '.navbar-fixed-top',
					offset : 80
				});

				// Page scrolling feature
				$('a.page-scroll').bind('click', function(event) {
					var link = $(this);
					$('html, body').stop().animate({
						scrollTop : $(link.attr('href')).offset().top - 50
					}, 500);
					event.preventDefault();
					$("#navbar").collapse('hide');
				});

				//================== script for graph ===========================

				getChart();

			});

			var cbpAnimatedHeader = (function() {
				var docElem = document.documentElement, header = document.querySelector('.navbar-default'), didScroll = false, changeHeaderOn = 200;
				function init() {
					window.addEventListener('scroll', function(event) {
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

			var myNewChart = '';

			var labelArray = [0, 15, 25, 40, 55, 65];

			var datasetArray = [0, 1200, 2500, 5000, 2000, 1000];

			var labeldatasetArray = [0, 1000, 2000, 3500, 3100, 1600];

			function getChart() {

				var lineData = {
					labels : labelArray,
					datasets : [{
						label : "Example dataset",
						fillColor : "rgba(204,134,20,1)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(220,220,220,1)",
						//data : [65, 59, 40, 51, 36, 25, 40]
						data : datasetArray
					}, {
						label : "Example dataset",
						fillColor : "rgba(26,179,148,1)",
						strokeColor : "rgba(26,179,148,0.7)",
						pointColor : "rgba(26,179,148,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(26,179,148,1)",
						//data : [48, 48, 60, 39, 56, 37, 30]
						data : labeldatasetArray
					}]
				};

				var lineOptions = {
					scaleShowGridLines : true,
					scaleGridLineColor : "rgba(0,0,0,.05)",
					scaleGridLineWidth : 1,
					bezierCurve : false,
					bezierCurveTension : 0.4,
					pointDot : true,
					pointDotRadius : 4,
					pointDotStrokeWidth : 1,
					pointHitDetectionRadius : 20,
					datasetStroke : true,
					datasetStrokeWidth : 2,
					datasetFill : true,
					responsive : true,
				};

				var ctx = document.getElementById("lineChart").getContext("2d");
				myNewChart = new Chart(ctx).Line(lineData, lineOptions);
			}

			function updateChart() {

				labelArray = [0, 15, 25, 40, 55, 65];
				datasetArray = [];
				labeldatasetArray = [];
				//
				var age = $('.age input').val();
				var retirement = $('.retirement input').val();
				//
				if (age <= 65 && age >= 0 && age != '') {
					labelArray.push(age);
					labelArray.sort(function(a, b) {
						return a - b
					});

				}

				//
				for (var i = 0; i < labelArray.length; i++) {

					datasetArray.push(labelArray[i] * retirement);
					labeldatasetArray.push((labelArray[i] * retirement) + 1200);
					myNewChart.removeData();
				}

	

				for (var i = 0; i < labelArray.length; i++) {
					myNewChart.addData([datasetArray[i], labeldatasetArray[i]], labelArray[i]);

				}
				myNewChart.update();
			}
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
