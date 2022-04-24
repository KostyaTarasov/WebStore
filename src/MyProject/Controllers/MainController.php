<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{

    public function main()
    {
        //echo 'Привет, Гость';

        // $articles = [
        //     ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
        //     ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        // ];
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]); // имя файла, массив который надо извлечь в переменную


        # Пример для SQL БД : my_project
        // $articles = $this->db->query('SELECT * FROM `articles`;');
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class); // в качестве класса передать имя класса Article, свойства будут переданы из класса Article, 
        // В случае не соответствия свойств с именами столбцов из бд SQL то свойства заменятся именами столбцов
        // Эту проблему с несоответствием имён легко решить с помощью метода __set($name, $value) прописав в классе Article
        // если __set добавить в класс и попытаться задать ему несуществующее свойство, то вместо динамического добавления такого свойства, будет вызван этот метод. При этом в первый аргумент $name, попадёт имя свойства, а во второй аргумент $value – его значение


        /* для вывода всех статей на 1 странице.
        $articles = Article::findAll(); // получаем статьи в контроллере, (для паттерна AR), благодаря этому способу Пропала зависимость от базы данных
        // echo '<pre>';
        //var_dump($articles); // Вывод массива из БД на экран
        // echo '</pre>';
        //return; При этой строке не будет выполняться дальнейший код, 

        #рендеринг страницы со всеми статьями
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
        ]);
        */

        $this->page(1); // Для вывода статей постранично (с пагинацией)
    }

    public function page(int $pageNum) // Экшн страниц статей
    {
        $amount=8; // Количество статей на 1 странице
        $pagesCount = Article::getPagesCount($amount);
        $this->view->renderHtml('main/main.php', [
            'articles' => Article::getPage($pageNum, $amount),
            'pagesCount' => Article::getPagesCount($amount), // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон

            'previousPageLink' => $pageNum > 1
                ? '/' . ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? '/' . ($pageNum + 1)
                : null
        ]);
    }

    public function sayHello(string $name) // Необязательный функционал приветствия
    {
        // echo 'Привет, ' . $name; // Без шаблона
        $this->view->renderHtml('main/hello.php', ['name' => $name]); // Где view путь до папки templates
    }
}
