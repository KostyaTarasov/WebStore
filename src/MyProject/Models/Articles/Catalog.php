<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;

class Catalog extends ActiveRecordEntity  // Наследуемся от полученного класса
{
    /** @var string */
    protected $name_table; // protected чтобы к ним можно было достучаться из класса-родителя.

    # Возвращает имя таблицы каталога:
    protected static function getTableName(): string // необходим для реализации потому что объявлен абстрактно в классе родителе ActiveRecordEntity
    {
        return 'catalog';
    }

    /**
     * @return string
     */
    public function getNameTable(): string  // Возвращает имена таблиц каталогов из таблицы общего каталога
    {
        return htmlentities($this->name_table);
    }

    # Cделаем геттеры для свойств id, name и text:
    #Теперь мы можем работать с этими объектами в коде. Например – обращаться к геттерам в шаблонах
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
    public function getPathImage(): string
    {
        $path = '/images/catalog/';
        $fullPath = $path . $this->content . '.png';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $fullPath)) {
            return $fullPath;
        } else {
            return $path . 'no-image.png';
        }
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

    public function getImage()
    {
        return $this->content;
    }

    //* Получение записей на n-ой страничке
    /**
     * @return static[]
     */
    public static function getPage(int $pageNum, int $itemsPerPage): array // параметры: номер страницы, количество записей на одной странице.
    {
        $db = Db::getInstance();
        return $db->query(
            sprintf(
                'SELECT * FROM `%s` ORDER BY id;',
                static::getTableName(),
            ),
            [],
            static::class
        );
    }
}
