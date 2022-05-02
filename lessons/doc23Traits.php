<?php
$title = "23 Трейты";
require_once  "../templates/header.php";
?>
<a>Трейты в PHP – это такой механизм, который позволяет внутри классов избегать повторного использования кода.</a><br><br>
<?php

//  интерфейс будет обязывать классы иметь метод sayYourClass()  (не обязаталеьно писать интерфейс)
interface ISayYourClass
{
    public function sayYourClass(): string;
}

trait SayYourClassTrait // Трейт используется, чтобы не дублировать метод в классах sayYourClass()
{
    public function sayYourClass(): string
    {
        return 'My class is ' . self::class; // self текущий класс для объекта $man будет Man, для $box Box
    }
}

class Man implements ISayYourClass
{
    use SayYourClassTrait; // конструкция use чтобы использовать трейт
}

class Box implements ISayYourClass
{
    use SayYourClassTrait;
}

$man = new Man();
$box = new Box();

echo $man->sayYourClass();
echo $box->sayYourClass();
?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>