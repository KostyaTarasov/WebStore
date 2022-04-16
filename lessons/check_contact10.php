<?php
session_start();
unset($_SESSION['user_name']); // Вначале очищаем старые данные сессии( созданные при прошлом открытии этого файла)
unset($_SESSION['email']);
unset($_SESSION['subject']);
unset($_SESSION['message']);
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_subject']);
unset($_SESSION['error_message']);
unset($_SESSION['success_mail']);
function redirect()
{
    header('Location:doc10FormFeedback.php');
    exit;
}

$user_name = htmlspecialchars(trim($_POST['username'])); // htmlspecialchars() удаляет все html теги из полученной(post) строки
$from = htmlspecialchars(trim($_POST['email']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

$_SESSION['user_name'] = $user_name; // сохраняем имя в сессии
$_SESSION['email'] = $from; // email
$_SESSION['subject'] = $subject; // тему сообщения
$_SESSION['message'] = $message; // сообщение



// Обработка ошибок ввода в полях
if (strlen($user_name) <= 1) { // Если колич. элементов в строке <= 1
    $_SESSION['error_username'] = "Введите корректное имя"; // В сессии сохраняем
    redirect(); // Открываем страницу формы заполнения 
} else if (strlen($from) < 5 || strpos($from, "@") == false) {
    $_SESSION['error_email'] = "Вы ввели некорректный email";
    redirect();
} else if (strlen($subject) < 5) {
    $_SESSION['error_subject'] = "Тема сообщения не менее 5 символов";
    redirect();
} else if (strlen($message) <= 15) {
    $_SESSION['error_message'] = "Сообщение не менее 15 символов";
    redirect();
} else {
    // Отправляем сообщение:
    $subject = "=&utf-8?B?" . base64_encode($subject) . "?="; // Закодируем тему сообщения
    $headers = "From: $from\r\nReply-to: $from\r\ndoc-type:text/plain; charset=uft-8\r\n"; // Заголовки (от кого письмо, кому отвечаем, настройка вида письма(текст), кодировка письма)
    //mail("mixtmneon@gmail.com", $subject, $message, $headers); // куда отправляем, тему, сообщение и заголовок  
    // Сработает не на локальном сервере, а на выгруженном сайте хостинга

    $_SESSION['success_mail'] = "Вы успешно отправили письмо!";
    redirect();
}
