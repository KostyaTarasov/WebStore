<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;

class Article extends ActiveRecordEntity
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

    # Возвращает имя таблицы: articles в случае если адрес /catalog/articles, где хранятся статьи.
    public static function getTableName(): string // необходим для реализации потому что объявлен абстрактно в классе родителе ActiveRecordEntity
    {
        if ($_SERVER['REQUEST_URI'] == "/" || preg_replace('/[0-9]/', '', $_SERVER['REQUEST_URI']) == "/") {
            return 'popularnye_tovary';
        }
        $pregRetult = preg_replace("/[0-9]/", '', str_replace(array('catalog', 'product', 'page', '/', 'add', 'edit', 'del', 'bye'), '', $_GET['route'])); // заменяем цифры и слова на пустое значение чтобы вернуть имя таблицы
        $pregRetult = ActiveRecordEntity::replaceDash($pregRetult);
        return $pregRetult;
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
    public static function createFromArray(array $fields, $author = null): Article
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
        $article->setImages();

        $article->save();

        return $article;
    }

    // Обновление таблицы БД после ручного редактирования статьи на странице edit
    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
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
}
