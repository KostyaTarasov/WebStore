<?php

namespace MyProject\Models\Articles;

use MyProject\Services\Db;

class Images extends Article
{
    public static function loadImage(int $id)
    {
        $db = Db::getInstance();
        $image2 = $db->query(
            'SELECT `content` FROM `' . Article::getTableName() . '` WHERE id=:id;', // SQL код выбора строки из таблицы
            [':id' => $id], // Параметры
            static::class   // Имя класса
        );

        foreach ($image2[0] as $item => $value) {
            $image = $value;
            if (!empty($image)) {
                return base64_encode($image);
            }
        }
    }
}
