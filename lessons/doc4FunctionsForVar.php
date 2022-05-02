<?php
$title = "4 Функции для переменных";
require_once  "../templates/header.php";
?>

<?php

// Часто используемые функции с переменными:
$is = '';
gettype($is); // возвращает тип переменной
isset($is); // проверяет заданное значение переменной, пустая строка тоже является значением, чтобы проверить стоит указать :
var_dump(isset($is)); // true
empty($is); // Проверяет является ли переменная пустой ( если её не существует или =false) true
is_array($is); // Проверка является ли массивом
is_int($is);
is_bool($is);
echo '<pre>';
print_r(get_defined_vars()); // Можем увидеть все определённые переменные данной программы
echo '</pre>';

?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>