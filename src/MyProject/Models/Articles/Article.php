<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User; //Либо же указать в начале файла о каком классе идёт речь, когда мы используем в коде только слово User. Делается это с помощью слова use после указания текущего неймспейса, но перед описанием класса.
use MyProject\Exceptions\InvalidArgumentException;

class Article extends ActiveRecordEntity  // Наследуемся от полученного класса
{
    /** @var string */
    protected $name; // protected чтобы к ним можно было достучаться из класса-родителя.

    /** @var string */
    protected  $text;

    /** @var string */
    protected  $authorId;

    /** @var string */
    protected  $createdAt;

    # Cделаем геттеры для свойств id, name и text:
    #Теперь мы можем работать с этими объектами в коде. Например – обращаться к геттерам в шаблонах: templates/main/main.php
    /**
     * @return string
     */
    public function getName(): string // Используется в templates/article/view.php
    {
        return htmlentities($this->name); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return htmlentities($this->text); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    # Возвращает имя таблицы: articles, где хранятся пользователи.
    protected static function getTableName(): string // необходим для реализации потому что объявлен абстрактно в классе родителе ActiveRecordEntity
    {
        return 'articles';
    }

    /**
     * @return int
     */
    public function getAuthor(): User // Геттер для вывода автора статьи
    {
        /*
        в геттере просим сущность юзера выполнить запрос в базу 
        и получить нужного пользователя по (authorId=author_id), который хранится в конкретной статье(articles) у которой свой id. 
        При этом запрос будет выполнен только если мы вызовем этот геттер, 
        это называется LazyLoad (ленивая загрузка) – это когда данные не подгружаются до тех пор, пока их не запросят.
        */

        $this->authorId;

        return User::getById($this->authorId);
    }


    public function setName($name1): string // Устанавливаем новое значение для свойства $this->name
    {
        return $this->name = $name1;
    }

    public function setText($text1): string
    {
        return $this->text = $text1;
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

    //* Создание новой статьи
    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();

        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;
    }

    // Обновление таблицы БД после ручного редактирования статьи на странице
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
