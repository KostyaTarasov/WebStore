<?php
$title = "20 Полиморфизм";
require_once  "../templates/header.php";
?>
<?php

// Полиморфизм - это возможность создавать разные реализации(методы), используя одинаковый интерфейс(вызывались одинаково printItem())

class Publication
{
    public $id;
    public $title;
    public $date;
    public $short_content;
    public $content;
    public $preview;
    public $author_name;
    public $type;

    function __construct($row) // Для второго примера, работы с базой данных
    {
        $this->id = $row['id']; // Присваиваем свойствам значения из массива $row (из файла c_data20.php и базы данных)
        $this->title = $row['title'];
        $this->date = $row['date'];
        $this->short_content = $row['short_content'];
        $this->content = $row['content'];
        $this->preview = $row['preview'];
        $this->author_name = $row['author_name'];
        $this->type = $row['type'];
    }
}

class NewsPublication extends Publication
{
    #Полиморфизм - мы пишем одинаковый код printItem() для объектов разных классов, 
    #но при этом вызываться будут разные методы (в каждом классе свой метод)
    public function printItem()
    {
        echo '<br>Вызван метод' . __METHOD__;
        echo '<br> Новость:' . $this->title;
        echo '<br> Дата:' . $this->date;
        echo '<hr>';
    }
}

class ArtilcePublication extends Publication
{

    public function printItem()
    {
        echo '<br>Вызван метод' . __METHOD__;
        echo '<br>Статья:' . $this->title;
        echo '<br>Автор:' . $this->author_name;
        echo '<hr>';
    }
}

class PhotoReportPublication extends Publication
{
    public function printItem()
    {
        echo '<br>Вызван метод' . __METHOD__;
        echo '<br>Фотоотчет:' . $this->title;
        echo '<br><img src="http://localhost:8080' . $this->preview . '">';
        echo '<hr>';
    }
}

?>

<br><br>
<a href="c_data20.php">Страница c_data20.php</a><br>
<a href="c_publications20.php">Страница c_publications20.php</a>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>