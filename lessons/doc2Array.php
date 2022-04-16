<?php
$title = "2 Массивы и циклы";
require "../templates/header.php";
?>
<?php
# Массивы
echo '<h5>Одномерные массивы</h5>';

$arr11 = [1, 2, 3, 4, 5];
$arr22 = array_reverse($arr11); // Массив в обратном направлении
print_r($arr22);

// Одномерные массивы
$x = 5;
switch ($x) {
    case 5:
        echo "lol" . '<br>';
        break;
    default: // Если все предыдущие значения неверные
        echo "Default work!" . '<br>';
}

$nums = array(4, 5, 0.4, "hi", true);

$nums[1] = 45; // вместо 5 будет 45
echo $nums[1] . '<br>';

$nums = [4, 5, 7]; // Эквивалентная запись массива, вместо array сразу квадр. скобки
$nums[] = 6; // Добавили в конец массива число 6 (так как в скобках не указан индекс)
print_r($nums) . '<br>';

print_r(explode(',', 'Hello, world, hi')); // Вывод масссива, функция explode() разделяет строку на элементы по (,)
print_r(implode(',', array('sub', 'ing'))); // Объединяет массив в 1 строку

var_dump(in_array(3, $nums)); // Проверка содержит ли массив число 3 // false

array_values($nums); // Заменяет цифровые индексы [] на стандартные
echo '<pre>';
print_r(array_keys($nums)); // Заменяет value на значения индексов


$group1 = ['4' => 'Ваня', '7' => 'Алексей'];
$group2 = ['4' => 'Ваня', '6' => 'Антон'];
echo '<pre>';
print_r($group1 + $group2); // Объединились массивы по индексу, где ваня объединился по индексу
echo '</pre>';

echo '<pre>';
print_r(array_intersect($group1, $group2)); // Сгруппировались по схождению value, где ваня объединился по value
echo '</pre>';

array_diff($group1, $group2); // Находит расхождения массивов (наоборот)
#sort($goup1); // Сортируем массив по возрастанию value
#ksort($goup1); // Сортируем массив по ключам (индексам)


// Многомерные массивы
echo '<h5>Многомерные массивы</h5>';
$matrix = [ // Внутри массива указываются другие массивы(можно с помозью метода array(...))
    [4, 6.4, 8],
    [3, 2],
    [1, 5, 8, "9"]
];
echo $matrix[0][1] . '<br>';

$matrix[0][1] = 4;
echo $matrix[0][1] . '<br>';

echo '<h5>Ассоциативные массивы</h5>';
// Ассоциативные массивы, у них вместо индексов выступают ключи(названия)
$list = ["age" => 50, "name" => "Alex", 6 => 50]; // Вместо индекса выступает сразу ключ: age, name, 6
$list["name"] = "Bob";
echo $list["name"] . '<br>';
$list[2] = 4;


//Превращаем ассоц. массива в строку (к примеру применяется для куки)
$list2 = ["age" => 50, "name" => "Alex", "city" => "Moscow"];
$strAr =  serialize($list2); // serialize() Превращает ассоц. массив в строку

var_dump(unserialize($strAr)); // unserialize() Превращает строку в ассоц. массив 
print_r(unserialize($strAr)); // второй способ отображения массива


echo '<h5>Циклы</h5>';
for ($i = 30; $i > 20; $i -= 5)
    echo $i . '<br>';

while ($i <= 10) {
    $i++;
}

// do while отличается от обычного while тем что он 100% пройдётся первый раз
$i = 100;
do {
    echo $i . '<br>';
} while ($i < 10);


// Вывод одномерного массива
$list = [5, 7, 3, 8, "s"];
for ($i = 0; $i < count($list); $i++)
    echo " Element $i: $list[$i]<br>";


// Вывод одномерного массива
$arr = [5, 6, 8, 9];
foreach ($arr as $i => $value) // если без индексов то: foreach ($arr as $value)
{
    echo "Index: $i Value: $value.<br>";
}


// Вывод ассоициативного массива
$list = ["age" => 45, "name" => "Alex", "hobby" => "Footbal"];
print_r($list);

echo '<pre>'; // В тегах pre для вывода массива построчно 
print_r($list);
echo '</pre>';

foreach ($list as $item => $value) // Где $list массив, новые переменные: $item ключ, value значение ключа
{
    echo "$item $value<br>";
}


echo '<h5>Тернарынй оператор</h5>';
$status = true;
echo ($status) ? "Включен" : "Отключен";


echo '<h5>Функции</h5>';
function info($word)
{
    echo "$word<br>";
}


function math($x, $y)
{
    return $x + $y;
}

$res_1 = math(4, 6);
info($res_1);

function summary($arr)
{ // Функция принимает массив и высчитывает общую сумму массива
    $summa = 0;
    foreach ($arr as $value) {
        $summa += $value;
    }
    return $summa;
}


$list = [5, 7, 3];
echo summary($list) . "<br>";
echo summary([5, 2, 3]) . "<br>";

echo '<h6>Глобальные переменные</h6>';
$name3 = 'Михаил';
function info2()
{
    global $x; // Чтобы обратиться к гл. перем.
    $x = 22;

    echo $GLOBALS['name3'] . "<br>"; // Чтобы обратиться к гл. перем.
}
$x = 10;
info2();
echo $x . "<br>";


echo '<h6>Статически переменные</h6>';
function staticNum()
{
    $num123 = 0; // Даже с этой строчкой $num123 будет статичным , не обнулится, а увеличится 1, 2, 3
    static $num123; // По умолчанию без иниц также = 0
    $num123++;
    echo $num123 . "<br>";
}

staticNum();
staticNum();
staticNum();


echo '<h6>Амперсанты & (передача переменной по ссылке)</h6>';
function info4(&$beta) // В фукнцию переменная попадает по ссылке благодарая амперсанту &
{
    $beta = 44;
}
$beta = 11;
info4($beta); // Передаём переменную $beta=55 по ссылке
echo $beta . "<br>"; // 55


function myFunction($name = 'Пользователь по умолчанию')
{
    echo $name . "<br>";
}
myFunction('Виктор') . "<br>"; // Выводится указанное значение
myFunction(); // Выводится значение по умолчанию


// break полностью выходит из цикла for
// continue начнётся следующий круг цикла for , (Пропускает текущую итерацию цикла)
?>
<?php
echo "<br>";
require "../templates/footer.php";
?>