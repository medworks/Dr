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
	$overall_error = false;
	if ($_GET['item']!="worksmgr")	exit();
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
	{
	   date_default_timezone_set('Asia/Tehran');
	   list($hour,$minute,$second) = explode(':', Date('H:i:s'));
	   list($year,$month,$day) = explode("-", trim($_POST["sdate"]));
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);
	   $sdatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));
	   list($year,$month,$day) = explode("-", trim($_POST["fdate"]));
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);
	   $fdatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));
	}	
    if (!$overall_error && $_POST["mark"]=="saveworks")
	{						   				
		$fields = array("`subject`","`body`","`latin-subject`","`latin-body`","`date`","`group`");
		$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("'{$_POST[subject]}'","'{$_POST[detail]}'","'{$_POST[latinsubject]}'","'{$_POST[latindetail]}'","'{$sdatetime}'","'{$_POST[resume_drop]}'");	
		if (!$db->InsertQuery('works',$fields,$values)) 
		{
			header('location:?item=worksmgr&act=new&msg=2');
		} 	
		else 
		{  										
			header('location:?item=worksmgr&act=new&msg=1');			
		}  				 
	}
	else
	if (!$overall_error && $_POST["mark"]=="editworks")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`subject`"=>"'{$_POST[subject]}'",
						 "`body`"=>"'{$_POST[detail]}'",
						 "`latin-subject`"=>"'{$_POST[latinsubject]}'",
						 "`latin-body`"=>"'{$_POST[latindetail]}'",
						 "`date`"=>"'{$_POST[$sdatetime]}'",
						 "`group`"=>"'{$_POST[resume_drop]}'");		
        $db->UpdateQuery("works",$values,array("id='{$_GET[wid]}'"));		
		header('location:?item=worksmgr&act=mgr');	
	}

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
					 "image"=>$_POST['image'],
					 "body"=>$_POST['detail'],
					 "latin-subject"=>$_POST['latinsubject'],
					 "latin-body"=>$_POST['latindetail'],
					 "group"=>$_POST['resume_drop']);
	}
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='saveworks' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("works","*","id='{$_GET["wid"]}'",NULL);
		$row['date'] = ToJalali($row["date"]);
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editworks' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("works"," id",$_GET["wid"]);
		if ($db->CountAll("works")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=worksmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت رزومه</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=worksmgr&act=new">درج رزومه
					<span class="add-works"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=worksmgr&act=mgr" id="news" name="news">حذف/ویرایش رزمه
					<span class="edit-works"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else	
if ($_GET['act']=="new" or $_GET['act']=="edit")
{	
	$list = array("1"=>"مقالات",
				  "2"=>"سمینارها",
				  "3"=>"عنواین علمی");
	$itemselect = ($row['group'])? $row['group'] :"1";
	$resume_drop = SelectOptionTag("resume_drop",$list,$itemselect,null,"select2");

	$msgs = GetMessage($_GET['msg']);
	$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){		
			$("#frmworksmgr").validationEngine();			
		});	   
	</script>	     
	  <div class="title">
		  <ul>
			 <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
			 <li><span>درج رزومه</span></li>
		  </ul>
		  <div class="badboy"></div>
	  </div>  
	  <div class="content">
		<form name="frmworksmgr" id= "frmworksmgr" class="worksmgr" action="" method="post" enctype="multipart/form-data" >
		  <div class="mes" id="message">{$msgs}</div>
		   <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
		   <p>
			<label for="sdate">تاریخ </label>
			<span>*</span><br /><br />
			<input type="text" name="sdate" class="validate[required] sdate" id="date_input_1" value="{$row['date']}" />
			<img src="./images/cal.png" id="date_btn_1" alt="cal-pic">
			 <script type="text/javascript">
			  Calendar.setup({
				inputField  : "date_input_1",   // id of the input field
				button      : "date_btn_1",   // trigger for the calendar (button ID)
					ifFormat    : "%Y-%m-%d",       // format of the input field
					showsTime   : false,
					dateType  : 'jalali',
					showOthers  : true,
					langNumbers : true,
					weekNumbers : true
			  });
			</script>
		   </p>
		   <p>
			 <label for="detail">انتخاب گروه </label>
			 <span>*</span>
		   </p>
		   {$resume_drop}
		   <br />
		   <hr />
		   <br />
		   <p>
			 <label for="subject">عنوان </label>
			 <span>*</span>
		   </p>  	 
		   <input type="text" name="subject" class="validate[required] subject" id="subject" value="{$row[subject]}" />
		   <p>
			 <label for="detail">توضیحات </label>
			 <span>*</span>
		   </p>
		   <textarea cols="50" rows="10" name="detail" class="validate[required] detail" id="detail">{$row[body]}</textarea>
		   <br />
		   <hr />
		   <br />
		   <p class="ltr">
			 <label for="subject">Title </label>
			 <span>*</span>
		   </p>  	 
		   <input type="text" name="latinsubject" class="leftdis validate[required] subject ltr" id="subject" value="{$row['latin-subject']}" />
		   <p class="ltr">
			 <label for="detail">Description </label>
			 <span>*</span>
		   </p>
		   <textarea cols="50" rows="10" name="latindetail" class="leftdis validate[required] detail ltr" id="detail">{$row['latin-body']}</textarea>
		   {$editorinsert}
			 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
		</form>
		<div class="badboy"></div>
	  </div>
	  
cd;
  }
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="sdate" or $_POST["cbsearch"]=="fdate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"works",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id ASC",
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
				"works",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("works"):Count($rows);
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
                switch($rows[$i]["group"])
				{
				 case 1: $rows[$i]["group"] = "مقالات"; break;
				 case 2: $rows[$i]["group"] = "سمینارها"; break;
				 case 3: $rows[$i]["group"] = "عناوین علمی"; break;
				}
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["edit"] = "<a href='?item=worksmgr&act=edit&wid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف ایت فعالیت اطمینان دارید؟',
				'?item=worksmgr&act=del&pageNo={$_GET[pageNo]}&wid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"latin-subject"=>"عنوان (لاتین)",
							"latin-body"=>"توضیحات (لاتین)",
							"group"=>"گروه",							
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=worksmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
              "latin-subject"=>"عنوان (لاتین)",
              "latin-body"=>"توضیحات (لاتین)",
              "date"=>"تاریخ",
              "group"=>"گروه");
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
    <li><span>حذف/ویرایش رزمه</span></li>
  </ul>
  <div class="badboy"></div>
</div>
<div class="Top">                       
	<center>
		<form action="?item=worksmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
			<p>جستجو بر اساس {$combobox}</p>

			<p class="search-form">
				<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
				<img src="../themes/default/images/admin/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
		         <script type="text/javascript">
		          Calendar.setup({
		            inputField  : "date_input_1",   // id of the input field
		            button      : "date_btn_2",   // trigger for the calendar (button ID)
		                ifFormat    : "%Y/%m/%d",       // format of the input field
		                showsTime   : false,
		                dateType  : 'jalali',
		                showOthers  : true,
		                langNumbers : true,
		                weekNumbers : true
		          });
		        </script>
				<a href="?item=worksmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
				<a href="?item=worksmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
			</p>
			<input type="hidden" name="mark" value="srhnews" /> 
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