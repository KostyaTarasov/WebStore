<?php
$title = "7 Функция phpinfo() и массив _SERVER";
require_once  "../templates/header.php";
?>

<?php
// phpinfo(); // Информация о php

// echo '<pre>';
// print_r($_SERVER); // Инфомрация о браузере, операционной системе
// echo '</pre>';

//echo $_SERVER['HTTPS']; Проверка есть ли https
echo $_SERVER['HTTP_HOST'] . ' - ' . $_SERVER['REQUEST_URI'] . "<br>"; // Имя доменного имени текущего сайта и остальная информация
echo $_SERVER['HTTP_USER_AGENT'] . "<br>"; // Опер. система

// // Чтобы выполнялась переадресация, не отображался ключ (?source=242354235) в url
// if($_GET['source']!= ""){
//     $link = explode("?source=", $_SERVER['REQUEST_URI']); // разбиение url на до ключа ?source= и после него
//     $redirect = "http://".$_SERVER['HTTP_HOST'].$link[0];

//     header('HTTP/1.1 301 Moved Permanently'); // 301 переадресация с помощью редирект 301
//     header('Location: '.$redirect); // Переадресация
//     exit();
// }

?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>