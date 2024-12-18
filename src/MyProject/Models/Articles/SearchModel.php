<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class SearchModel
{
    private const TABLE_USERS = 'users';
    private const COLUMN_NAME = "(`name`,' ',`text`)";

    public static function countArticles(array $valueFromPost)
    {
        $tableCatalogs = [Products::getTableName()];
        $sql = "";
        $sql = 'SELECT';
        foreach ($tableCatalogs as $table) {
            $table = ActiveRecordEntity::replaceDash($table);
            $sql .= '(SELECT COUNT(*) FROM ' . $table . '  WHERE CONCAT ' . self::COLUMN_NAME . '  LIKE  ' . ':value' . ')';
            if (next($tableCatalogs)) {
                $sql .= " + ";
            }
        }
        $sql .= ';';
        $value = $valueFromPost['search'];
        $db = Db::getInstance();
        $resultSearch = $db->query(
            $sql,
            [':value' => "%$value%"],
            static::class
        );
        foreach ($resultSearch[0] as $count) {
            if ($count == 0) {
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
    public static function getPage(int $pageNum, int $itemsPerPage, array $valueFromPost) // параметры: номер страницы, количество записей на одной странице, слова которые ищет пользователь.
    {
        $tableCatalogs = [Products::getTableName()];
        $sql = "";
        foreach ($tableCatalogs as $table) {
            $table = ActiveRecordEntity::replaceDash($table);
            $sql .= 'SELECT *, ' . "'$table'" . ' AS `newColTable` FROM  ' . "$table" . '  WHERE CONCAT ' . self::COLUMN_NAME . '  LIKE  ' . ':value' . ''; // '$table' AS `newColTable` добавляем столбик содержащий имя таблицы к соответствующим данным. 
            // `newColTable` для вывода в шаблоне (используется в ссылке на продукт своего каталога и т.д.)
            if (next($tableCatalogs)) {
                $sql .= " UNION ALL "; // Объединяем SELECT запросы для разных имён таблиц
            }
        }
        $skip = ($pageNum - 1) * $itemsPerPage;
        $sql .= ' ORDER BY id DESC LIMIT ' . "$itemsPerPage" . ' OFFSET ' . "$skip" . ';';
        $value = $valueFromPost['search'];
        $db = Db::getInstance();
        return $db->query(
            $sql,
            [':value' => "%$value%"],
            static::class
        );
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();

        $entities = $db->query(
            'SELECT * FROM `' . self::TABLE_USERS . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null; // Этот метод вернёт либо один объект, если он найдётся в базе, либо null – что будет говорить об его отсутствии.
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return htmlentities($this->name);
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
    public function getText(): string  // htmlentities() чтобы обезопастить от XSS-атаки (например от комментах в виде <script>...)
    {
        return htmlentities($this->text);
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return htmlentities($this->price);
    }

    public function getAuthor()
    {
        return User::getById($this->author_id);
    }

    public function getImage()
    {
        return $this->content;
    }

    /** Получаем имя таблицы каждого продукта из добавленного столбца newColTable. Столбец добавлен был в методе getPage()
     * @return string
     */
    public function getValueNewColTable(): string
    {
        return htmlentities($this->newColTable);
    }
}
