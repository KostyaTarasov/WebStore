<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main()
    {
        $this->page(1);
    }
    
    public function page(int $pageNum) // Экшн страниц каталогов
    {
        $amount = 4; // Количество статей на 1 странице
        $pagesCount = Article::getPagesCount($amount);
        $this->view->renderHtml('main/main.php', [
            'articles' => Article::getPage($pageNum, $amount),
            'pagesCount' => Article::getPagesCount($amount), // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? ($pageNum + 1)
                : null
        ]);
    }

    public function sayHello(string $name) // Необязательный функционал приветствия
    {
        // echo 'Привет, ' . $name; // Без шаблона
        $this->view->renderHtml('main/hello.php', ['name' => $name]); // Где view путь до папки templates
    }
}
