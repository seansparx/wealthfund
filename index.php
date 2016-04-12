<?php  
    include_once 'constant.php'; 
    session_start();
//    echo '<pre>';
//    print_r($_SESSION);
//    die;
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
    <link href="account/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
   <link href="account/assets/css/animate.css" rel="stylesheet">
   <link href="account/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="account/assets/css/style.css" rel="stylesheet">
    <link href="account/assets/css/custom.css" rel="stylesheet"> 
    <script>
    var siteurl = "<?php echo BASE_URL; ?>";  
    
    </script>
</head>
<body id="page-top" class="landing-page">
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
						<a class="navbar-brand" href="http://10.0.4.4/CSS5134/">Wealth Fund</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a class="page-scroll" href="#page-top">How It Works</a>
							</li>
							<li>
								<a class="page-scroll" href="#features">Pricing</a>
							</li>
							<li>
								<a class="page-scroll" href="#team">Must Read</a>
							</li>
							<li>
								<a class="page-scroll action-link" data-toggle="modal" href="#modal-form"><button type="submit" class="btn btn-primary block full-width ">Log in</button></a>
							</li>
							<li>
								<a class="page-scroll action-link" href="account/signup"><button type="submit" class="btn btn-primary block full-width ">Sign up</button></a>
							</li>

						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#inSlider" data-slide-to="0" class="active"></li>
				<li data-target="#inSlider" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<div class="container">
						<div class="carousel-caption">
							<h1>We craft
							<br/>
							brands, web apps,
							<br/>
							and user interfaces
							<br/>
							we are IN+ studio</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing.
							</p>
							<p>
								<a class="btn btn-lg btn-primary" href="#" role="button">READ MORE</a>
								<a class="caption-link" href="#" role="button">Inspinia Theme</a>
							</p>
						</div>
						<!-- <div class="carousel-image wow zoomIn">
						<img src="../assets/img/landing/laptop.png" alt="laptop"/>
						</div> -->
					</div>
					<!-- Set background for slide in css -->
					<div class="header-back two"></div>

				</div>
				<div class="item">
					<div class="container">
						<div class="carousel-caption blank">
							<h1>We create meaningful
							<br/>
							interfaces that inspire.</h1>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam.
							</p>
							<p>
								<a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a>
							</p>
						</div>
					</div>
					<!-- Set background for slide in css -->
					<div class="header-back two"></div>
				</div>
			</div>
			<a class="left carousel-control" href="#inSlider" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
			<a class="right carousel-control" href="#inSlider" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
		</div>
		<section class="investment-plan">
			<h1>Pay Less Fees and Retire Soon</h1>
			<div class="container">
				<div class="row">
					<div class="col-lg-12  wow fadeInLeft">
						<form>
							<p>
								I am<span class="age">
									<input type="text" />
								</span>
								years old and
								want to start a SIP with <span>Rs.</span>
								<span class="retirement">
									<input type="text" />
								</span>a month for my Retirement.
							</p>
							<div>
								<canvas id="lineChart" height="114"></canvas>
							</div>
							<div class="plan-desc">
								<p>
									Over the long term, the typical mutual fund’s fees of 2.2% will really add up. We invest your money in Direct Plans of Mutual
									funds only. Month after month, your WealthFund investment will do more for you, for a lot less.
								</p>
								<a href="javascript:void(0)" onclick="updateChart()" class="btn btn-primary">Get Started</a>
								<!-- 								<input class="btn btn-primary" type="submit" value=" Get Started " /> -->
							</div>

						</form>
					</div>
				</div>

			</div>

		</section>
		<section id="features" class="container services">
			<div class="row">
				<div class="col-sm-3">
					<h2>Full responsive</h2>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
					</p>
					<p>
						<a class="navy-link" href="#" role="button">Details &raquo;</a>
					</p>
				</div>
				<div class="col-sm-3">
					<h2>LESS/SASS Files</h2>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
					</p>
					<p>
						<a class="navy-link" href="#" role="button">Details &raquo;</a>
					</p>
				</div>
				<div class="col-sm-3">
					<h2>6 Charts Library</h2>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
					</p>
					<p>
						<a class="navy-link" href="#" role="button">Details &raquo;</a>
					</p>
				</div>
				<div class="col-sm-3">
					<h2>Advanced Forms</h2>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
					</p>
					<p>
						<a class="navy-link" href="#" role="button">Details &raquo;</a>
					</p>
				</div>
			</div>
		</section>

		<section  class="container features">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="navy-line"></div>
					<h1>Over 40+ unique view
					<br/>
					<span class="navy"> with many custom components</span></h1>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 text-center wow fadeInLeft">
					<div>
						<i class="fa fa-mobile features-icon"></i>
						<h2>Full responsive</h2>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
						</p>
					</div>
					<div class="m-t-lg">
						<i class="fa fa-bar-chart features-icon"></i>
						<h2>6 Charts Library</h2>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
						</p>
					</div>
				</div>
				<div class="col-md-6 text-center  wow zoomIn">
					<img src="account/assets/img/landing/perspective.png" alt="dashboard" class="img-responsive">
				</div>
				<div class="col-md-3 text-center wow fadeInRight">
					<div>
						<i class="fa fa-envelope features-icon"></i>
						<h2>Mail pages</h2>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
						</p>
					</div>
					<div class="m-t-lg">
						<i class="fa fa-google features-icon"></i>
						<h2>AngularJS version</h2>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="navy-line"></div>
					<h1>Discover great feautres</h1>
					<p>
						Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
					</p>
				</div>
			</div>
			<div class="row features-block">
				<div class="col-lg-6 features-text wow fadeInLeft">
					<small>INSPINIA</small>
					<h2>Perfectly designed </h2>
					<p>
						INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.
					</p>
					<a href="" class="btn btn-primary">Learn more</a>
				</div>
				<div class="col-lg-6 text-right wow fadeInRight">
					<img src="account/assets/img/landing/dashboard.png" alt="dashboard" class="img-responsive pull-right">
				</div>
			</div>

		</section>

		<section id="team" class="gray-section team">
			<div class="container">
				<div class="row m-b-lg">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>Our Team</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 wow fadeInLeft">
						<div class="team-member">
							<img src="account/assets/img/landing/avatar3.jpg" class="img-responsive img-circle img-small" alt="">
							<h4><span class="navy">Amelia</span> Smith</h4>
							<p>
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
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
					<div class="col-sm-4">
						<div class="team-member wow zoomIn">
							<img src="account/assets/img/landing/avatar1.jpg" class="img-responsive img-circle" alt="">
							<h4><span class="navy">John</span> Novak</h4>
							<p>
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
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
					<div class="col-sm-4 wow fadeInRight">
						<div class="team-member">
							<img src="account/assets/img/landing/avatar2.jpg" class="img-responsive img-circle img-small" alt="">
							<h4><span class="navy">Peter</span> Johnson</h4>
							<p>
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
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
				</div>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.
						</p>
					</div>
				</div>
			</div>
		</section>

		<section class="features">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>Even more great feautres</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
						</p>
					</div>
				</div>
				<div class="row features-block">
					<div class="col-lg-3 features-text wow fadeInLeft">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.
						</p>
						<a href="" class="btn btn-primary">Learn more</a>
					</div>
					<div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
						<img src="account/assets/img/landing/iphone.jpg" class="img-responsive" alt="dashboard">
					</div>
					<div class="col-lg-3 features-text text-right wow fadeInRight">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.
						</p>
						<a href="" class="btn btn-primary">Learn more</a>
					</div>
				</div>
			</div>

		</section>

		<section class="timeline gray-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>Our workflow</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
						</p>
					</div>
				</div>
				<div class="row features-block">

					<div class="col-lg-12">
						<div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon navy-bg">
									<i class="fa fa-briefcase"></i>
								</div>

								<div class="vertical-timeline-content">
									<h2>Meeting</h2>
									<p>
										Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
									</p>
									<a href="#" class="btn btn-xs btn-primary"> More info</a>
									<span class="vertical-date"> Today
										<br/>
										<small>Dec 24</small> </span>
								</div>
							</div>

							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon navy-bg">
									<i class="fa fa-file-text"></i>
								</div>

								<div class="vertical-timeline-content">
									<h2>Decision</h2>
									<p>
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.
									</p>
									<a href="#" class="btn btn-xs btn-primary"> More info</a>
									<span class="vertical-date"> Tomorrow
										<br/>
										<small>Dec 26</small> </span>
								</div>
							</div>

							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon navy-bg">
									<i class="fa fa-cogs"></i>
								</div>

								<div class="vertical-timeline-content">
									<h2>Implementation</h2>
									<p>
										Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
									</p>
									<a href="#" class="btn btn-xs btn-primary"> More info</a>
									<span class="vertical-date"> Monday
										<br/>
										<small>Jan 02</small> </span>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>

		</section>

		<section id="testimonials" class="navy-section testimonials" style="margin-top: 0">

			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center wow zoomIn">
						<i class="fa fa-comment big-icon"></i>
						<h1> What our users say </h1>
						<div class="testimonials-text">
							<i>"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."</i>
						</div>
						<small> <strong>12.02.2014 - Andy Smith</strong> </small>
					</div>
				</div>
			</div>

		</section>

		<section class="comments gray-section" style="margin-top: 0">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>What our partners say</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada.
						</p>
					</div>
				</div>
				<div class="row features-block">
					<div class="col-lg-4">
						<div class="bubble">
							"Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
						</div>
						<div class="comments-avatar">
							<a href="" class="pull-left"> <img alt="image" src="account/assets/img/landing/avatar3.jpg"> </a>
							<div class="media-body">
								<div class="commens-name">
									Andrew Williams
								</div>
								<small class="text-muted">Company X from California</small>
							</div>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="bubble">
							"Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
						</div>
						<div class="comments-avatar">
							<a href="" class="pull-left"> <img alt="image" src="account/assets/img/landing/avatar1.jpg"> </a>
							<div class="media-body">
								<div class="commens-name">
									Andrew Williams
								</div>
								<small class="text-muted">Company X from California</small>
							</div>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="bubble">
							"Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
						</div>
						<div class="comments-avatar">
							<a href="" class="pull-left"> <img alt="image" src="account/assets/img/landing/avatar2.jpg"> </a>
							<div class="media-body">
								<div class="commens-name">
									Andrew Williams
								</div>
								<small class="text-muted">Company X from California</small>
							</div>
						</div>
					</div>

				</div>
			</div>

		</section>

		<section class="features">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>More and more extra great feautres</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-lg-offset-1 features-text">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<i class="fa fa-bar-chart big-icon pull-right"></i>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.
						</p>
					</div>
					<div class="col-lg-5 features-text">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<i class="fa fa-bolt big-icon pull-right"></i>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-lg-offset-1 features-text">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<i class="fa fa-clock-o big-icon pull-right"></i>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.
						</p>
					</div>
					<div class="col-lg-5 features-text">
						<small>INSPINIA</small>
						<h2>Perfectly designed </h2>
						<i class="fa fa-users big-icon pull-right"></i>
						<p>
							INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.
						</p>
					</div>
				</div>
			</div>

		</section>
		<section id="pricing" class="pricing">
			<div class="container">
				<div class="row m-b-lg">
					<div class="col-lg-12 text-center">
						<div class="navy-line"></div>
						<h1>App Pricing</h1>
						<p>
							Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 wow zoomIn">
						<ul class="pricing-plan list-unstyled">
							<li class="pricing-title">
								Basic
							</li>
							<li class="pricing-desc">
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
							</li>
							<li class="pricing-price">
								<span>$16</span> / month
							</li>
							<li>
								Dashboards
							</li>
							<li>
								Projects view
							</li>
							<li>
								Contacts
							</li>
							<li>
								Calendar
							</li>
							<li>
								AngularJs
							</li>
							<li>
								<a class="btn btn-primary btn-xs" href="#">Signup</a>
							</li>
						</ul>
					</div>

					<div class="col-lg-4 wow zoomIn">
						<ul class="pricing-plan list-unstyled selected">
							<li class="pricing-title">
								Standard
							</li>
							<li class="pricing-desc">
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
							</li>
							<li class="pricing-price">
								<span>$22</span> / month
							</li>
							<li>
								Dashboards
							</li>
							<li>
								Projects view
							</li>
							<li>
								Contacts
							</li>
							<li>
								Calendar
							</li>
							<li>
								AngularJs
							</li>
							<li>
								<strong>Support platform</strong>
							</li>
							<li class="plan-action">
								<a class="btn btn-primary btn-xs" href="#">Signup</a>
							</li>
						</ul>
					</div>

					<div class="col-lg-4 wow zoomIn">
						<ul class="pricing-plan list-unstyled">
							<li class="pricing-title">
								Premium
							</li>
							<li class="pricing-desc">
								Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
							</li>
							<li class="pricing-price">
								<span>$160</span> / month
							</li>
							<li>
								Dashboards
							</li>
							<li>
								Projects view
							</li>
							<li>
								Contacts
							</li>
							<li>
								Calendar
							</li>
							<li>
								AngularJs
							</li>
							<li>
								<a class="btn btn-primary btn-xs" href="#">Signup</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row m-t-lg">
					<div class="col-lg-8 col-lg-offset-2 text-center m-t-lg">
						<p>
							*Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. <span class="navy">Various versions</span> have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						</p>
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
		
<input type="hidden" id="base_url" value="<?php echo BASE_URL; ?>" />
<input type="hidden" id="site_url" value="<?php echo BASE_URL; ?>" /> 

		<!-- chat window start -->

		<!-- Mainly scripts -->
		<script src="account/assets/js/jquery-2.1.1.js"></script>
		<script src="account/assets/js/jquery.validate.min.js"></script>
		<script src="account/assets/js/bootstrap.min.js"></script>
		<script src="account/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="account/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="account/assets/js/sha512.js"></script>   
		<script src="account/assets/js/user_login.js"></script>
		<script src="account/assets/js/forget_password.js"></script>
		<script src="account/assets/js/inspinia.js"></script>
		<script src="account/assets/js/plugins/pace/pace.min.js"></script>
		<script src="account/assets/js/plugins/wow/wow.min.js"></script>
		
		<?php               
        include_once 'popups/login.php';
        include_once 'popups/forgot_password.php';
		?>

		<!-- ChartJS-->
		<script src="account/assets/js/plugins/chartJs/Chart.min.js"></script>

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
