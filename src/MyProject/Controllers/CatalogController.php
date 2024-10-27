<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Catalog;
use MyProject\Models\Articles\Products;
use MyProject\Models\Articles\Images;

class CatalogController extends AbstractController
{
    public function catalog()  // Экшн страницы "Каталоги"
    {
        $this->view->renderHtml('catalogs/catalog.php', [
            'articles' => Catalog::removePopularCatalogs(Catalog::getPage(1, 100)),
        ]);
    }

    public function firstPage() // Экшн первой страницы определённого каталога товаров
    {
        $this->page(1);
    }

    public function page(int $pageNum) // Экшн страницы определённого каталога товаров
    {
        $nameTableCatalog = Catalog::getCatalogName();
        $catalogId = Catalog::getCatalogIdByName($nameTableCatalog);
        if (!$nameTableCatalog) {
            throw new \MyProject\Exceptions\NotFoundException();
        }
        $amount = 8; // Количество статей на каждой странице
        $pagesCount = Products::getPagesCount($amount, $catalogId); // Вызываем метод для подсчёта колич. страниц, в параметрах количество записей 5 на одной странице

        $this->view->renderHtml('catalogs/products.php', [
            'nameCatalog' => Article::getNameCatalog($nameTableCatalog),
            'nameTableCatalog' => $nameTableCatalog,
            'articles' => Products::getPage($pageNum, $amount, $catalogId),
            'pagesCount' => $pagesCount,
            'currentPageNum' => $pageNum, // передаём номер текущей страницы в шаблон
            'previousPageLink' => $pageNum > 1
                ? ($pageNum - 1)
                : null,
            'nextPageLink' => $pageNum < $pagesCount
                ? ($pageNum + 1)
                : null
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
                (new Catalog)->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('catalogs/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location:' . '/catalog', true, 302);
            exit();
        }

        $this->view->renderHtml('catalogs/add.php');
    }

    public function edit(int $catalogId): void
    {
        $catalog = Catalog::getById($catalogId);

        if ($catalog === null) {
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
                $catalog->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('catalogs/edit.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /catalog', true, 302);
            exit();
        }

        $this->view->renderHtml('catalogs/edit.php', [
            'article' => $catalog,
            'image' => Images::loadImage($catalogId),
        ]);
    }

    public function del(int $catalogId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для удаления статьи нужно обладать правами администратора');
        }

        $catalog = Catalog::getById($catalogId);
        if ($catalog === null) {
            throw new NotFoundException();
        }

        $catalog->delete(); // Вызов метода удаления статьи
        header('Location: /catalog', true, 302);
    }
}
