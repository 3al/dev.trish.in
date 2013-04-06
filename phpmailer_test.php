<?php

	require_once('PHPMailer_5.2.0/class.phpmailer.php');
	
	$mail = new PHPMailer(); //telling the class to use SMTP
	
	$mail->IsSMTP();
	$mail->SMTPDebug  = 1; // enables SMTP debug information (for testing)
	
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "no-reply@hostline.ru";  // GMAIL username
	$mail->Password   = "k235kw0U";            // GMAIL password
	$mail->SetLanguage('ru');
	
	
	$mail->SetFrom('no-reply@hostline.ru', 'no-reply');

	//$mail->AddReplyTo("name@yourdomain.com","First Last");

	$mail->Subject    = "Тестовое сообщение";

	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
	// optional, comment out and test
	
	$body = "<strong>Привет!</strong> Это тест!";
	
	$mail->MsgHTML($body);

	//$address = "support@hostline.ru";
	$address = "trishin-alexei@yandex.ru";
	
	$mail->AddAddress($address);

	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else {
	  echo "Message sent!";
	}