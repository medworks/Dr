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
			$msg="<div class='notification_error'>Error! Your message didn't send please try again.</div>";

		}
	}else{
		$msg="<div class='notification_error'>Error! Please check fields and try again!</div>";
	}

echo $msg

?>