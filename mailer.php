<pre>
<?php
require("helper.php");
include('OAuthTokenProvider.php');
include('Exception.php');
include('PHPMailer.php');
include('OAuth.php');
include('SMTP.php');
include('POP3.php');

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->isSMTP();
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;

// Khsusus AMPPS set SSL spt ini	
$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);

$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'fwijaya918@gmail.com';
$mail->Password = 'hwkobeiildwtiill';

//Recipients
$mail->setFrom('asdasdasdasd@gmail.com', $email);
$mail->addAddress('cantique@gmail.com', $name);


$mail->Subject  = $subject;
$mail->Body     = $message;
$mail->WordWrap = 50;

if (!$mail->Send()) {
	alert('Failed');
} else {
	alert('Message has been sent');
}
header('location: catalogue.php');
// if(isset($_SESSION['currentUser'])){
// 	header('location: ../indexSudahLogin.php');
// }
// else{
// 	header('location: ../index.php');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>