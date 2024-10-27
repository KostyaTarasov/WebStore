<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\News;
use MyProject\Models\Articles\Images;

class NewsController extends AbstractController
{
    public function newsFirstPage() // Экшн первой страницы определённого каталога товаров
    {
        $this->newsPage(1);
    }

    public function newsPage(int $pageNum) // Экшн страницы определённого каталога товаров
    {
        $amount = 20; // Количество статей на каждой странице
        $pagesCount = News::getPagesCount($amount);
        $this->view->renderHtml('news/news.php', [
            'articles' => News::getPage($pageNum, $amount),
            'pagesCount' => News::getPagesCount($amount), // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей на одной странице
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
        $article = News::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName(); // getName() возвращает имя класса
        }

        $this->view->renderHtml('news/view.php', [
            'nameTableCatalog' => Article::getTableName(),
            'article' => $article,
            'image' => Images::loadImage($articleId), // Для рендеринга изображения из бд
            //'author' => User::getById($article->getAuthorId())
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
                Article::createFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location:' . '/news', true, 302);
            exit();
        }

        $this->view->renderHtml('news/add.php');
    }

    public function edit(int $articleId): void
    {
        $news = News::getById($articleId);

        if ($news === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $news->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/edit.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /news', true, 302);
            exit();
        }

        $this->view->renderHtml('news/edit.php', [
            'article' => $news,
            'image' => Images::loadImage($articleId),
        ]);
    }

    public function del(int $delArticleId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException(); // 401) 
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для удаления статьи нужно обладать правами администратора'); // Бросаем исключение 403, пользователь с ролью user не может удалить статью, нужна роль admin
        }

        $news = News::getById($delArticleId);
        if ($news === null) {
            throw new NotFoundException(); // 404
        }

        $news->delete(); // Вызов метода удаления статьи
        header('Location: /news', true, 302);
    }
}
