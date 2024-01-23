<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('pirlovski1992@gmail.com', 'Магазин ANST');
	//Кому отправить
	$mail->addAddress('pirlovski1992@gmail.com');
	//Тема письма
	$mail->Subject = 'Привіт . Ти добився свого .Продовжуй в тому ж дусі!!!!!';

	//Рука
	$hand = "НОВА ПОШТА";
	if($_POST['hand'] == "НОВА ПОШТА"){
		$hand = "УКРПОШТА";
	}

	//Тело письма
	$body = '<h1>Приймай замовлення </h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Імя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>номер телефону:</strong> '.$_POST['tel'].'</p>';
	}
	if(trim(!empty($_POST['hand']))){
		$body.='<p><strong>Варіант відправки:</strong> '.$hand.'</p>';
	}
	if(trim(!empty($_POST['age']))){
		$body.='<p><strong>Розмір:</strong> '.$_POST['age'].'</p>';
	}
	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Повідомлення:</strong> '.$_POST['message'].'</p>';
	}
	
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Помилка в ПiaШП';
	} else {
		$message = 'Замовлення прийнято.Чекайте на звінок менеджера для уточнення всіх деталей';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>