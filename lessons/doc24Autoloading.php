<?php
$title = "24 Автогрузка классов";
require_once  "../templates/header.php";
?>
<a>Представьте, что у нас теперь большой проект и в нём больше 100 классов.
    Нам придётся сто раз писать require с указанием каждого файла. Утомительно, да?
    Однако, можно автоматизировать этот процесс, написав функцию автозагрузки классов.
    Она будет вызываться каждый раз, когда впервые будет встречаться новый класс.
    Вы заметили, что мы одинаково называли папки, в которых лежат файлы и нейсмспейсы классов?
    Это мы делали не просто так, а для того, чтобы можно было преобразовать полное имя класса (включая его неймспейс) в путь до .php-файла с этим классом.</a>
<?php
//namespace MyProject\Articles;
//use MyProject\Models\Users\User; // Указать в начале файла о каком классе идёт речь, когда мы используем в коде только слово User. Делается это с помощью слова use после указания текущего неймспейса, но перед описанием класса.
// либо 'public function getAuthor(): \MyProject\Models\Users\User'

// загрузка файлов, указывается в начале файла index.php
//require __DIR__ . '/../src/MyProject/Models/Users/User.php';
//require __DIR__ . '/../src/MyProject/Models/Articles/Article.php';


// Автозагрузка файлов с разными наименованиями, используется когда файлов много. 
function myAutoLoader(string $className)
{
    //var_dump($className); // Проверка
    require_once __DIR__ . '/../src/' . $className . '.php';
}
/*
 Если используется композер, то spl_autoload_register удалить, так как за автозагрузку функций будет отвечать код, сгенерированный композером. Для проекта в composer.json писали:
"autoload": {
    "psr-4": {
        "MyProject\\": "src/MyProject/"
    }
},
Код без композера. В таком случае, функция называется анонимной – у неё нет имени. Она просто передаётся в качестве аргумента и имя ей не нужно:
*/
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});

// $author = new \MyProject\Models\Users\User('Иван');
// $article = new \MyProject\Models\Articles\Article('Заголовок', 'Текст', $author);
// echo "<pre>";
// var_dump($article);
// echo "/<pre>";
?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>