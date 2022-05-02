<?php
$title = "26 Reflection API";
require_once  "../templates/header.php";
?>
<?php
/*
Reflection (отражение) - Программа во время своего выполнения может в реальном времени «узнавать» о своём состоянии и изменять своё поведение

инструменты для рефлексии, о которых мы уже знаем. Языковые конструкции self и static, магические константы __DIR__ и __CLASS__, функции get_defined_vars(), func_get_args() или eval(). 
В конце концов возможность создавать объект класса, имя которого хранится в переменной: $obj = new $className();
а затем и вызов метода, название которого так же хранится в переменной: $obj->$methodName();

PHP Reflection API – это набор специальных классов-рефлекторов, позволяющих вывести рефлексию на новый уровень. С помощью этих классов мы можем создавать объекты-рефлекторы для разных типов данных в PHP, которые позволят творить с ними всё что только вздумается.

# Все Reflection: https://www.php.net/manual/ru/book.reflection.php
*/

/**
 * @param $a
 * @param $b
 * @return int
 */
function sum($a, $b)
{
    return $a + $b;
}

$sumReflector = new ReflectionFunction('sum'); // класс-рефлектор сообщает информацию о функциях. подробнее: https://www.php.net/manual/ru/class.reflectionfunction.php
echo $sumReflector->getFileName(); // узнать в каком файле объявлена функция
echo "<br>";
echo $sumReflector->getStartLine(); // узнать номер строки начала функции 'sum'
echo "<br>";
echo $sumReflector->getEndLine(); // узнать номер строки конца функции 'sum'
echo "<br>";
echo $sumReflector->getDocComment(); // получить комментарий к функции в формате PHPDoc

/*
Помимо этого можно создавать рефлекторы объектов. 
Объект-рефлектор для сущности Article. В файле ArticlesController рефлектор для вывода свойств объекта Article

Ещё методы для рефлектора объектов:
Получить все методы:
->getMethods()

Получить все константы:
->getConstants()

Создание нового объекта (даже с непубличным конструктором)
->newInstance()

Создание нового объекта без вызова конструктора (o_O)
->newInstanceWithoutConstructor()
*/
?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>