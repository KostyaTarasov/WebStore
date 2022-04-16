<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\SearchModel;
use MyProject\Exceptions\InvalidArgumentException;

session_start();
//* Контроллер для поиска
class SearchController extends AbstractController
{
    protected $foundResult;

    public function searchFunction() // Имя метода, который указан в routes.php
    {
            if (!empty($_POST)) {
                try {
                    $this->foundResult = SearchModel::searchArticle($_POST);
                    $_SESSION['postSearch'] = $_POST;
                    $_SESSION['countArticle'] = count($this->foundResult);
                    // foreach ($this->foundResult as $item2) {
                    //     foreach ($item2 as $item) {
                    //         $b[] = $item;
                    //     }
                    //     $numberIdArticles[] = $b[0];
                    //     unset($b);
                    // }
                } catch (InvalidArgumentException $e) {

                    //throw new InvalidArgumentException('Нет найденной статьи');
                    header('Location: /'); // Открытие главной страницы сайта
                    exit();
                    //$this->view->renderHtml('main/main.php', ['error' => $e->getMessage()]);
                    //return;
                }
            } else {
                $this->view->renderHtml('main/main.php');
            }
            $this->page(1);
    }

    public function page(int $pageNum) // Экшн страниц статей
    {
        //$pagesCount = SearchModel::getPagesCount(5, $this->foundResult);
        $pagesCount = SearchModel::getPagesCount(5, $_SESSION['countArticle']);
        $this->view->renderHtml('main/search.php', [

            'articles' => SearchModel::getPage($pageNum, 5, $_SESSION['postSearch']), // Для вывода только 5 записей
            //'articles' => $this->foundResult,

            //'pagesCount' => SearchModel::getPagesCount(5, $this->foundResult), // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице
            'pagesCount' => SearchModel::getPagesCount(5, $_SESSION['countArticle']),
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон

            'previousPageLink' => $pageNum > 1
                ? '/search/' . ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? '/search/' . ($pageNum + 1)
                : null
        ]);
    }
}
