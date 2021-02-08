<?php 

// var_dump($_POST);
// var_dump($_GET);

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
$text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
$checkbox = filter_input(INPUT_POST, 'checkbox', FILTER_SANITIZE_SPECIAL_CHARS);

// $name = $_POST['name'];
// $phone = $_POST['phone'];
// $text = $_POST['text'];
// $checkbox = $_POST['checkbox'];

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication - входим на почту
$mail->Username = '';                 // Наш логин
$mail->Password = '';                           // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('');   // От кого письмо 
$mail->addAddress('');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Заявка с сайта saceza.ru';
$mail->Body    = '
		Пользователь оставил данные <br> 
	Имя: ' . $name . ' <br>
	Номер телефона: ' . $phone . '<br>
	Текст: ' . $text . '';
$mail->AltBody = '';
	
	if(!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Ваша заявка отправлена';
	}
	$response = ['message' => $message];
	header('Content-type: application/json');
	echo json_encode($response);
?>
