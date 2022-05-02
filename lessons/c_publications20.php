<?php
$title = "Publications 20 Полиморфизм";
require_once  "../templates/header.php";
require_once "c_data20.php";
?>

<?php
foreach ($publications as $item) {

    // первый пример

    //  echo '<pre>';
    // echo 'В переменой $item находится объект класса: '.get_class($item);
    // // Смотрим для какого объекта $item (разные классы) будет вызван метод
    //  print_r($item->printItem()); // Обращаемся к созданному методу в основном файле. Если вызвать просто item, то будет отображён массив, хранящий в себе все объекты с 8 переменными id, tittle, data...
    //  echo '</pre>';

    // Второй пример
    $item->printItem();
}
?>

<br><br>
<a href="doc20Polymorphism.php">Страница doc20Polymorphism.php</a><br>
<a href="c_data20.php.php">Страница c_data20.php.php</a>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>