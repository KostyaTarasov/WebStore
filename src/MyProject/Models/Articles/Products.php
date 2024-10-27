<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class Products extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected  $text;

    /** @var int */
    protected  $price;

    /** @var string */
    protected  $authorId;

    /** @var string */
    protected  $createdAt;

    protected  $content;

    /** @var int */
    protected  $catalog_id;

    public static function getTableName(): string
    {
        return 'products';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return htmlentities($this->name);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return htmlentities($this->text); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return htmlentities($this->price);
    }

    /**
     * @return int
     */
    public function getAuthor(): User
    {
        $this->authorId;
        return User::getById($this->authorId);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return mb_substr($this->createdAt, 0, 10);
    }

    public function getImage()
    {
        return $this->content;
    }

    public function setName($name1): string
    {
        return $this->name = $name1;
    }

    public function setText($text1): string
    {
        return $this->text = $text1;
    }

    public function setPrice($price): string
    {
        return $this->price = $price;
    }

    public function setCatalogId($catalogId): string
    {
        return $this->catalog_id = $catalogId;
    }

    public function setImages()
    {
        if (!empty($_FILES['image']['name'])) {
            // Проверяем, что при загрузке не произошло ошибок
            if ($_FILES['image']['error'] == 0) {
                // Если файл загружен успешно, то проверяем - графический ли он
                if (substr($_FILES['image']['type'], 0, 5) == 'image') {
                    // Читаем содержимое файла
                    return $this->content = file_get_contents($_FILES['image']['tmp_name']);
                }
            }
        } else {
            return $this->content = " "; // Для INSERT необходимо значение. Затем в шаблоне view при выводе изображения будет проверка на пустое значение. Где " " равен "IA=="
        }
    }

    public function setAuthorId($authorId1): string
    {
        return $this->authorId = $authorId1;
    }

    // используем в методе add() ArticlesController.php
    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    //* Создание новой статьи на странице add
    public static function createFromArray(array $fields, $author = null): Products
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new self();

        if (!empty($author)) {
            $article->setAuthor($author);
        }
        $article->setName($fields['name']);
        $article->setText($fields['text']);
        if (!empty($fields['price'])) {
            $article->setPrice($fields['price']);
        }

        $article->setCatalogId(Catalog::getCatalogIdByName(Catalog::getCatalogName()));

        $article->setImages();

        $article->save();

        return $article;
    }

    // Обновление таблицы БД после ручного редактирования статьи на странице edit
    public function updateFromArray(array $fields): Products
    {
        if (empty($fields['name'])) {
            //throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            //throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);
        $this->setPrice($fields['price']);
        $this->setImages();
        $this->save();

        return $this;
    }

    //* Markdown-разметка. Будет прогонять текст статьи через парсер, прежде чем его вернуть
    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }

    # Получение количества страниц (для пагинации). Метод будет принимать на вход количество записей на одной странице.
    public static function getPagesCount(int $itemsPerPage, $catalogId = null): int
    {
        $db = Db::getInstance();

        $params = [];
        $query = 'SELECT COUNT(*) AS cnt FROM ' . static::getTableName();
        if ($catalogId) {
            $query .= ' WHERE catalog_id = :catalogId';
            $params['catalogId'] = $catalogId;
        }

        $result = $db->query($query . ';', $params, static::class);

        return ceil($result[0]->cnt / $itemsPerPage); // Общее количество записей делим на 5 записей на одной странице, затем округляем и получаем необходимое колич страниц
    }

    //* Получение записей на n-ой страничке
    /**
     * @return static[]
     */
    public static function getPage(int $pageNum, int $itemsPerPage, $catalogId = null): array
    {
        $db = Db::getInstance();

        $query = sprintf('SELECT * FROM `%s`', static::getTableName());
        $params = [];

        if ($catalogId) {
            $query .= ' WHERE catalog_id = :catalogId';
            $params['catalogId'] = $catalogId;
        }

        $query .= sprintf(' ORDER BY id DESC LIMIT %d OFFSET %d', $itemsPerPage, ($pageNum - 1) * $itemsPerPage);

        return $db->query($query, $params, static::class);
    }
}
