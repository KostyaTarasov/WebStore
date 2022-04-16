<?php
$title = "16 ООП Классы и Методы";
require_once  "../templates/header.php";
?>
<?php


#   -> используется для доступа к свойствам объекта.

class Car
{   # Класс -  чертёж
    public $color = 'White';    // Свойства - переменные являющиеся членами класса
    public $speed;
    public $fuel;
    public $brand;

    public function test1()
    {
        echo '<br>Тест функции1';

        # Обращение к константе данного класса
        echo '<br>' . self::WHEELS; // При помощи self мы обращаемся ко всему классу!
    }

    public function tripTime($distance)
    {   # Метод
        $time = $distance / $this->speed; // $this является ссылкой на объект $car1 // Для получения доступа к объекту $car1 !
        return $time;
    }


    # Константы класса
    const WHEELS = 3; // константа принадлежит классу


    #  Статические Свойства и Методы принадлежат классу целиком, а не созданным объектам этого класса. То есть использовать их можно даже без создания объектов.  
    // Если свойство или метод характеризует сам класс тогда используем static // Для общих характеристик, а не конкретных
    public static $engine = 1; // свойство статическое

    public static function whatIsIt()  // метод статический
    {
        echo 'Автомобиль-моторное дорожное средство';
    }
}

echo '<h3>Константы, статически методы и свойства</h3>';
echo Car::WHEELS; // Обращение к константе указанного класса

echo Car::$engine; // Доступ к статическому свойству
Car::whatIsIt(); // Вызов статического метода

echo '<br>';
echo '<br>';

echo '<h3>Объекты класса</h3>';

$car1 = new Car; // создаём Объект класса Car

$car1->brand = 'Audi'; // Задаём занчения свойствам для объектов класса
$car1->speed = 110;
$car1->fuel = 12;


$car2 = new Car;
$car2->brand = 'Mercedes'; // Задаём значения свойствам для объектов класса
$car2->speed = 130;
$car2->fuel = 14;
$car2->color = 'Green';

echo '<pre>';
print_r($car1);
print_r($car2);
echo $car2->color;
$car2->test1(); // Вызывается функция, сразу вывод на экран информации

echo '<br>Тест метода tripTime' . $car1->tripTime(1000); // Можно использовать разные объекты класса $car1, $car2 у которых имеются разные свойства(разная скорость speed)
echo '<br>Тест метода tripTime' . $car2->tripTime(1000);
?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>