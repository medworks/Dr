<?php
	include_once("../classes/database.php");	
	include_once("../classes/login.php");	
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");
	if ($_GET['item']!="dashboard")	exit();
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
		header('location:?item=dashboard&act=do');
	}
	
	$about = GetSettingValue('About_System',0);
	$name = GetSettingValue('Dr_Name',0);
	$specialty = GetSettingValue('Dr_Specialty',0);

	$latin_about = GetSettingValue('About_System_Latin',0);
	$latin_name = GetSettingValue('Dr_Name_Latin',0);
	$latin_specialty = GetSettingValue('Dr_Specialty_Latin',0);

	$pic = GetSettingValue('Dr_Pic',0);

$html=<<<ht
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
 return $html;
?>