<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$sess = Session::GetSesstion();	
	$userid = $sess->Get("userid");
	$overall_error = false;
	if ($_GET['item']!="newsmgr")	exit();	
	if (!$overall_error && $_POST["mark"]=="savenews")
	{	    
		$fields = array("`subject`","`body`","`latin-subject`","`latin-body`");
		$_POST["detail"] = addslashes($_POST["detail"]);		
		$values = array("'{$_POST[subject]}'","'{$_POST[detail]}'","'{$_POST[latinsubject]}'","'{$_POST[latindetail]}'");
		if (!$db->InsertQuery('news',$fields,$values)) 
		{
			header('location:?item=newsmgr&act=new&msg=2');
		} 	
		else 
		{  				
			header('location:?item=newsmgr&act=new&msg=1');
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editnews")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);	    
		$values = array("`subject`"=>"'{$_POST[subject]}'",
						"`body`"=>"'{$_POST[detail]}'",
						"`latin-subject`"=>"'{$_POST[latinsubject]}'",
						"`latin-body`"=>"'{$_POST[latindetail]}'");
			
        $db->UpdateQuery("news",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=newsmgr&act=mgr');	
	}

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
					 "body"=>$_POST['detail'],
					 "latin-subject"=>$_POST['latinsubject'],
					 "latin-body"=>$_POST['latindetail']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savenews' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("news","*","id='{$_GET["nid"]}'",NULL);
	$row['ndate'] = ToJalali($row["ndate"]);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editnews' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("news"," id",$_GET["nid"]);
	if ($db->CountAll("news")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=newsmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت خدمات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=newsmgr&act=new">درج خدمت
					<span class="add-news"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newsmgr&act=mgr" id="news" name="news">حذف/ویرایش خدمات
					<span class="edit-news"></span>
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

$html=<<<cd
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>درج خدمت</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmnewsmgr" id="frmnewsmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
       <p>
         <label for="subject">عنوان </label>
         <span>*</span>
       </p>    
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/>       
  	   <p>
         <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="validate[required] detail" id="detail" > {$row[body]}</textarea>
       </p>
       <br />
       <hr />
       <br />
       <p class="ltr">
         <label for="subject">Title </label>
         <span>*</span>
       </p>    
       <input type="text" name="latinsubject" class="leftdis validate[required] subject ltr" id="subject" value='{$row["latin-subject"]}'/>
       <p class="ltr">
         <label for="detail">Description </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="latindetail" class="leftdis validate[required] detail ltr" id="detail" > {$row["latin-body"]}</textarea>
	   {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    $rows = $db->SelectAll(
				"news",
				"*",
				"`{$_POST[cbsearch]}` LIKE '%{$_POST[txtsrh]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{								
				header("Location:?item=newsmgr&act=mgr&msg=6");
			}			
	}
	else
	{	
		$rows = $db->SelectAll(
				"news",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("news"):Count($rows);
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
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["edit"] = "<a href='?item=newsmgr&act=edit&nid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=newsmgr&act=del&pageNo={$_GET[pageNo]}&nid=');"
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
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newsmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
              "latin-subject"=>"عنوان (لاتین)",
              "latin-body"=>"توضیحات (لاتین)"
              );
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
    <li><span>حذف/ویرایش خدمات</span></li>
  </ul>
  <div class="badboy"></div>
</div>
<div class="Top">                       
	<center>
		<form action="?item=newsmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
			<p>جستجو بر اساس {$combobox}</p>

			<p class="search-form">
				<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
				<a href="?item=newsmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
				<a href="?item=newsmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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