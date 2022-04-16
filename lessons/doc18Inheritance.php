<?php
$title = "18 Наследование";
require_once  "../templates/header.php";
?>
<a>Объектно-ориентированный подход – взаимодействие между объектами.</ф>
    <?php

    // У автомобиля и велосипеда могут совпадать и различаться свойства 

    class Vehicle
    {
        public $color;
        public $speed;
        public $colbrandor;

        public function tripTime($distance) // Метод объявили 1 раз, но использовать можно для всех классов которые наследуются от Vehicle
        {
            $time = $distance / $this->speed;
            return $time;
        }

        // final для запрета определения метода (выскочет ошибка при переопределении в другом классе метода этого)
        // аналогично можно запретить определять классы (наследоваться)
        final public function test()
        {
        }
    }


    # Унаследуем класс
    class Bisycle extends Vehicle
    {
        public $type;
        public $color = 'White'; // Переопределяем свойство
        const CALORIES_PER_HOUR = 500;
        public function caloriesBurned($distance)
        {
            $time = $this->tripTime($distance);
            $calories = $time * self::CALORIES_PER_HOUR;
            return $calories;
        }

        # переопределяем метод
        public function tripTime($distance)
        {

            return  parent::tripTime($distance) * 1.2; // для экономия кода, чтобы не переписывать метод пишем parent для обращения к родительскому классу
            ;
        }
    }

    # Унаследуем класс
    class Car extends Vehicle
    {
        public $fuel;
        public function fuelConsumption($distance)
        {
            $result = ($this->fuel * $distance) / 100;
            return $result;
        }
    }

    $car1 = new Car;
    $car1->speed = 110;
    $car1->fuel = 12;

    $car2 = new Car;
    $car2->speed = 130;
    $car2->fuel = 14;

    $bicycle = new Bisycle;
    $bicycle->speed = 20;

    $distance = 100;
    echo '<br>Car1 time:' . $car1->tripTime($distance);
    echo '<br>Car2 time:' . $car2->tripTime($distance);
    echo '<br>Bisycle time:' . $bicycle->tripTime($distance);


    echo '<br>';
    echo '<br>Car1 fuelConsumption:' . $car1->fuelConsumption($distance);
    echo '<br>Car2 fuelConsumption:' . $car2->fuelConsumption($distance);
    echo '<br>Car1 Bicycle caloriesBurned:' . $bicycle->caloriesBurned($distance);
    ?>

    <?php
    echo "<br>";
    require_once  "../templates/footer.php";
    ?>