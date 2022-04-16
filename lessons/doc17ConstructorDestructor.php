<?php
$title = "17 Конструкторы и деструкторы";
require_once  "../templates/header.php";
?>
<?php

// Соединение с базой данных при создании объекта автоматически, при помощи констр
// Создание объекта автоматически с помощью конструктора
// Конструктор это метод, который вызываеся каждый раз создании объектов $human1 = new Human(); $human2 = new Human();, 
// Конструктор используется для инициализации - создания начальных значений
// Деструктор это метод, который вызываеся при удалении объекта (конца выполнения программы)

class Car
{
    public $color = 'White';    // Свойства - переменные являющиеся членами класса
    public $speed;
    public $fuel;
    public $brand;

    //public function __construct($brand,$speed,$fuel, $color){ 
    public function __construct($brand = 17, $speed = 156, $fuel = 300, $color = 'Pink')
    { // значения по умолчанию можно сразу определить

        echo '<br>Новый объект класса' . __CLASS__ . 'создан';
        echo '<br>Метод' . __METHOD__ . 'вызван';
        $this->brand = $brand;
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->color = $color;
        echo '<br>' . $color;
    }

    public function __destruct()
    {
        echo '<br>Новый объект класса' . __CLASS__ . 'создан';
        echo '<br>Метод' . __METHOD__ . 'вызван';
    }

    public function tripTime($distance)
    { // Метод
        $time = $distance / $this->speed; // $this является ссылкой на объект $car1
        return $time;
    }
}

$car1 = new Car('Audi', 130, 14, 'Black'); // при создании объекта вызывается __construct(), данные параметры будут при инициализации
$car2 = new Car('BMW', 300, 25, 'Yellow');
$car3 = new Car; // будут использоваться значения по умолчанию объявленные в самом __construct(...)
$car4 = new Car; // будут использоваться значения по умолчанию объявленные в самом __construct(...)

$car4->brand = 'Mercedes'; // Параметры можно менять и после
$car4->speed = 650;
$car4->fuel = 19;
$car4->color = 'Brown';

echo '<br>Результат1:' . $car1->tripTime(1000);
echo '<br>Результат2:' . $car2->tripTime(1000);
echo '<br>Результат3:' . $car3->tripTime(1000);
echo '<br>Результат4:' . $car4->tripTime(1000); // Выдаст результат при новых параметрах
unset($car1); // при удалении объекта вызывается __destruct()




// Ещё пример конструктора и статического свойства $count:
class Human
{
    private static $count = 0; // статическое свойство принадлежит классу, а не объектам // приватная, чтобы изменять её можно было только внутри класса

    public function __construct() // Конструктор
    {
        self::$count++; // self указывает на класс Human
    }

    public static function getCount() // Геттер вернёт готовый результат 3
    {
        return self::$count;
    }
}
$human1 = new Human(); // При каждом создании объекта вызывается конструктор // Можно в конструкторе указать string $text, User $author,то в параметрах при создании объекта $human1 укажется  new Human('Заголовок', 'Текст', $author); где $author = new User('Иван');
$human2 = new Human();
$human3 = new Human();
echo 'Людей уже ' . Human::getCount(); // 3






?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>

<!-- По окончанию выполнения программы вызывается __destruct() -->