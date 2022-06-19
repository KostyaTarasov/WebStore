<?php

namespace MyProject\Models\Articles;

use MyProject\Models\Articles\Article;

class News extends Article  // Наследуемся от полученного класса
{
    public static function getTableName(): string // необходим для реализации потому что объявлен абстрактно в классе родителе ActiveRecordEntity
    {
        return 'news';
    }
}
