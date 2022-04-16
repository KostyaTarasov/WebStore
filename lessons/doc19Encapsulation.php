<?php
$title = "19 Икапсуляция";
require_once  "../templates/header.php";
?>
<?php

# Инкапсуляция для ограничеия доступа одних компонентов программы к другим

# Модификаторы доступа определяют возможность получения доступа к членам класса (свойствам и методам) из разых мест программы.

# protected позволяет получать доступ текущему классу ( в котором определён сам член класса) и наследуемым классам.
# private доступ к члену класса имеет только класс, в котором он объявлен

class Base
{
    public $a = 'a public';
    protected $b = 'b protected_1';
    private $c = 'c private';

    function printPropetries()
    {
        echo '<br>' . $this->a; // Выводятся
        echo '<br>' . $this->b; // Выводятся
        echo '<br>' . $this->c; // Выводятся       
    }
}

$obj = new Base();
echo '<br>' . $obj->a;   // разрешают обращаться вне класса
//echo '<br>'.$obj->b; // запрещают обращаться вне класса
//echo '<br>'.$obj->c; // запрещают обращаться вне класса

$obj->printPropetries(); // мод.доступа разрешают обращаться внутри данного класса // вывод выполняется внутри класса

echo '<br>';




class Inherited extends Base
{
    function printPropetries2()
    {
        echo $this->a;
        echo $this->b;
        echo $this->c; // вообще не знает о приватном свойстве с
    }
}

$obj2 = new Inherited;
echo '<br>' . $obj2->a; // разрешают обращаться вне класса
//echo '<br>'.$obj2->b; // ошибка у protected
//echo '<br>'.$obj2->c; // Неопределён private
echo '<br>';
$obj2->printPropetries2(); // a и b вывелись, b получили по наследству от класса Base внутри класса Inherited, но не снаружи

?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>