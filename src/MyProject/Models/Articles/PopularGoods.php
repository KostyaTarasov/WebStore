<?php

namespace MyProject\Models\Articles;

use MyProject\Models\Articles\Article;

class PopularGoods extends Article
{
    public static function getTableName(): string
    {
        return 'popularnye_tovary';
    }
}
