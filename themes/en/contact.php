<?php

function checkEmail($email) {
  if (isset($_POST['email'])) {  
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);  
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            return true;   
        }else{
        	return false;
        }
    }
}

	$msg="";
	$admin = 'info@mediateq.ir';

	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$text    = $_POST['message'];

	$message = "$text";

	if( strlen($name)>=1 && checkEmail($email) && strlen($text)>=1 ){
		if( @mail (
				$admin,
				"$subject",
				$message,
				"From:$name $email" )
		){
			$msg="OK";

		}else{
			$msg="<div class='notification_error rtl medium'>خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.</div>";

		}
	}else{
		$msg="<div class='notification_error rtl medium'>خطا! لطفا فیلدها را بررسی نمایید و مجددا ارسال کنید!</div>";
	}

echo $msg

?>