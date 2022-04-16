<?php
$title = "Data 20 Полиморфизм";
require_once  "../templates/header.php";
require_once 'doc20Polymorphism.php';
?>

<?php

// //Пример первый, с помощью полиморфизма вывод (файл c_publications20) на экран новости, статьи, фотоотчёта
// $obNews1=new NewsPublication; // Создаём объекты классов(созданы в основном файле)
// $obNews2=new NewsPublication;
// $obNews3=new NewsPublication;
// $obArticle1=new ArtilcePublication;
// $obArticle2=new ArtilcePublication;
// $obPhoto1=new PhotoReportPublication;
// $obPhoto2=new PhotoReportPublication;
// $obPhoto3=new PhotoReportPublication;

// $publications=array($obNews1,$obNews2,$obArticle1,$obPhoto1,$obPhoto2); // 5 проходов по массиву в дальнейшем будут
// //echo '<pre>';
// //print_r($publications)


// Второй пример
// Выгрузка из базы данных
$publications = array();

# connect to database
$con = mysqli_connect("localhost:8889", "root", "root", "doc20polymorphism"); // имя базы данных в корне phpMyAdmin

if (mysqli_connect_errno()) {
    echo "Ошибка соединения с MySQL:" . mysqli_connect_error();
}

// make query
$result = mysqli_query($con, "SELECT * FROM publication");

// work with results
while ($row = mysqli_fetch_array($result)) {
    // в переменной $row содержится массив с полями нашей записи, поэтому выведем поле title и type из базы данных
    // echo '<br>' . $row['title'];
    // echo '<br>' . $row['type'];

    //Работает плохо
    $publications[] = new PhotoReportPublication($row); // заполнение массива объектами класса
    //$publications[] = new $row['type']; // заполнение массива объектами класса

    // Не доделан пример, не выводятся имена объектов и меняются только title   
    //$publications[] =  new $row['type']($row);  //   new NewsPublication($row) = подставлено будет слово соответствующее названию класса




    // echo '<pre>';
    //  print_r($publications);
    //  echo '</pre>';   

}
echo '<pre>';
print_r($publications);
//var_dump($publications);
echo '</pre>';

?>

<br><br>
<a href="doc20Polymorphism.php">Страница doc20Polymorphism.php</a><br>
<a href="c_publications20.php">Страница c_publications20.php</a>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>