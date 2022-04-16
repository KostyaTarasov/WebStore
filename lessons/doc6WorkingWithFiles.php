<?php
$title = "6 Работа с файлами";
require_once  "../templates/header.php";
?>

<?php
// $file = fopen("text.txt","a"); // для чтения "r" не создаст файл, записи "w" создаст чистый файл для изменений, "a" дополнит файл
// fwrite($file, "\nExample text\nHello"); // fwrite Для записи данных
// fclose($file);

$filename = "text6.txt";

$file = fopen($filename, "r");
$content = fread($file, filesize($filename));  // fread Для считывания данных
fclose($file);

echo "<pre>" . $content . "</pre>";

file_put_contents("a6.txt", "Example\nHello"); // Создаёт файл и помещает в него текст
echo file_get_contents("a6.txt") . "<br>"; // Получит данные из файла   
echo file_exists("a6.txt") . "<br>"; // Проверка существует ли данный файл (вернёт 1)
// rename("a6.txt", "new_name6.txt"); // Замена файла
// unlink("new_name6.txt"); // Удалит файл

echo __FILE__ . "<br>"; // Вывод полного пути к файлу
echo fileperms(__FILE__) . "<br>"; // Права доступа к файлу
chmod(__FILE__, 0777); // Доступ к файлу, 0777 доступ для всех к файлу, 0000 всем запрещён доступ




?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>