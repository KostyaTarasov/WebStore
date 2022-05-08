<?php
$title = "13 Подсказки";
require_once  "../templates/header.php";
?>

<?php

//*
//!
//?
//TODO:

/**
 * @param t
 * 
 */
//

// Чтобы ошибки выводились на экране при запуске сервера mamp, необходимо в пути C:\MAMP\conf\php8.0.1\php.ini найти строку display_errors =  off и заменить off на on

// ctrl+/ закомментирует

// Тип resource это специальная перменная, содержащая ссылку на внешний ресурс.

// Подсказки

// type-hint ("намек на тип") -- указание на ожидаемый тип значения (например, для входных аргументов функции).
// public function numberAction($max, LoggerInterface $logger)
//  для $max тип не указан (type-hinting отсутствует), для $logger ожидается тип LoggerInterface



/*
//* Чтобы создать  Your VirtualHost в  Wamp
нажать левой кнопкой по прил в трее выбрать virt host management http://localhost/add_vhost.php?lang=russian 
C:\wamp64\bin\apache\apache2.4.51\conf\extra\httpd-vhosts.conf
C:\Windows\System32\drivers\etc\hosts
*/



/*
//* Xdebug для phpStorm
https://php.zone/post/otladka-php-7-s-pomoshchyu-xdebug-v-phpstorm

+ в вампе включить xdebug (левой кнопкой по прил-php-настройки и расширения xdebug вкл)
настройки для шторма либо vscode в файле php.ini в wamp64 php 7.4.26
+указать путь zend_extension до библиотеки скачанной (подходит для VSCODE PHPSTORM)

; XDEBUG Extension
[xdebug]
zend_extension="c:/wamp64/bin/php/php7.4.26/ext/php_xdebug.dll"

;xdebug.idekey = "CODE"
xdebug.idekey = "PHPSTORM"
;xdebug.idekey = VSCODE

xdebug.mode = develop,debug
xdebug.start_with_request = yes
xdebug.output_dir ="c:/wamp64/tmp"
xdebug.show_local_vars=0
xdebug.log="c:/wamp64/logs/xdebug.log"
xdebug.log_level=7
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
 */

/*
 * Безопасность
 * CSP Content-Security-Policy.
 * Страница должна содержать HTTP-заголовок Content-Security-Policy с одной и более директивами, которые представляют собой «белые списки».
https://habr.com/ru/company/nix/blog/271575/
*/

?>


<!-- Сокращения -->
<!-- #block.content -->
<div id="block" class="content"></div>

<!-- url>li*7>span.hello и нажать таб, в итоге появятся 7 строк ниже: -->
<url>
    <!-- <li><span class="hello">хай</span></li> -->
</url>
<!-- С помощью зажатия alt можно работать сразу с несколькими строками -->


<!--
//*   О composer.json
https://habr.com/ru/post/439200/

Последняя доступная (1.2.*)

Указание тильды (~1.2.3) будет включать в себя все версии до 1.3 (не включительно), 
так как в семантическом версионировании это является моментом внедрения новых функциональных возможностей. 
В данном случае будет получена последняя из стабильных минорных версий. 
Т.е. будет меняться только последняя цифра — 1.2.5, 1.2.8 и тд.


Указание знака вставки (^1.2.3) буквально означает “опасаться только критических изменений”
 и будет включать в себя версии вплоть до 2.0. 
 Применительно к семантическому версионированию, изменение мажорной версии является моментом внесения в проект критических изменений, 
 так что версии 1.3, 1.4 и 1.9 подходят, в то время как 2.0 — уже нет.
Т.е. не меняется только первая цифра.
-->


<!--
//* Фреймворк    
 Фреймворк – это такой каркас приложения, на базе которого строится приложение. 
 Он позволяет разрабатывать приложение быстрее за счет того, что содержит в себе реализацию основных компонентов: роутинг, контроллеры, слой для работы с базой данных, работу с шаблонами.
Данный каркас и является фреймворком для сайта
Для того, чтобы добавить новый функционал на блог, вам достаточно создать экшен в контроллере, прописать роутинг, добавить класс для новой модели и создать шаблончик – вся остальная обвязка уже имеется.
В фреймворках реализация архитектуры MVC с роутингом
-->


<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>