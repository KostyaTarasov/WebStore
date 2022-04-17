<?php

namespace MyProject\Models\Articles;

use MyProject\Services\Db;

class Images
{
    private const TABLE_ARTICLES = 'articles';

    public static function loadImage(int $id)
    {
        $db = Db::getInstance();
        $image2 = $db->query(
            'SELECT `content` FROM `' . self::TABLE_ARTICLES . '` WHERE id=:id;', // SQL код выбора строки из таблицы
            [':id' => $id], // Параметры
            static::class   // Имя класса
        );

        foreach ($image2[0] as $item => $value) {
            $image = $value;
        }
        return $image = base64_encode($image);
    }
}
