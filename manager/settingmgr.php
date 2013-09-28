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
		SetSettingValue("Dr_Name",$_POST["name"]);		
		SetSettingValue("Dr_Specialty",$_POST["specialty"]);		
		SetSettingValue("About_System",$_POST["about"]);

		SetSettingValue("Dr_Name_Latin",$_POST["latinname"]);		
		SetSettingValue("Dr_Specialty_Latin",$_POST["latinspecialty"]);		
		SetSettingValue("About_System_Latin",$_POST["latinabout"]);

		SetSettingValue("Dr_Pic",$_POST["selectpic"]);				
		header('location:?item=settingmgr&act=do');
	}
	else
	if ($_POST['mark']=="editseo")
	{
		SetSettingValue("Site_Title",$_POST["title"]);
		SetSettingValue("Site_KeyWords",$_POST["keywords"]);
		SetSettingValue("Site_Describtion",$_POST["describe"]);

		SetSettingValue("Latin_Site_Title",$_POST["latintitle"]);
		SetSettingValue("Latin_Site_KeyWords",$_POST["latinkeywords"]);
		SetSettingValue("Latin_Site_Describtion",$_POST["latindescribe"]);
		header('location:?item=settingmgr&act=do');
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

		SetSettingValue("Latin_Tell_Number",$_POST["latin_tel_number"]);
		SetSettingValue("Latin_Fax_Number",$_POST["latin_fax_number"]);
		SetSettingValue("Latin_Address",$_POST["latin_address"]);		
		header('location:?item=settingmgr&act=do');
	}
	else
	if ($_POST['mark']=="editgrid")
	{
		SetSettingValue("Max_Page_Number",$_POST["Max_Page_Number"]);
		SetSettingValue("Max_Post_Number",$_POST["Max_Post_Number"]);		
		header('location:?item=settingmgr&act=do');
	}
	if ($_GET['act']=="do")
   {
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>تنظیمات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
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
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}
else
	if ($_GET['act']=="about")
	{
	$about = GetSettingValue('About_System',0);
	$name = GetSettingValue('Dr_Name',0);
	$specialty = GetSettingValue('Dr_Specialty',0);

	$latin_about = GetSettingValue('About_System_Latin',0);
	$latin_name = GetSettingValue('Dr_Name_Latin',0);
	$latin_specialty = GetSettingValue('Dr_Specialty_Latin',0);

	$pic = GetSettingValue('Dr_Pic',0);

	$html=<<<ht
	<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>درباره ما</span></li>
	      </ul>
	      <div class="badboy"></div>
	</div>
	<script type='text/javascript'>
		$(document).ready(function(){		
			$("#frmabout").validationEngine();			
		});	   
	</script>
	<form name="frmabout" id= "frmabout" action="" method="post" >
		<p>
		 <label for="about">نام و نام خانوادگی </label>
		 <span>*</span>
	    </p>
	    <input type="text" name="name" value="{$name}" class="validate[required] subject">
	    <p>
		 <label for="about">تخصص </label>
		 <span>*</span>
	    </p>
	    <input type="text" name="specialty" value="{$specialty}" class="validate[required] subject">
		<p>
         <label for="pic">عکس </label>
         <span>*</span>
        </p>       
	    <p>
	   		<input type="text" name="selectpic" class="selectpic" id="selectpic" value='{$pic}' />
	   		<input type="text" class="validate[required] showadd" id="showadd" value='{$pic}' />
	   		<a class="filesbrowserbtn" id="filesbrowserbtn" name="newsmgr" title="گالری تصاویر">گالری تصاویر</a>
	   		<a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
	    </p>
	    <div class="badboy"></div>
	    <div id="filesbrowser"></div>
	    <div class="badboy"></div>
		<p>
		 <label for="about">درباره ما </label>
		 <span>*</span>
	    </p>
	    <textarea cols="50" rows="10" name="about" class="validate[required] detail" id="detail">{$about}</textarea>
	    <br />
	    <hr />
	    <br />
	    <p>
		 <label for="about">نام و نام خانوادگی (لاتین) </label>
		 <span>*</span>
	    </p>
	    <input type="text" name="latinname" value="{$latin_name}" class="ltr validate[required] subject">
	    <p>
		 <label for="about">تخصص (لاتین) </label>
		 <span>*</span>
	    </p>
	    <input type="text" name="latinspecialty" value="{$latin_specialty}" class="ltr validate[required] subject">
		<p>
		 <label for="about">درباره ما (لاتین) </label>
		 <span>*</span>
	    </p>
	    <textarea cols="50" rows="10" name="latinabout" class="ltr validate[required] detail" id="detail">{$latin_about}</textarea>
	    <p>
		 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
		 <input type='hidden' name='mark' value='editabout' />
	     <input type="reset" value="پاک کردن" class="reset" /> 	 	 
	    </p>
	</form>
ht;
	}
	else
	if ($_GET['act']=="seo")
	{
		$Site_Title = GetSettingValue('Site_Title',0);
		$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
		$Site_Describtion = GetSettingValue('Site_Describtion',0);

		$Latin_Site_Title = GetSettingValue('Latin_Site_Title',0);
		$Latin_Site_KeyWords = GetSettingValue('Latin_Site_KeyWords',0);
		$Latin_Site_Describtion = GetSettingValue('Latin_Site_Describtion',0);
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
			<li><span>اطلاعات تکمیلی</span></li>
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
				<br />
				<hr />
				<br />
				<p>
					<label for="subject">عنوان سایت (لاتین) </label>
				</p>    
				<input type="text" name="latintitle" class="subject ltr" id="title" value='{$Latin_Site_Title}'/>
				<p>
					<label for="subject">کلمات کلیدی (لاتین) </label>
				</p>    
				<input type="text" name="latinkeywords" class="subject ltr" id="keywords" value='{$Latin_Site_KeyWords}'/>
				<p>
					<label for="subject">توضیحات سایت (لاتین) </label>
				</p>    
				<input type="text" name="latindescribe" class="subject ltr" id="describe" value='{$Latin_Site_Describtion}'/>
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
		$Contact_Email = GetSettingValue('Contact_Email',0);
		$FaceBook_Add = GetSettingValue('FaceBook_Add',0);
		$Twitter_Add = GetSettingValue('Twitter_Add',0);
		$Rss_Add = GetSettingValue('Rss_Add',0);
		$Gplus_Add = GetSettingValue('Gplus_Add',0);
		$Tell_Number = GetSettingValue('Tell_Number',0);
		$Fax_Number = GetSettingValue('Fax_Number',0);
		$Address = GetSettingValue('Address',0);

		$Latin_Tell_Number = GetSettingValue('Latin_Tell_Number',0);
		$Latin_Fax_Number = GetSettingValue('Latin_Fax_Number',0);
		$Latin_Address = GetSettingValue('Latin_Address',0);
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
					<label for="subject">آدرس ایمیل </label>
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
				<br />
				<hr />
				<br />
				<p>
					<label for="tel">تلفن</label>
				</p>    
				<input type="text" name="tel_number" class="subject ltr" id="tel_number" value='{$Tell_Number}'/>
				<p>
					<label for="fax">فاکس</label>
				</p>    
				<input type="text" name="fax_number" class="subject ltr" id="fax_number" value='{$Fax_Number}'/>
				<p>
					<label for="address">آدرس</label>
				</p>    
				<input type="text" name="address" class="subject" id="address" value='{$Address}'/>
				<br />
				<hr />
				<br />
				<p>
				<label for="tel">تلفن (لاتین)</label>
				</p>    
				<input type="text" name="latin_tel_number" class="subject ltr" id="tel_number" value='{$Latin_Tell_Number}'/>
				<p>
					<label for="fax">فاکس (لاتین)</label>
				</p>    
				<input type="text" name="latin_fax_number" class="subject ltr" id="fax_number" value='{$Latin_Fax_Number}'/>
				<p>
					<label for="address">آدرس (لاتین)</label>
				</p>    
				<input type="text" name="latin_address" class="subject ltr" id="address" value='{$Latin_Address}'/>
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