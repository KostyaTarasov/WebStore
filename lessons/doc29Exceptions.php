<?php
$title = "29 Исключения";
require_once  "../templates/header.php";
?>
<?php

func1();

function func1()
{
    try {
        // какой-то код
        func2();
    } catch (Exception $e) {
        echo 'Было поймано исключение: ' . $e->getMessage() . '. Код: ' . $e->getCode() . "<br>"; // Поймано
    }

    echo 'А теперь выполнится этот код';
}

function func2()
{
    // какой-то код
    func3();
}

function func3()
{
    // код, в котором возможна исключительная ситуация
    throw new Exception('Ошибка при подключении к БД', 123); // исключение будет подниматься по стеку вызовов выше и выше (от func3 к func1), до тех пор, пока оно не будет поймано в func1.

    echo 'Этот код не выполнится, так как идет после места, где было брошено исключение';
}


// try {
//     // тут какой-то код
// } catch (DbException $e) {
//     // обработка исключений, связанных с базой данных
// } catch (FileSystemException $e) {
//     // обработка исключений, связанных с файловой системой
// }


// Пример присутствует в index.php, Db.php и в ArticlesController.php
// if (!$isRouteFound) { // Если страница не найдена (роут не найден)
//     throw new \MyProject\Exceptions\NotFoundException(); // Бросаем исключение
// }

// } catch (\MyProject\Exceptions\DbException $e) { // Ловим исключение если не подкл к базе данных
//     $view = new \MyProject\View\View(__DIR__ . './templates/errors');
//     $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
// } catch (\MyProject\Exceptions\NotFoundException $e) { // Ловим исключение если нету такой страницы
//     $view = new \MyProject\View\View(__DIR__ . './templates/errors');
//     $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
// }

// Throwable является родительским интерфейсом для всех объектов, выбрасывающихся с помощью выражения throw, включая классы Error и Exception.

?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>