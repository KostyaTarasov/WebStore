<?php

namespace MyProject\Models\Articles;

use MyProject\Services\Db;

class Images extends Article
{
    public static function loadImage(int $id)
    {
        $db = Db::getInstance();
        $image2 = $db->query(
            'SELECT `content` FROM `' . Article::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );

        foreach ($image2[0] as $item => $value) {
            $image = $value;
            if (!empty($image)) {
                return base64_encode($image);
            }
        }
    }
}
