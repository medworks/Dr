<?php
	include_once("./config.php");
	include_once("./classes/functions.php");
	include_once("./classes/database.php");
	include_once("./classes/seo.php");
	$seo = Seo::GetSeo();
	$db = Database::GetDatabase();
	
  	$news = $db->SelectAll("news","*",null,"id ASC");
  	$gallery = $db->SelectAll("gallery","*",null,"id DESC");
	$category = $db->SelectAll("category","*",null,"id ASC");

	$name = GetSettingValue('Dr_Name',0);
	$specialty  = GetSettingValue('Dr_Specialty',0);
	$about = GetSettingValue('About_System',0);

	$Contact_Email = GetSettingValue('Contact_Email',0);
	$FaceBook_Add = GetSettingValue('FaceBook_Add',0);
	$Twitter_Add = GetSettingValue('Twitter_Add',0);
	$Rss_Add = GetSettingValue('Rss_Add',0);
	$Gplus_Add = GetSettingValue('Gplus_Add',0);
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Fax_Number = GetSettingValue('Fax_Number',0);
	$Address = GetSettingValue('Address',0);
	$Dr_Pic = GetSettingValue('Dr_Pic',0);

$html=<<<cd
<!DOCTYPE HTML>
<html lang="fa">
<head>
	<title>{$seo->Site_Title}</title>

	<meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="UTF-8">
	<meta name="robots" content="INDEX,FOLLOW">
	<meta name="description" content="{$seo->Site_Describtion}">
	<meta name="keywords" content="{$seo->Site_KeyWords}">
	<meta http-equiv="Content-Language" content="Fa">
	<meta http-equiv="Designer" content="مدیاتک">
	<meta name="Generator" content="مدیاتک">
	<meta name="Author" content="مدیاتک">

	<link rel="icon" href="themes/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="themes/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="themes/fa/skeleton.css" />
	<link rel="stylesheet" type="text/css" href="themes/css/jquery.jscrollpane.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/prettyPhoto.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/jquery.qtip.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="themes/fa/style.css" media="all" />

	<script src="themes/js/jquery.min.js" type="text/javascript"></script>
	<script src="themes/js/jms.js" type="text/javascript"></script>
	<script src="themes/js/jmpress.js" type="text/javascript"></script>
	<script src="themes/js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="themes/js/detectmobilebrowser.js" type="text/javascript"></script>
	<script src="themes/js/mousewheel.js" type="text/javascript"></script>
	<script src="themes/fa/js/jquery.jscrollpane.js" type="text/javascript"></script>
	<script src="themes/js/jquery.quicksand.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyPhoto.js" type="text/javascript"></script>
	<script src="themes/js/jquery.qtip.min.js" type="text/javascript"></script>
	<script src="themes/js/jquery.mobilegmap.min.js" type="text/javascript"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false" type="text/javascript"></script>
	<script src="themes/js/contact_form.js" type="text/javascript"></script>
	<script src="themes/fa/js/scripts.js" type="text/javascript"></script>
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
cd;
$html.=<<<cd
<body>
	<!-- Container -->
	<div class="container">
		<!-- Header part -->
		<header>
			<div class="sixteen columns">
                <div class="My_name">
	                <h1>{$name}</h1> 
	                <h3>{$specialty}</h3>
                </div>
                <div class="flags">
                	<a href="#" class="tip" title="انگلیسی"><img src="themes/images/england-flag.png" alt="english"></a>
                	<a href="#" class="tip" title="فارسی"><img src="themes/images/iran-flag.png" alt="persian"></a>
                </div>
                <nav id="menu" class="sixteen columns">
                	<ul id="nav">
                		<li class="active"><a href="#home">صفحه اصلی</a></li>
                		<li><a href="#resume">رزومه</a></li>
                		<li><a href="#services">خدمات</a></li>
                		<li><a href="#portfolio">گالری تصاویر</a></li>
                		<li><a href="#contact">تماس با من</a></li>
                	</ul>
                	<!-- Dropdown menu for mobile -->
                	<select id="dd_menu">
                		<option value="#home">صفحه اصلی</option>
                		<option value="#resume">رزومه</option>
                		<option value="#services">خدمات</option>
                		<option value="#portfolio">گالری تصاویر</option>
                		<option value="#contact">تماس با من</option>
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
								<h3>{$name} ({$specialty})</h3>
								<p class="small">{$about}</p>
							</div>
							<div class="social_icons">
								<h3>دنبال کردن من در</h3>
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
									<span class="title">نام و نام خانوادگی</span>
									<span class="value small">{$name}</span>
								</li>
								<li>
									<span class="title">آدرس</span>
									<span class="value small">{$Address}</span>
								</li>
								<li>
									<span class="title">ایمیل</span>
									<span class="value small latinfont"><a href="mailto:{$Contact_Email}">{$Contact_Email}</a></span>
								</li>
								<li>
									<span class="title medium">تلفن</span>
									<span class="value small tel">{$Tell_Number}</span>
								</li>
								<li>
									<span class="title medium">فاکس</span>
									<span class="value small fax">{$Fax_Number}</span>
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
								<h2>مقالات</h2>
							</div>
							<div class="detailsCol">
								<ul class="employment_ul">
									<li>
										<span class="date">1391-12-1</span>
										<h3>مقاله یک</h3>
										<p>توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>مقاله دو</h3>
										<p>توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>مقاله سه</h3>
										<p>توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... توضیحات مقاله... </p>
										<span class="place">در...</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="one-third column">
						<div class="block">
							<div class="title">
								<h2>کنفرانس ها</h2>
							</div>
							<div class="detailsCol">
								<ul class="employment_ul">
									<li>
										<span class="date">1391-12-1</span>
										<h3>کنفرانس یک</h3>
										<p>توضیحات کنفرانس... توضیحات کنفرانس... توضیحات کنفرانس... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>کنفرانس دو</h3>
										<p>توضیحات کنفرانس... توضیحات کنفرانس... توضیحات کنفرانس... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>کنفرانس سه</h3>
										<p>توضیحات کنفرانس... توضیحات کنفرانس... توضیحات کنفرانس... </p>
										<span class="place">در...</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="one-third column omega">
						<div class="block">
							<div class="title">
								<h2>عناوین علمی</h2>
							</div>
							<div class="detailsCol">
								<ul class="employment_ul">
									<li>
										<span class="date">1391-12-1</span>
										<h3>عنوان یک</h3>
										<p>توضیحات عنوان... توضیحات عنوان... توضیحات عنوان... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>عنوان دو</h3>
										<p>توضیحات عنوان... توضیحات عنوان... توضیحات عنوان... </p>
										<span class="place">در...</span>
									</li>
									<li>
										<span class="date">1391-12-1</span>
										<h3>عنوان سه</h3>
										<p>توضیحات عنوان... توضیحات عنوان... توضیحات عنوان... </p>
										<span class="place">در...</span>
									</li>
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
											<h4>{$val[subject]}</h4>
											<p>{$val[body]}</p>
										</div>	
									</div>
cd;
								$i++;}
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
								<li class="current all"><a href="#">همه</a></li>
cd;
								foreach($gallery as $val){
									$catname = GetCategoryName($val["catid"]);
$html.=<<<cd
									<li class="{$val['catid']}"><a href="#">{$catname}</a></li>
cd;
								}
$html.=<<<cd
							</ul>
							<!-- END Portfolio filter -->
							<!-- Portfolio Items -->
							<ul class="portfolio group">
cd;
							for($i=0;$i<count($gallery);$i++){
								if (!isset($gallery[$i]["subject"])) continue;
								$body = strip_tags($gallery[$i]["body"]);
							    $body = (mb_strlen($body)>100) ? mb_substr($body,0,100,"UTF-8")."..." : $body;
$html.=<<<cd
								<li class="item four columns omega" data-id="id-1" data-type="{$gallery[$i]['catid']}">
									<a href="{$gallery[$i]['image']}" data-rel="prettyPhoto[portfolio]">
										<div class="flip box fade">
											<div class="rollover">
												<div class="cube ltr">
													<figure class="front">
														<img src="{$gallery[$i]['image']}" alt="{$gallery[$i]['subject']}">
													</figure>
													<section class="back">
														<div class="back-wrap">
															<h3>{$gallery[$i]['subject']}</h3>
															<p>{$gallery[$i]['body']}</p>
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
								<h2>آدرس من</h2>
							</div>
							<div class="gmap" id="map" data-center="36.293912, 59.577333" data-zoom="18">
								<address>
									<strong>احمدآباد، خیابان محتشمی، پلاک 1222</strong>
									<br />
									مشهد، ایران
								</address>
							</div>
						</div>
					</div>
					<div class="six columns">
						<div class="block end">
							<div class="title">
								<h2>تماس با من</h2>
							</div>
							<div id="contact-wrapper">
								<form id="contactform" action="javascript:alert('success!');">
									<fieldset class="info_fieldset">
										<div id="note"></div>
									</fieldset>
									<label class="medium">نام</label>
									<input class="textbox" type="text" name="name" value="" />
									<br />
									<label class="medium">ایمیل</label>
									<input class="textbox ltr" type="text" name="email" value="" />
									<br />
									<label class="medium">پیام</label>
									<textarea class="textbox" name="message" rows="5" cols="25"></textarea>
									<br />
									<input class="button small" type="submit" value="ارسال پیام">
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