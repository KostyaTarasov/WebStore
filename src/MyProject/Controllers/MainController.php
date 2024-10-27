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
        $catalog = Catalog::getPage($pageNum, 12);
        $amount = 7; // Количество статей на 1 странице
        $pagesCount = Products::getPagesCount($amount, null, true); // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице
        $this->view->renderHtml('main/main.php', [
            'articles' => Products::getPage($pageNum, $amount, null, true),
            'catalog' => $catalog,
            'mapCatalog' => Catalog::mapCatalogByCpuName($catalog),
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
