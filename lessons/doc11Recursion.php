<?php
$title = "11 Рекурсия, функция вызывающая саму себя";
require_once  "../templates/header.php";
?>

<?php
// Рекурсия, функция вызывающая саму себя, например для многоуровневых вложенностях
// Пример:
$array = array(
    'Автотехника' => array(
        '(товар) Opel Vivaro' => 7,
        '(товар) Audi A6' => 2,
    ),
    '(товар) Велосипед BMX' => 3,
);

function sum($array, $level = 0)
{
    static $count;
    static $items;
    if (is_array($array)) { // Проверяем является ли массив массивом
        $level++; // Увеличиваем уровень вложенности
        foreach ($array as $element) {
            sum($element, $level); // Вызываем эту же функцию от большего уровня вложенности к меньшему
        }
    } else { // иначе при самой внутренней вложенности (данная строка не ялвяется массивом)='(товар) Opel Vivaro' => 7,
        $count++; // Количество товаров (3 строки: Opel Vivaro, Audi A6, Велосипед BMX)
        $items += $array; // количество на складе общее (7+2+3)
    }
    return array('count' => $count, 'items' => $items);
}

$result = sum($array); // Вызываем функцию sum с нашим массивом $array
print_r($result);
?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>