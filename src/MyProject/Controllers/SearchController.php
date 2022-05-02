<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\SearchModel;
use MyProject\Exceptions\InvalidArgumentException;

session_start();
//* Контроллер для поиска
class SearchController extends AbstractController
{
    public function searchFunction() // Имя метода, который указан в routes.php
    {
        if ($_POST['search'] != "") {
            try {
                $_SESSION['postSearch'] = $_POST;
                $_SESSION['countArticle'] = SearchModel::countArticles($_POST);
            } catch (InvalidArgumentException $e) { // Если поиск ничего не нашёл
                // подключаем файл с нужным шаблоном, получив путь до него, склеив пути до папки с шаблонами и именем конкретного шаблона
                // поток вывода(html, echo, вывод данных) положить во временный буфер вывода
                # профит в том, что мы можем обрабатывать ошибки, возникшие в процессе работы с шаблоном
                $this->view->renderHtml('features/searchPage.php', [
                    'error' => $e->getMessage()
                ]);
                return;
            }
        } else { // Если пользователь не ввёл ничего в поисковик
            header('Location: /');
            return;
        }
        $this->page(1);
    }

    public function page(int $pageNum) // Экшн страниц статей
    {
        $pagesCount = SearchModel::getPagesCount(5, $_SESSION['countArticle']);
        $this->view->renderHtml('features/searchPage.php', [
            'articles' => SearchModel::getPage($pageNum, 5, $_SESSION['postSearch']), // Для вывода по 5 записей на n странице
            'pagesCount' => $pagesCount,
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? '/searchPage/' . ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? '/searchPage/' . ($pageNum + 1)
                : null
        ]);
    }
}
