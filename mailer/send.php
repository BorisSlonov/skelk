<?php
// Файлы phpmailer
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';



// Переменные, которые отправляет пользователь
$email = $_POST['email'];
$msg = $_POST['msg'];




// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'sslonovboriss@yandex.ru'; // Логин на почте
    $mail->Password   = 'rfnfhncxiyirigig'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('sslonovboriss@yandex.ru', 'Заявка с сайта skelk'); // Адрес самой почты и имя отправителя

   // Получатель письма
   $mail->addAddress('sslonovborisss@gmail.com'); 
   $mail->addAddress('info@skelk.ru'); 
    

// Формирование самого письма
$title = "Заявка с сайта skelk.ru";
$body = "
<h2></h2>
<b>Почта:</b> $email <br>
<b>Запрос:</b> $msg
";


// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

?>