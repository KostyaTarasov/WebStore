<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Db;

class Catalog extends ActiveRecordEntity
{
    /** @var string */
    protected $cpu_name_catalog;

    # Возвращает имя таблицы каталога:
    protected static function getTableName(): string
    {
        return 'catalog';
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

    public function setName($name): string
    {
        return $this->name = $name;
    }

    public function setText($text): string
    {
        return $this->text = $text;
    }

    public function setImages($fileName)
    {
        $uploadDir =  'images/catalog/';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileNameCmps = pathinfo($_FILES['image']['name']);
            $fileExtension = strtolower($fileNameCmps['extension']);
            $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedFileTypes)) {
                $destPath = $uploadDir . $fileName . '.' . $fileExtension;

                if (!move_uploaded_file($fileTmpPath, $destPath)) {
                    throw new InvalidArgumentException('Произошла ошибка при загрузке файла');
                }
            } else {
                throw new InvalidArgumentException('Недопустимый тип файла, разрешены только изображения');
            }
        }
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
                $value->cpu_name_catalog = self::replaceDash(self::slugify($value->name)); // Транслитерация из кириллицы в латиницу для ЧПУ, замена промежутков и лишних символов на '-', Lower
                $value->save(); // Создание нового ЧПУ в базе данных
            }
        }
        return $arrCatalogs;
    }

    public static function getMapCatalogNamesId(): array
    {
        $db = Db::getInstance();
        $arrCatalogs = $db->query(
            sprintf(
                'SELECT `id`,`cpu_name_catalog` FROM `%s` ORDER BY id',
                static::getTableName()
            ),
            [],
            static::class
        );
        return array_column($arrCatalogs, 'cpu_name_catalog', 'id');
    }

    # Возвращает имя каталога из url
    public static function getCatalogName(): string
    {
        $pregRetult = preg_replace("/[0-9]/", '', str_replace(array('catalog', 'product', 'page', '/', 'add', 'edit', 'del', 'bye'), '', $_GET['route']));
        $pregRetult = ActiveRecordEntity::replaceDash($pregRetult);
        return $pregRetult;
    }

    public static function getCatalogIdByName(string $catalogName): int
    {
        $db = Db::getInstance();

        // Создаем запрос и параметры
        $query = sprintf('SELECT `id` FROM `%s`', static::getTableName());
        $params = ['cpu_name_catalog' => $catalogName];

        // Добавляем условие
        $query .= ' WHERE cpu_name_catalog = :cpu_name_catalog;';

        // Выполняем запрос
        return $db->query($query, $params, static::class)[0]->id;
    }

    public function updateFromArray(array $fields): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название каталога');
        }

        if (empty($fields['text'])) {
            //throw new InvalidArgumentException('Не передан текст каталога');
        }

        $this->setName($fields['name']);
        $this->setImages(self::slugify($fields['name']));
        $this->setText($fields['text']);
        $this->save();

        return $this;
    }

    public static function mapCatalogByCpuName(array $catalog): array
    {
        return array_column(
            array_map(fn($item) => ['cpu_name_catalog' => $item->cpu_name_catalog, 'id' => $item->id], $catalog),
            'cpu_name_catalog',
            'id'
        );
    }
}
