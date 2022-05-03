<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Catalog;

class CatalogController extends AbstractController
{
    public function catalog()  // Экшн страницы "Каталоги"
    {
        $this->view->renderHtml('catalogs/catalog.php', [
            'articles' => Catalog::getPage(1, 100),
        ]);
    }

    public function page(int $pageNum) // Экшн страниц каталогов
    {
        $amount = 8; // Количество статей на 1 странице
        $pagesCount = Article::getPagesCount($amount);
        $this->view->renderHtml('catalogs/products.php', [
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
}
