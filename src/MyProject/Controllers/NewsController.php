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

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            // $this->view->renderHtml('errors/404.php', [], 404);
            // return;
            throw new NotFoundException();
        }

        # Рефлектор для вывода свойств объекта Article
        $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName(); // getName() возвращает имя класса
        }


        # Получение нужного юзера:
        //$articleAuthor = User::getById($article->getAuthorId());
        $this->view->renderHtml('news/view.php', [
            'nameTableCatalog' => Article::getTableName(),
            'article' => $article,
            'image' => Images::loadImage($articleId), // Для рендеринга изображения из бд
            //'author' => $articleAuthor
        ]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        //* Если удалить данное исключение, то создавать статью сможет любой зарегистрированный пользователь (не только с ролью admin)
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления статьи нужно обладать правами администратора'); // Исключение 403 пользователь с ролью user не может создавать статьи, нужна роль admin
        }

        if (!empty($_POST)) {
            try {
                News::createFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location:' . '/', true, 302);
            exit();
        }

        $this->view->renderHtml('news/add.php');
    }
}
