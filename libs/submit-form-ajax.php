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
	$body='Bonjour l\'équipe Sparkline,'."\n\n";
    $body.='Vous avez reçu un nouveau message depuis le formulaire de contact de votre site www.sparkline.fr.'."\n\n";
    $body.='------------------------'."\n";
	$body.='Nom : '.$name."\n";
	$body.='Email : '.$email."\n";
	$body.='Objet : '.$subject."\n";
	$body.='Message : '."\n".$message."\n";
			
	if(mail($to, $subject, $body, $headers)) {
		echo "success";
	} else {
		echo "failed";
	}
	
}

?>