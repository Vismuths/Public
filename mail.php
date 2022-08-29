<?php
$EMAIL = array('p******u', 's******t.ru');
$SUBJECT = "***** Мобильная версия. Запрос с продающей страницы m*********u";

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
  document.location.replace('//m*******u');</script>";
 exit;
}

$BODY = "К вам обратились:\nФИО: $fio\nТелефон: $phone\nЭлектронная почта: $client_email\nСообщение:\n\n$message";

$from = $client_email;
$to = $EMAIL; //array('p*******u', 's*****u');

$smtp = new smtp_class;
$smtp->host_name="m********u";
$smtp->host_port='**';
$smtp->user='****';
$smtp->password='*******';
$smtp->ssl=*;
$smtp->debug=*;       //0 here in production
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
 document.location.replace('//m*******u');</script>";

else

 echo "<script>alert('Ошибка сервера. Не удалось отправить сообщение, попробуйте еще раз');
 document.location.replace('//m**********u');</script>";
  //echo "Could not send the message to $to.\nError: ".$smtp->error."\n";

?>
