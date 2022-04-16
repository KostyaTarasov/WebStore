<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;
use MyProject\Models\Users\User;

class SearchModel
{
    private const TABLE_ARTICLES = 'articles';
    private const TABLE_USERS = 'users';
    private const COLUMN_NAME = "(`name`,' ',`text`)"; // Чтобы искать в данных столбцах

    public static function countArticles(array $valueFromPost)
    {
        $value = $valueFromPost['search'];
        $db = Db::getInstance();
        $resultSearch = $db->query(
            'SELECT COUNT(*) FROM `' . self::TABLE_ARTICLES . '` WHERE CONCAT ' . self::COLUMN_NAME . ' LIKE  ' . ':value' . ';',
            [':value' => "%$value%"],
            static::class
        );

        foreach ($resultSearch[0] as $count) {
            if ($count == 0) { // Если ничего не найдено
                throw new InvalidArgumentException(
                    "По запросу <b>$value</b>  ничего не найдено. <br><br>
            Рекомендации:<br><br>
            <li>Убедитесь, что все слова написаны без ошибок.</li> 
            <li>Попробуйте использовать другие ключевые слова.</li>
            <li>Попробуйте использовать более популярные ключевые слова.</li>"
                );
                return null;
            }
            return $count;
        }
    }

    # Получение количества страниц (для пагинации). Метод будет принимать на вход количество записей на одной странице и общее количество статей
    public static function getPagesCount(int $itemsPerPage, int $countArticle)
    {
        return ceil($countArticle / $itemsPerPage);
    }


    //* Получение статей на n-ой странице
    /** 
     * @return static[]
     */
    public static function getPage(int $pageNum, int $itemsPerPage, array $valueFromPost) // параметры: номер страницы, количество записей на одной странице .
    {
        $skip = ($pageNum - 1) * $itemsPerPage;
        $value = $valueFromPost['search'];
        $db = Db::getInstance();
        return  $db->query(
            'SELECT * FROM `' . self::TABLE_ARTICLES . '` WHERE CONCAT ' . self::COLUMN_NAME . '  LIKE  ' . ':value' . ' ORDER BY id DESC LIMIT ' . "$itemsPerPage" . ' OFFSET ' . "$skip" . ';',
            [':value' => "%$value%"],
            static::class
        );
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();

        $entities = $db->query(
            'SELECT * FROM `' . self::TABLE_USERS . '` WHERE id=:id;', // SQL код выбора строки из таблицы
            [':id' => $id], // Параметры
            static::class   // Имя класса
        );
        return $entities ? $entities[0] : null; // Этот метод вернёт либо один объект, если он найдётся в базе, либо null – что будет говорить об его отсутствии.
    }

    # Cделаем геттер для свойства id:
    #Теперь мы можем работать с этим объектом в коде. Например – обращаться к геттерам в шаблонах: templates/main/main.php
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string // Используется в templates/article/view.php
    {
        return htmlentities($this->name); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    //* Markdown-разметка. Будет прогонять текст статьи через парсер, прежде чем его вернуть
    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return htmlentities($this->text); // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    }

    public function getAuthor() // Геттер для вывода автора статьи
    {
        /*
        в геттере просим сущность юзера выполнить запрос в базу
        и получить нужного пользователя по (authorId=author_id), который хранится в конкретной статье(articles) у которой свой id.
        При этом запрос будет выполнен только если мы вызовем этот геттер,
        это называется LazyLoad (ленивая загрузка) – это когда данные не подгружаются до тех пор, пока их не запросят.
        */
        return User::getById($this->author_id);
    }
}
