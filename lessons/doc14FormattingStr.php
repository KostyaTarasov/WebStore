<?php
$title = "14 Форматирование строк";
require_once  "../templates/header.php";
?>
<?php

// Форматирование строк
$city = 'Лондон';
$precent = 5567.345345345;
$total = 1000;
$format = '%3$s Для числа с плавающей точкой: %1$.2f, Для int числа: %2$d, Для строки %2$s'; //округление для чисел с пл. точкой
//  $format указаны в порядковом номере, для смены порядка 3$ указывает на 3 место
printf($format, $precent, $total, $city);

$result = sprintf($format, $precent, $total, $city); // Тоже самое, но её можно присвоить переменной
print_r($result);






?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>