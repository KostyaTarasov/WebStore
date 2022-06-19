<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\News;

class NewsController extends AbstractController
{
    public function newsFirstPage() // Экшн первой страницы определённого каталога товаров
    {
        $this->newsPage(1);
    }

    public function newsPage(int $pageNum) // Экшн страницы определённого каталога товаров
    {
        $amount = 20; // Количество статей на каждой странице
        $pagesCount = Article::getPagesCount($amount);
        $this->view->renderHtml('news/news.php', [
            'articles' => Article::getPage($pageNum, $amount),
            'pagesCount' => Article::getPagesCount($amount), // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей на одной странице
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? ($pageNum + 1)
                : null
        ]);
    }
}
