<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;

class LoadImageController
{
    private const TABLE_ARTICLES = 'articles';
    private const COLUMN_NAME = "content";

    public static function loadImage()
    {
        $db = Db::getInstance();
        //* Вставка статьи с изображением в бд
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Проверяем пришел ли файл
            if (!empty($_FILES['image']['name'])) {
                // Проверяем, что при загрузке не произошло ошибок
                if ($_FILES['image']['error'] == 0) {
                    // Если файл загружен успешно, то проверяем - графический ли он
                    if (substr($_FILES['image']['type'], 0, 5) == 'image') {
                        // Читаем содержимое файла
                        $image = file_get_contents($_FILES['image']['tmp_name']);
                        $db->query(
                            'INSERT INTO `articles` (`id`,`author_id`, `name`, `text`, `created_at`, `content`) VALUES (39,1, "896", "35","2022-01-31 18:52:51", :image)',
                            [':image' => $image], // Параметры
                            static::class // Имя класса
                        );
                    }
                }
            }
        }
    }
}
