<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\News;
use MyProject\Models\Articles\Catalog;
use MyProject\Models\Articles\Products;

class MainController extends AbstractController
{
    public function main()
    {
        $this->page(1);
    }

    public function page(int $pageNum) // Экшн страниц каталогов
    {
        $amount = 7; // Количество статей на 1 странице
        $catalogId = Catalog::getCatalogIdByName('popularnye_tovary');
        $pagesCount = Products::getPagesCount($amount, $catalogId); // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице
        $this->view->renderHtml('main/main.php', [
            'articles' => Products::getPage($pageNum, $amount, $catalogId),
            'catalog' => Catalog::removePopularCatalogs(Catalog::getPage($pageNum, 12)),
            'pagesCount' => $pagesCount,
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? ($pageNum + 1)
                : null,
            'news' => News::getPage(1, 3),
        ]);
    }

    public function sayHello(string $name) // Необязательный функционал приветствия
    {
        // echo 'Привет, ' . $name; // Без шаблона
        $this->view->renderHtml('main/hello.php', ['name' => $name]); // Где view путь до папки templates
    }
}
