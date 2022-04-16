<?php
$title = "15 Остальное, языковые инструкции";
require_once  "../templates/header.php";
?>
<?php

// // Языковые инструкции
// // die & exit Для останвовки программы, ниже них не будет выполняться программа

// // eval Позволяет выполнить строку как php код
$a = 10;
$b = 7;
$string = '$c=$b+$a';
// eval($string); // не работает почему-то

// list позволяет преобразовать элементы массива в переменные
$array = array('Значение 1', 'Значение 2');
list($var1, $var2) = $array;
echo $var1 . '<br>' . $var2;




?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>