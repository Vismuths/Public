<?php
$EMAIL = array('programma@stek74.ru', 'support@stek-trust.ru');
$SUBJECT = "СТЭК-ТРАСТ Мобильная версия. Запрос с продающей страницы mobile.stek-trust.ru";

session_start();
include_once 'securimage/securimage.php';
include_once 'smtpclass/smtp.php';
include_once 'sasl/sasl.php';

$securimage = new Securimage();

$fio = $_POST['clash'];
$phone = $_POST['poor'];
$message = $_POST['farget'];
$captcha = $_POST['aster'];
$client_email = $_POST['tool'];

if ($securimage->check($_POST['aster']) == false) {

  echo "<script>alert('Код на изображении введён неверно.');
  document.location.replace('//mobile.stek-trust.ru');</script>";
 exit;
}

$BODY = "К вам обратились:\nФИО: $fio\nТелефон: $phone\nЭлектронная почта: $client_email\nСообщение:\n\n$message";

$from = $client_email;
$to = $EMAIL; //array('programma@stek74.ru', 'support@stek74.ru');

$smtp = new smtp_class;
$smtp->host_name="mail.stek-trust.ru";
$smtp->host_port='25';
$smtp->user='info@stek-trust.ru';
$smtp->password='656285+';
$smtp->ssl=0;
$smtp->debug=0;       //0 here in production
//$smtp->html_debug=1; //same
  
if($smtp->SendMessage(
  $from,
  $to,
  array(
    "Content-type: text/plain; charset=utf-8",
    "From: $from",
    "To: ".implode(',', $to),
    "Subject: $SUBJECT",
    "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")
  ),
  $BODY)
)

 echo "<script>alert('Сообщение успешно отправлено.');
 document.location.replace('//mobile.stek-trust.ru');</script>";

else

 echo "<script>alert('Ошибка сервера. Не удалось отправить сообщение, попробуйте еще раз');
 document.location.replace('//mobile.stek-trust.ru');</script>";
  //echo "Could not send the message to $to.\nError: ".$smtp->error."\n";

?>