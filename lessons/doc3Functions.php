<?php
$title = "3 Встроенные функции";
require "../templates/header.php";
?>
<?php
$lis = [5, 7, 3, 6, 1, 8];
unset($lis[1]); // Удалить число в массиве в индексе 1
$lis = array_values($lis); // Обновление индексов
sort($lis); // Сортировка по возрастанию
rsort($lis); // Сортировка по убыванию
// shuffle($lis); // Разброс элементов рандомно

print_r($lis) . '<br>';

echo in_array(3, $lis) . '<br>'; // Проверка, 1 если true нашлось значение (3), пустая строка если false

$arr = array_slice($lis, 2, 2); // Обрезка массива от 2 индекса в количестве 2 элемента, при таких параметрах передаст массив со 2 индекса
var_dump($arr) . '<br>'; // Вывод как print_r(), но используется для объектов, выводит тип int

echo "<br>";
$arr_1 = [5, 7];
$arr_2 = [6, 8, 9];
$arr_3 = array_merge($arr_1, $arr_2); // Объединение массивов
print_r($arr_3);
echo "<br>";

echo "<br>";
$x = floatval("10"); // Преобразовать в float (double)
echo gettype($x) . '<br>'; // Получить тип переменной
echo is_numeric($x) . '<br>'; // Проверка является ли переменная числом (1 true при "10", пустое false при "10s")
echo is_integer($x) . '<br>'; // Проверка на тип integer

$str = "Example";
echo strpos($str, "p") . '<br>'; // Выводит позицию элемента

$words = "join,job,alex";
$arr_words = explode(",", $words); // разбиение строки по символу (,) в массив
print_r($arr_words) . '<br>';

echo '<br>' . implode(" | ", $arr_words); // объединение массива внутри строки

echo "<br>";
$string = '15-02-2022';
$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/'; // где [] допустимый диапазон, {} количество символов
$replacement = 'Год $3, месяц $2, день $1';
echo preg_replace($pattern, $replacement, $string); // Выполняет поиск по строке $string по специальному регулярному выражению $pattern.
// Если совпадения найдены, функция изменяет содержимое строки $replacement, при этом заменяет ссылки $3... на соответствующие им значения из под масок

?>

<?php
echo "<br>";
require "../templates/rightSidebar.php";
?>