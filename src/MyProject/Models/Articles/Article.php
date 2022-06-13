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

    /** @var int */
    protected  $price;

    /** @var string */
    protected  $authorId;

    /** @var string */
    protected  $createdAt;

    protected  $content;

    # Cделаем геттеры для свойств id, name и text:
    #Теперь мы можем работать с этими объектами в коде. Например – обращаться к геттерам в шаблонах: templates/main/main.php
    /**
     * @return string
     */
    public function getName(): string // Используется в templates/article/view.php
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
            return 'articles';
        }
        $pregRetult = preg_replace("/[0-9]/", '', str_replace(array('catalog', 'product', 'page', '/', 'add', 'edit', 'del', 'bye'), '', $_GET['route'])); // заменяем цифры и слова на пустое значение чтобы вернуть имя таблицы
        $pregRetult = ActiveRecordEntity::replaceDash($pregRetult);
        return $pregRetult;
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

    public function getImage()
    {
        return $this->content;
    }

    public function setName($name1): string // Устанавливаем новое значение для свойства $this->name
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
        $article->setPrice($fields['price']);
        $article->setImages(); // Загруженное изображение кладём в массив данных

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
        $this->setImages(); // Загруженное изображение кладём в массив данных
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
