<?php

//var_dump("ALL FIELDS ARE EMPTY");
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
	die('Error: Missing variables');
}else{

    $name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	/** Put Your Email address here. **/
	
	$to= 'info@sparkline.fr';

	$headers = 'From: '.$email."\r\n" .
		'Reply-To: '.$email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$subject = $subject;
	$body='You have got a new message from the contact form on your website.'."\n\n";
	$body.='Name: '.$name."\n";
	$body.='Email: '.$email."\n";
	
	$body.='Message: '."\n".$message."\n";
			
	if(mail($to, $subject, $body, $headers)) {
		echo "success";
	} else {
		echo "failed";
	}
	
}

?>