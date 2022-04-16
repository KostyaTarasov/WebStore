<?php
$title = "1 Основные функции";
require "../templates/header.php";
?>

<?php

echo '<b>Hello</b> World!';
echo "<br>Hello";

echo "\"";
echo '\'';
$num = 7;
$number = -45.88;
$str = "  ";
$bool = true;
echo $str . ': ' . $number . $num;
echo M_PI . '<br>';
echo M_E . '<br>';

echo abs(22) . '<br>';
echo floor(3.1) . '<br>'; // Округление в меньшую сторону
echo ceil(3.1) . '<br>'; // Округление в большую сторону
echo round(3.134636, 2) . '<br>';
echo mt_rand(1, 20) . '<br>'; // Рандомное число
echo min(2, 5, 7, 54, 1, 7) . '<br>';
echo "Var: $str" . '!' . '<br>'; // В двойных кавычках можно указать переменную $... Но такие кавычки обрабатываются оперативной памятью в два раза больше
echo "<input type='text'>" . '<br>';
echo "<input type=\"text\">" . '<br>';
$length = strlen($str) . '<br>'; // Длина определённой строки
echo $length . '<br>';
echo substr('substring!', 3, 5) . '<br>'; // Вернули символы начиная с 3 элемента, в количестве 6
echo str_replace('sub', 'replace', 'substring!') . '<br>'; // Pfvtyf ( какие символы, на что заменяем, какая строка )
echo str_replace(array('sub', 'ing'), '_', 'substring!') . '<br>';



echo trim(" sdf ") . '<br>'; // Убрать пробелы
//strtol в нижний регистр
//strtou в верхний регистр
echo md5("qwertge") . '<br>'; // Хеш пароля
unset($num); // Удаление переменной

$a = 5;
$b = &$a; // Создание ссылки с помощью амперсанта
$a = 10;
echo $a, $b . '<br>'; // В итоге вне зависимости от местоположения $b, зн. ссылки = 10
// Comment

define("PI", 3.14); // Константы без $, с большой буквы
echo PI . '<br>';
// Либо
const Name = 'Bob';
-$n;

// Переменная переменной:
$hello = "world";
$a = "hello";
echo $$a . '<br>'; // Выведет слово world ($hello=="world")

echo "{$number}сотых" . '<br>'; // Экранирование переменной


$a1 = "5 этажей";
$b1 = 5;
var_dump($a1 === $b1); // var_dump() для сравнения, ===тождественно равно, значения и типы равны

rand(10, 15);
round(4.5); // округляет до 5
floor(4.9); // округляет до 4
ceil(4.2); // округляет до 5

?>

<?php
echo "<br>";
require "../templates/footer.php";
?>