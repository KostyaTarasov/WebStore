<?php
$title = "12 Работа с датой и временем";
require "../templates/header.php";
?>

<?php
// https://www.php.net/manual/ru/datetime.format.php
echo date('Y-m-d H:i:s', time() - 10000) . '<br>';
echo date('Y-m-d H:i:s', strtotime("now")) . '<br>';
echo date('Y-m-d H:i:s', strtotime("-1 Week -2 Day -3 Hour")) . '<br>';
echo date('Y-m-d H:i:s', strtotime("last Monday")) . '<br>';

echo '<pre>';
print_r(getdate()); // Другой способ
echo '<pre>';

echo time(); // колич секунд, т.е. время от 1 января 1970 начало эпохи Unix до сейчас
?>

<?php
echo "<br>";
require "../templates/footer.php";
?>