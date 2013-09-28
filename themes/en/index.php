<?php
	include_once("./config.php");
	include_once("./classes/functions.php");
	include_once("./classes/database.php");
	include_once("./classes/seo.php");
	$seo = Seo::GetSeo();
	$db = Database::GetDatabase();
	
  	$news = $db->SelectAll("news","*",null,"id ASC");
  	$works = $db->SelectAll("works","*",null,"id ASC");
  	$gallery = $db->SelectAll("gallery","*",null,"id DESC");
	$category = $db->SelectAll("category","*",null,"id ASC");

	$name_latin = GetSettingValue('Dr_Name_Latin',0);
	$specialty_latin  = GetSettingValue('Dr_Specialty_Latin',0);
	$about_latin = GetSettingValue('About_System_Latin',0);

	$Contact_Email = GetSettingValue('Contact_Email',0);
	$FaceBook_Add = GetSettingValue('FaceBook_Add',0);
	$Twitter_Add = GetSettingValue('Twitter_Add',0);
	$Rss_Add = GetSettingValue('Rss_Add',0);
	$Gplus_Add = GetSettingValue('Gplus_Add',0);
	$Latin_Tell_Number = GetSettingValue('Latin_Tell_Number',0);
	$Latin_Fax_Number = GetSettingValue('Latin_Fax_Number',0);
	$Latin_Address = GetSettingValue('Latin_Address',0);
	$Dr_Pic = GetSettingValue('Dr_Pic',0);

$html=<<<cd
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>{$seo->Latin_Site_Title}</title>

	<meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="UTF-8">
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="description" content="{$seo->Latin_Site_Describtion}">
	<meta name="keywords" content="{$seo->Latin_Site_KeyWords}">
	<meta http-equiv="Content-Language" content="En">
	<meta http-equiv="Designer" content="Mediateq">
	<meta name="Generator" content="Mediateq">
	<meta name="Author" content="Mediateq">

	<link rel="icon" href="themes/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="themes/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="themes/en/skeleton.css" />
	<link rel="stylesheet" type="text/css" href="themes/css/jquery.jscrollpane.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/prettyPhoto.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/jquery.qtip.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/en/style.css" media="all" />

	<script src="themes/js/jquery.min.js" type="text/javascript"></script>
	<script src="themes/js/jms.js" type="text/javascript"></script>
	<script src="themes/js/jmpress.js" type="text/javascript"></script>
	<script src="themes/js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="themes/js/detectmobilebrowser.js" type="text/javascript"></script>
	<script src="themes/js/mousewheel.js" type="text/javascript"></script>
	<script src="themes/en/js/jquery.jscrollpane.js" type="text/javascript"></script>
	<script src="themes/js/jquery.quicksand.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyPhoto.js" type="text/javascript"></script>
	<script src="themes/js/jquery.qtip.min.js" type="text/javascript"></script>
	<script src="themes/js/jquery.mobilegmap.min.js" type="text/javascript"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false" type="text/javascript"></script>
	<script src="themes/js/contact_form.js" type="text/javascript"></script>
	<script src="themes/en/js/scripts.js" type="text/javascript"></script>
	<script src="themes/js/modernizr.custom.48780.js" type="text/javascript"></script>

	<!--[if lt IE 7]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
   		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <noscript>
		<style>
			.step {				
				position: relative;
			}
			.step:not(.active) {
				opacity: 1;
				filter: alpha(opacity=99);
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=99)";
			}
			.step:not(.active) a.jms-link{
				opacity: 1;
				margin-top: 40px;
			}
		</style>
    </noscript>
</head>
<body>
	<!-- Container -->
	<div class="container">
		<!-- Header part -->
		<header>
			<div class="sixteen columns">
                <div class="My_name">
	                <h1>{$name_latin}</h1> 
	                <h3>{$specialty_latin}</h3>
                </div>
                <div class="flags">
                	<a href="#" class="tip" title="English"><img src="themes/images/england-flag.png" alt="english"></a>
                	<a href="#" class="tip" title="Persian"><img src="themes/images/iran-flag.png" alt="persian"></a>
                </div>
                <nav id="menu" class="sixteen columns">
                	<ul id="nav">
                		<li class="active"><a href="#home">Home</a></li>
                		<li><a href="#resume">Resume</a></li>
                		<li><a href="#services">Services</a></li>
                		<li><a href="#portfolio">Gallery</a></li>
                		<li><a href="#contact">Contact</a></li>
                	</ul>
                	<!-- Dropdown menu for mobile -->
                	<select id="dd_menu">
                		<option value="#home">Home</option>
                		<option value="#resume">Resume</option>
                		<option value="#services">Services</option>
                		<option value="#portfolio">Gallery</option>
                		<option value="#contact">Contact</option>
                	</select>
                	<!-- END Dropdown menu for mobile -->
                </nav>
           </div>
		</header>
		<!-- END Header part -->
		<!-- Middle part -->
		<section id="jms-slideshow" class="jms-slideshow sixteen columns">
			<!-- Home part -->
			<div id="home" class="step" data-x="6000" data-y="1600" data-rotate="0" data-scale="15">
				<div id="jms-content">
					<div class="five columns">
						<div class="block">
							<div class="portrait">
								<img src="{$Dr_Pic}" alt="Dr Sadri">
							</div>
						</div>
					</div>
					<div class="six columns">
						<div class="block">
							<div class="general_info">
								<h3>{$name_latin} ({$specialty_latin})</h3>
								<p class="small">{$about_latin}</p>
							</div>
							<div class="social_icons">
								<h3>Follow Me on</h3>
								<ul class="social">
									<li><a href="#" class="tip" title="Twitter"><img src="themes/images/twitter.png" alt="twitter"></a></li>
									<li><a href="#" class="tip" title="Dribbble"><img src="themes/images/dribbble.png" alt="dribbble"></a></li>
									<li><a href="#" class="tip" title="Lastfm"><img src="themes/images/lastfm.png" alt="lastfm"></a></li>
									<li><a href="#" class="tip" title="Google Plus"><img src="themes/images/googleplus.png" alt="googleplus"></a></li>
									<li><a href="#" class="tip" title="Youtube"><img src="themes/images/youtube.png" alt="youtube"></a></li>
									<li><a href="#" class="tip" title="Skype"><img src="themes/images/skype.png" alt="skype"></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="five columns">
						<div class="block end">
							<ul class="personal-info">
								<li>
									<span class="title">Name</span>
									<span class="value">{$name_latin}</span>
								</li>
								<li>
									<span class="title">Address</span>
									<span class="value">{$Latin_Address}</span>
								</li>
								<li>
									<span class="title">E-mail</span>
									<span class="value small latinfont"><a href="mailto:{$Contact_Email}">{$Contact_Email}</a></span>
								</li>
								<li>
									<span class="title medium">Tel</span>
									<span class="value small tel">{$Latin_Tell_Number}</span>
								</li>
								<li>
									<span class="title medium">Fax</span>
									<span class="value small fax">{$Latin_Fax_Number}</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END Home part -->
			<!-- Resume part -->
			<div id="resume" class="step" data-x="18000" data-y="2800" data-rotate="-30" data-scale="5">
				<div id="jms-content2">
					<div class="one-third column">
						<div class="block">
							<div class="title">
								<h2>Articles</h2>
							</div>
							<div class="detailsCol">
								<ul class="employment_ul">
cd;
								for ($i=0; $i < count($works) ; $i++) {
									if($works[$i]['group']==1){
										$date = $works[$i]['date'];
$html.=<<<cd
									<li>
										<span class="date">{$date}</span>
										<h3>{$works[$i]['latin-subject']}</h3>
										<p>{$works[$i]['latin-body']}</p>
									</li>
cd;
								}}
$html.=<<<cd
								</ul>
							</div>
						</div>
					</div>
					<div class="one-third column">
						<div class="block">
							<div class="title">
								<h2>Conferences</h2>
							</div>
							<div class="detailsCol">
								<ul class="employment_ul">
cd;
								for ($i=0; $i < count($works) ; $i++) {
									if($works[$i]['group']==2){
										$date = $works[$i]['date'];
$html.=<<<cd
									<li>
										<span class="date">{$date}</span>
										<h3>{$works[$i]['latin-subject']}</h3>
										<p>{$works[$i]['latin-body']}</p>
									</li>
cd;
								}}
$html.=<<<cd
								</ul>
							</div>
						</div>
					</div>
					<div class="one-third column omega">
						<div class="block">
							<div class="title">
								<h2>Academic titles</h2>
							</div>
							<div class="detailsCol">
								<ul>
cd;
								for ($i=0; $i < count($works) ; $i++) {
									if($works[$i]['group']==3){
										$date = $works[$i]['date'];
$html.=<<<cd
									<li>
										<span class="date">{$date}</span>
										<h3>{$works[$i]['latin-subject']}</h3>
										<p>{$works[$i]['latin-body']}</p>
									</li>
cd;
								}}
$html.=<<<cd
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Resume part -->
			<!-- Service part -->
			<div id="services" class="step" data-x="22000" data-y="2800" data-rotate="30" data-scale="3">
				<div id="jms-content3">
					<div class="sixteen columns">
						<div class="block2">
							<div class="services clearfix">
cd;
								$i=1;
								foreach($news as $val){
									
$html.=<<<cd
									<div class="four columns omega">
										<div class="service">
cd;
										if($i<5){
$html.=<<<cd
											<img src="themes/images/serv{$i}.png">
cd;
										}
$html.=<<<cd
											<h4>{$val['latin-subject']}</h4>
											<p>{$val['latin-body']}</p>
										</div>	
									</div>
cd;
								if($i%4==0){
$html.=<<<cd
								<div class="clear"></div>
cd;
								}$i++;}
$html.=<<<cd
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Service part -->
			<!-- Portfolio part -->
			<div id="portfolio" class="step" data-x="26000" data-y="2800" data-rotate="-30" data-scale="1">
				<div id="jms-content4">
					<div class="sixteen columns">
						<div class="block2">
							<!-- Portfolio filter -->
							<ul class="filter">
								<li class="current all"><a href="#">All</a></li>
cd;
								foreach($gallery as $val){
									$latin_catname = GetCategoryLatinName($val["catid"]);
$html.=<<<cd
									<li class="{$val['catid']}"><a href="#">{$latin_catname}</a></li>
cd;
								}
$html.=<<<cd
							</ul>
							<!-- END Portfolio filter -->
							<!-- Portfolio Items -->
							<ul class="portfolio group">
cd;
							for($i=0;$i<count($gallery);$i++){
								if (!isset($gallery[$i]["latin-subject"])) continue;
$html.=<<<cd
								<li class="item four columns omega" data-id="id-1" data-type="{$gallery[$i]['catid']}">
									<a href="{$gallery[$i]['image']}" data-rel="prettyPhoto[portfolio]">
										<div class="flip box fade">
											<div class="rollover">
												<div class="cube">
													<figure class="front">
														<img src="{$gallery[$i]['image']}" alt="{$gallery[$i]['latin-subject']}">
													</figure>
													<section class="back">
														<div class="back-wrap">
															<h3>{$gallery[$i]['latin-subject']}</h3>
															<p>{$gallery[$i]['latin-body']}</p>
														</div>
													</section>
												</div>
											</div>
										</div>
									</a>
								</li>
cd;
							}
$html.=<<<cd
							</ul>
							<!-- END Portfolio Items -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Portfolio part -->
			<!-- Contact part -->
			<div id="contact" class="step" data-x="30000" data-y="6500" data-rotate="30" data-scale="3">
				<div id="jms-content5">
					<div class="ten columns">
						<div class="block">
							<div class="title">
								<h2>My Location on World Map</h2>
							</div>
							<div class="gmap" id="map" data-center="36.293912, 59.577333" data-zoom="18">
								<address>
									<strong>Mohtashami</strong>
									<br />
									Mashhad-Iran
								</address>
							</div>
						</div>
					</div>
					<div class="six columns">
						<div class="block end">
							<div class="title">
								<h2>Contact With Me</h2>
							</div>
							<div id="contact-wrapper">
								<form id="contactform" action="javascript:alert('success!');">
									<fieldset class="info_fieldset">
										<div id="note"></div>
									</fieldset>
									<label>Name</label>
									<input class="textbox" type="text" name="name" value="" />
									<br />
									<label>E-mail</label>
									<input class="textbox ltr" type="text" name="email" value="" />
									<br />
									<label>Message</label>
									<textarea class="textbox" name="message" rows="5" cols="25"></textarea>
									<br />
									<input class="button" type="submit" value="Send Message">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Contact part -->
		</section>
		<!-- END Middle part -->
	</div>
	<!-- END Container -->
</body>
</html>
cd;
echo $html;
?>