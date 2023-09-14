<?php

namespace MyProject\Models\Articles;

use MyProject\Models\Articles\Article;

class News extends Article
{
    public static function getTableName(): string
    {
        return 'news';
    }
}
