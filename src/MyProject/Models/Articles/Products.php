<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;
use MyProject\Models\Articles\Article;

class Products extends Article
{
    /** @var string */
    protected $cpu_name_catalog;

    # Возвращает имя таблицы каталога:
    protected static function getTableName(): string
    {
        return 'products';
    }

    /**
     * @return string
     */
    public function getNameTable(): string  // Возвращает имена таблиц каталогов из таблицы общего каталога
    {
        return htmlentities($this->cpu_name_catalog);
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
    public function getPathImage(): string
    {
        $path = '/images/catalog/';
        $fullPath = $path . $this->cpu_name_catalog . '.png';
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
        return $this->cpu_name_catalog;
    }

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

    # Получение количества страниц (для пагинации). Метод будет принимать на вход количество записей на одной странице.
    public static function getPagesCount(int $itemsPerPage, $catalogId = null): int
    {
        $db = Db::getInstance();

        $params = [];
        $query = 'SELECT COUNT(*) AS cnt FROM ' . static::getTableName() . ';';
        if ($catalogId) {
            $query .= ' WHERE catalog_id = :catalogId';
            $params['catalogId'] = $catalogId;
        }

        $result = $db->query('SELECT COUNT(*) AS cnt FROM ' . static::getTableName() . ';', $params, static::class);
        return ceil($result[0]->cnt / $itemsPerPage); // Общее количество записей делим на 5 записей на одной странице, затем округляем и получаем необходимое колич страниц
    }

    //* Получение (создание) ЧПУ, имён каталогов
    /**
     * @return static[]
     */
    public static function getCPU(): array
    {
        $db = Db::getInstance();
        $arrCatalogs = $db->query(
            sprintf(
                'SELECT `id`, `name`, `cpu_name_catalog` FROM `%s` ORDER BY id',
                static::getTableName()
            ),
            [],
            static::class
        );
        foreach ($arrCatalogs as $value) {
            if (empty($value->cpu_name_catalog)) { // Если в базе данных для данного каталога нету ЧПУ
                $value->cpu_name_catalog = self::slugify($value->name); // Транслитерация из кириллицы в латиницу для ЧПУ, замена промежутков и лишних символов на '-', Lower
                $value->save(); // Создание нового ЧПУ в базе данных
            }
        }
        return $arrCatalogs;
    }
}
