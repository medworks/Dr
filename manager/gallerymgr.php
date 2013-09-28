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
 if ($_GET['item']!="gallerymgr")	exit();
 $db = Database::GetDatabase();
 $overall_error = false;
 $pic_on_edit_section = null;
 if (isset($_POST["mark"]) and $_POST["mark"]!="srhgall")
 {
	 if(empty($_POST["selectpic"]))
		{ 
			header('location:?item=gallermgr&act=new&msg=4');
			$overall_error = true;
		}
  } 	
 if (!$overall_error && $_POST["mark"]=="savegall")
 {						   				
	$fields = array("`image`","`subject`","`body`","`latin-subject`","`latin-body`","`catid`");	
	$values = array("'{$_POST[selectpic]}'","'{$_POST[subject]}'","'{$_POST[body]}'","'{$_POST[latinsubject]}'","'{$_POST[latinbody]}'","'{$_POST[cbcat]}'");
	if (!$db->InsertQuery('gallery',$fields,$values)) 
	{
		header('location:?item=gallerymgr&act=new&msg=2');
	} 	
	else 
	{  										
		header('location:?item=gallerymgr&act=new&msg=1');
	 }
 }
 else
 if (!$overall_error && $_POST["mark"]=="editgall")
 {			    
	$values = array("`image`"=>"'{$_POST[selectpic]}'",
	       		    "`subject`"=>"'{$_POST[subject]}'",
					"`body`"=>"'{$_POST[body]}'",
					"`latin-subject`"=>"'{$_POST[latinsubject]}'",
					"`latin-body`"=>"'{$_POST[latinbody]}'",
					"`catid`"=>"'{$_POST[cbcat]}'");
	$db->UpdateQuery("gallery",$values,array("id='{$_GET['sid']}'"));
	header('location:?item=gallerymgr&act=mgr');	
 }

	if ($overall_error)
	{
		$row = array("image"=>$_FILES['pic']['name'],
					 "subject"=>$_POST['subject'],
					 "body"=>$_POST['body'],
					 "latin-subject"=>$_POST['latinsubject'],
					 "latin-body"=>$_POST['latinbody']);
	}
 
   if ($_GET['act']=="new")
	{
	    $pic_on_edit_insert_section ="<img id='img' src='' alt='' />";
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savegall' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("gallery","*","id='{$_GET["sid"]}'",NULL);
		$pic_on_edit_insert_section = "<img src='{$row[image]}'width='200px' height='100px' />";
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editgall' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("gallery"," id",$_GET["sid"]);
		if ($db->CountAll("gallery")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=gallerymgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>گالری تصاویر</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=gallerymgr&act=new">عکس جدید
					<span class="add-gallery"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=gallerymgr&act=mgr" id="news" name="news">حذف/ویرایش عکس ها
					<span class="edit-gallery"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$sections = $db->SelectAll("section","*",null,"id ASC");
if ($_GET['act']=="edit") 
{   
    $category = $db->SelectAll("category","*",null,"id ASC");
    $secid = $db->Select("category","secid","ID = '{$row[catid]}'");
	$secid = $secid[0];
	$cbsection = DbSelectOptionTag("cbsec",$sections,"secname","{$secid}",null,"select validate[required]");
	$cbcategory = DbSelectOptionTag("cbcat",$category,"catname","{$row[catid]}",null,"select validate[required]");
	
}
else
{
  $cbsection = DbSelectOptionTag("cbsec",$sections,"secname",null,null,"select validate[required]");
  $cbcategory = null;
} 
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){	   
				$("#frmnewsmgr").validationEngine();
				$("#cbsec").change(function(){
					$.get('ajaxcommand.php?sec='+$(this).val(), function(data) {
							$('#catgory').html(data);
					});
				});
				$("#frmgallerymgr").validationEngine();			   

	    	});
		</script>
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>عکس جدید</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>	     
		<div id="message">
		{$msgs}
		</div>
		<form name="frmgallerymgr" id="frmgallerymgr" class="" action="" method="post" enctype="multipart/form-data" > 
     		<p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
			<div class="badboy"></div>
	        <p>
	          <label for="cbsection">سر گروه </label>
	          <span>*</span>
	        </p>    
		    {$cbsection}   
		    <div id="catgory">
			    {$cbcategory}
		    </div>
	        <div class="badboy"></div>
			<p>
				<label for="pic">عکس </label>
				<span>*</span>
			</p>
			<p>
		   		<input type="text" name="selectpic" class="selectpic" id="selectpic" value='{$row[image]}' />
		   		<input type="text" class="validate[required] showadd" id="showadd" value='{$row[image]}' />
		   		<a class="filesbrowserbtn" id="filesbrowserbtn" name="gallerymgr" title="گالری تصاویر">گالری تصاویر</a>
		   		<a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
		   </p>
		   <div class="badboy"></div>
		   <div id="filesbrowser"></div>
		   <div class="badboy"></div>
		   <br />
		   <hr />
		   <br />
			<p>
				<label for="subject">عنوان </label>
				<span>*</span>
			</p>
			<input type="text" name="subject" class="validate[required] subject" id="subject" value="{$row[subject]}" />
			<p>
				<label for="subject">توضیحات </label>
				<span></span>
			</p>
			<input type="text" name="body" class="subject" id="body" value="{$row[body]}" />
			<br />
			<hr />
			<br />
			<p class="ltr">
				<label for="subject">Title </label>
				<span>*</span>
			</p>
			<input type="text" name="latinsubject" class="leftdis ltr validate[required] subject" id="subject" value="{$row['latin-subject']}" />
			<p class="ltr">
				<label for="subject">Description </label>
				<span></span>
			</p>
			<input type="text" name="latinbody" class="leftdis ltr subject" id="body" value="{$row['latin-body']}" />  
			{$editorinsert}
				<input type="reset" value="پاک کردن" class='reset' /> 				
			</p>
		</form>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhgall")
	{	 			   
		$rows = $db->SelectAll(
				"gallery",
				"*",
				"`{$_POST[cbsearch]}` LIKE '%{$_POST[txtsrh]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{								
				header("Location:?item=worksmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"gallery",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhgall" )?$db->CountAll("gallery"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");

                $rows[$i]["latin-subject"] =(mb_strlen($rows[$i]["latin-subject"])>20)?mb_substr($rows[$i]["latin-subject"],0,20,"UTF-8")."...":$rows[$i]["latin-subject"];
                $rows[$i]["latin-body"] =(mb_strlen($rows[$i]["latin-body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["latin-body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["latin-body"]), ENT_QUOTES, "UTF-8");				
                $rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";				
				$secid = $db->Select("category","secid","ID = '{$rows[$i]["catid"]}'");
				$secid = $secid[0];				
				$rows[$i]["secid"] =GetSectionName($secid);
				$rows[$i]["catid"] =GetCategoryName($rows[$i]["catid"]);
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=gallerymgr&act=edit&sid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=gallerymgr&act=del&pageNo={$_GET[pageNo]}&sid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {       
                    $gridcode.= DataGrid(array( 
							"image"=>"عکس",
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"latin-subject"=>"عنوان (لاتین)",
							"latin-body"=>"توضیحات (لاتین)",
							"secid" =>"سرگروه",
							"catid" =>"گروه",
							"edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=gallerymgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
              "latin-subject"=>"عنوان (لاتین)",
              "latin-body"=>"توضیحات (لاتین)" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>حذف/ویرایش عکس ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=gallerymgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=gallerymgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=gallerymgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhgall" /> 
								{$msgs}

								{$gridcode} 
															
							</form>
					   </center>
					</div>

edit;
$html = $code;
}	
return $html;
?>	