<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../classes/login.php");
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
	if ($_POST['mark']=="editabout")
	{
		SetSettingValue("About_System",$_POST["about"]);		
		header('location:?item=settingmgr&act=do');
		//$_GET['item'] = "settingmgr";
		//$_GET['act'] = "about";
		//$_GET['msg'] = 1;
	}
	else
	if ($_POST['mark']=="editseo")
	{
		SetSettingValue("Site_Title",$_POST["title"]);
		SetSettingValue("Site_KeyWords",$_POST["keywords"]);
		SetSettingValue("Site_Describtion",$_POST["describe"]);
		header('location:?item=settingmgr&act=do');	
		//$_GET['item'] = "settingmgr";
		//$_GET['act'] = "seo";
		//$_GET['msg'] = 1;
	}
	else
	if ($_POST['mark']=="editadd")
	{
		SetSettingValue("Admin_Email",$_POST["admin_email"]);
		SetSettingValue("News_Email",$_POST["news_email"]);
		SetSettingValue("Contact_Email",$_POST["contact_email"]);
		SetSettingValue("FaceBook_Add",$_POST["facebook_add"]);
		SetSettingValue("Twitter_Add",$_POST["twitter_add"]);
		SetSettingValue("Rss_Add",$_POST["rss_add"]);
		SetSettingValue("Gplus_Add",$_POST["gplus_add"]);
		SetSettingValue("Tell_Number",$_POST["tel_number"]);
		SetSettingValue("Fax_Number",$_POST["fax_number"]);
		SetSettingValue("Address",$_POST["address"]);		
		header('location:?item=settingmgr&act=do');
		//$_GET['item'] = "settingmgr";
		//$_GET['act'] = "addresses";
		//$_GET['msg'] = 1;
	}
	else
	if ($_POST['mark']=="editgrid")
	{
		SetSettingValue("Max_Page_Number",$_POST["Max_Page_Number"]);
		SetSettingValue("Max_Post_Number",$_POST["Max_Post_Number"]);		
		header('location:?item=settingmgr&act=do');
		//$_GET['item'] = "settingmgr";
		//$_GET['act'] = "grid";
		//$_GET['msg'] = 1;
	}
	if ($_GET['act']=="do")
   {
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت تنظیمات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			  <li>		  
				<a href="?item=settingmgr&act=about">درباره ما
					<span class="about-us"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=seo" >اطلاعات تکمیلی 
					<span class="seo-detail"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=addresses" >آدرس ها 
					<span class="email"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=settingmgr&act=grid" >صفحه بندی مطالب 
					<span class="information"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}
else
	if ($_GET['act']=="about")
	{
	$About_System = GetSettingValue('About_System',0);
	$html=<<<ht
	<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>درباره ما</span></li>
	      </ul>
	      <div class="badboy"></div>
	</div>
	<form name="frmabout" id= "frmabout" action="" method="post" >
		<p>
			 <label for="about">درباره ما </label>
		   </p>
		   <textarea cols="50" rows="10" name="about" class="validate[required] detail" id="detail">{$About_System}</textarea>
		   <p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editabout' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
	</form>
	<!-- TinyMCE -->
	<script type="text/javascript" src="../lib/js/tiny/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			skin : "o2k7",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
			init_instance_callback : "initialiseInstance",

			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,table",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "right",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "../lib/js/tiny/tiny_mce/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "../lib/js/tiny/tiny_mce/lists/template_list.js",
			external_link_list_url : "../lib/js/tiny/tiny_mce/lists/link_list.js",
			external_image_list_url : "../lib/js/tiny/tiny_mce/lists/image_list.js",
			media_external_list_url : "../lib/js/tiny/tiny_mce/lists/media_list.js",

			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>
	<!-- /TinyMCE -->  
ht;
	}
	else
	if ($_GET['act']=="seo")
	{
		$Site_Title = GetSettingValue('Site_Title',0);
		$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
		$Site_Describtion = GetSettingValue('Site_Describtion',0);
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>اطلاعات سئو</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmseo" id= "frmseo" action="" method="post" >
				<p>
					<label for="subject">عنوان سایت </label>
				</p>    
				<input type="text" name="title" class="subject" id="title" value='{$Site_Title}'/>
				<p>
					<label for="subject">کلمات کلیدی </label>
				</p>    
				<input type="text" name="keywords" class="subject" id="keywords" value='{$Site_KeyWords}'/>
								<p>
					<label for="subject">توضیحات سایت </label>
				</p>    
				<input type="text" name="describe" class="subject" id="describe" value='{$Site_Describtion}'/>
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editseo' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}
	else
	if ($_GET['act']=="addresses")
	{
		$Admin_Email = GetSettingValue('Admin_Email',0);
		$News_Email = GetSettingValue('News_Email',0);
		$Contact_Email = GetSettingValue('Contact_Email',0);
		$FaceBook_Add = GetSettingValue('FaceBook_Add',0);
		$Twitter_Add = GetSettingValue('Twitter_Add',0);
		$Rss_Add = GetSettingValue('Rss_Add',0);
		$Gplus_Add = GetSettingValue('Gplus_Add',0);
		$Tell_Number = GetSettingValue('Tell_Number',0);
		$Fax_Number = GetSettingValue('Fax_Number',0);
		$Address = GetSettingValue('Address',0);
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>آدرس ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmaddresses" id= "frmaddresses" action="" method="post" >
				<p>
					<label for="subject">ایمیل ادمین</label>
				</p>    
				<input type="text" name="admin_email" class="subject ltr" id="admin_email" value='{$Admin_Email}'/>
				<p>
					<label for="subject">ایمیل خبرنامه </label>
				</p>    
				<input type="text" name="news_email" class="subject ltr" id="news_email" value='{$News_Email}'/>
								<p>
					<label for="subject"> ایمیل تماس با ما</label>
				</p>    
				<input type="text" name="contact_email" class="subject ltr" id="contact_email" value='{$Contact_Email}'/>
				<p>
					<label for="facebook">آدرس فیس بوک </label>
				</p>    
				<input type="text" name="facebook_add" class="subject ltr" id="facebook_add" value='{$FaceBook_Add}'/>
				<p>
					<label for="twitter">آدرس تویتر </label>
				</p>    
				<input type="text" name="twitter_add" class="subject ltr" id="twitter_add" value='{$Twitter_Add}'/>
				<p>
					<label for="rss">آدرس RSS </label>
				</p>    
				<input type="text" name="rss_add" class="subject ltr" id="rss_add" value='{$Rss_Add}'/>
				<p>
					<label for="gpluse">آدرس گوگل پلاس </label>
				</p>    
				<input type="text" name="gplus_add" class="subject ltr" id="gplus_add" value='{$Gplus_Add}'/>
				<p>
					<label for="tel">تلفن شرکت</label>
				</p>    
				<input type="text" name="tel_number" class="subject ltr" id="tel_number" value='{$Tell_Number}'/>
				<p>
					<label for="fax">فاکس شرکت</label>
				</p>    
				<input type="text" name="fax_number" class="subject ltr" id="fax_number" value='{$Fax_Number}'/>
				<p>
					<label for="address">آدرس شرکت</label>
				</p>    
				<input type="text" name="address" class="subject" id="address" value='{$Address}'/>
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editadd' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}
	else
	if ($_GET['act']=="grid")
	{
		$Max_Page_Number = GetSettingValue('Max_Page_Number',0);
		$Max_Post_Number = GetSettingValue('Max_Post_Number',0);		
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>جداول اطلاعات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
			<form name="frmemails" id= "frmemails" action="" method="post" >
				<p>
					<label for="subject">تعداد صفحه در صفحه بندی</label>
				</p>    
				<input type="text" name="Max_Page_Number" class="subject" id="Max_Page_Number" value='{$Max_Page_Number}'/>
				<p>
					<label for="subject">تعداد مطلب در صفحه اول</label>
				</p>    
				<input type="text" name="Max_Post_Number" class="subject" id="title" value='{$Max_Post_Number}'/>				
				<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editgrid' />
		     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
			</form>
ht;
	}	
	
return $html;
?>