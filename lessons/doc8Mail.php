<?php
$title = "8 Отправка почты с сайта";
require_once  "../templates/header.php";
?>

<?php
$message = "Сообщение c своего сайта php";
$from = "kostet-karate@yandex.ru";
$to = "mixtmneon@gmail.com";
$subject = "Тема сообщения";

$subject = "=&utf-8?B?" . base64_encode($subject) . "?="; // Закодируем тему сообщения
$headers = "From: $from\r\nReply-to: $from\r\ndoc-type:text/plain; charset=uft-8\r\n"; // Заголовки (от кого письмо, кому отвечаем, настройка вида письма(текст), кодировка письма)
mail($to, $subject, $message, $headers); // куда отправляем, тему, сообщение и заголовок  
// Сработает не на локальном сервере, а на выгруженном сайте хостинга

/*
Настроено согласно инструкции ниже для WAMP, успешно тестировал в index.php

Отправка писем через localhost/WAMP Server на почту Gmail с помощью sendmail
https://oddstyle.ru/veb-razrabotka/otpravka-pisem-cherez-localhostwamp-server-na-pochtu-gmail-s-pomoshhyu-sendmail.html

Поставить галку для разрешения использовать ненадёжные приложения у которых есть доступ к аккаунту ( ДО 30 МАЯ 2022 ГОДА функция работает у гугла)
https://myaccount.google.com/security?
*/

$message = 'Добро пожаловать на наш портал!<br>
Для активации вашего аккаунта нажмите <a href="https://translate.google.ru/">сюда</a>.';

$headers  = 'From: mixtmneon@gmail.com' . "\r\n" . // От кого
    'Content-Type: text/html; charset=UTF-8' . "\r\n"; // либо doc-type:text/plain
    //'Reply-To: tarasovaelenamed@gmail.com' . "\r\n" .
    // 'MIME-Version: 1.0' . "\r\n" .
    // 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
    // 'X-Mailer: PHP/' . phpversion();
    
mail('tarasovaelenamed@gmail.com', 'Тема нового письма', $message, $headers);
?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>