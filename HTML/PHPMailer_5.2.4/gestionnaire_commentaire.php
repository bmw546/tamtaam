<?php
class mail{
    function sentMail($nom,$courriel,$sujet,$question){
        //error_reporting(E_ALL);
	error_reporting(E_STRICT);

	date_default_timezone_set('America/Toronto');

	require_once('class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail             = new PHPMailer();

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/[\]/','',$body);

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->Port = 587;

	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "ssl://smtp.gmail.com"; // sets the SMTP server
	//$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "tamtaamexample@gmail.com"; // SMTP account username
	$mail->Password   = "(a1b2c3d4e5)";        // SMTP account password

	$mail->SetFrom($courriel, $nom);

	$mail->AddReplyTo($courriel,$nom);

	$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($sujet);

	$address = $courriel;
	$mail->AddAddress($courriel, "John Doe");

	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}
    }
	
	
//$mail->Username = "tamtaamexample@gmail.com";
 //       $mail->Password = "(a1b2c3d4e5)";

}
?>