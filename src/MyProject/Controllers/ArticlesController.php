<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Images;
use MyProject\Models\Users\User;

//* Контроллер для работы со статьями (просмотр, добавление, обновление, удаление статей)
class ArticlesController extends AbstractController
{

    # Запрос в базу, в котором получим статью с нужным id
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
        $this->view->renderHtml('articles/view.php', [
            'nameTableCatalog' => Article::getTableName(),
            'article' => $article,
            'image' => Images::loadImage($articleId), // Для рендеринга изображения из бд
            //'author' => $articleAuthor
        ]);
    }


    # Обновление БД через Active Record, в routes.php прописывается edit()
    public function edit(int $articleId): void // Экшн http://localhost:8080/articles/1/edit
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            // $this->view->renderHtml('errors/404.php', [], 404);
            // return;
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        //* Исключение, чтобы редактировать могли только администраторы
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора'); // Бросаем исключение 403 пользователь с ролью user не может реадктировать статьи, нужна роль admin
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location:./', true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'image' => Images::loadImage($articleId),
        ]);


        // $article->setName('Новое название статьи5'); // Редактируем свойства у объекта Article
        // $article->setText('Новый текст статьи5');
        // //$article->setAuthorId('6'); // Аналогично можно создать другие методы set... в нужном классе ( Article для статей) и вызвать в этом файле

        // # Вызываем обновление бд, чтобы в неё передались новые значения свойств, чуть выше вы задали новые значения свойств с помощью setName() и setText()
        // $article->save(); // Мы имеем структуру, которая соответствует структуре в базе данных. Теперь на её основе можно построить запрос

        // echo "<pre>";
        // var_dump($article);
        // "</pre>";
    }

    //* Добавление статьи
    public function add(): void // Экшн http://localhost:8080/articles/add  через Active Record, в routes.php прописывается add()
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
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location:' . $article->getId() . '/', true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');

        // $author = User::getById(1);

        // $article = new Article();
        // $article->setAuthor($author);
        // $article->setName('Новое название статьи');
        // $article->setText('Новый текст статьи');

        // $article->save();

        // echo "<pre> Полученный массив после вызова метода add() в файле ArticlesController.php" . "<br>";
        // var_dump($article);
        // "</pre>";
    }

    # Удаление статьи через Active Record, в routes.php прописывается del()
    public function del(int $delArticleId): void // Экшн http://localhost:8080/articles/1/edit
    {
        if ($this->user === null) {
            throw new UnauthorizedException(); // 401) 
        }

        //* Исключение, чтобы удалять статью могли только администраторы
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для удаления статьи нужно обладать правами администратора'); // Бросаем исключение 403, пользователь с ролью user не может удалить статью, нужна роль admin
        }

        $article = Article::getById($delArticleId);
        if ($article === null) {
            throw new NotFoundException(); // 404
        }

        $article->delete(); // Вызов метода удаления статьи
        header('Location: /catalog');
    }
}
