<?php

namespace MyProject\Models\Informations;

use MyProject\Models\ActiveRecordEntity;

class Settings extends ActiveRecordEntity
{
    /** @var bool */
    protected $is_visible_login;

    /** @var bool */
    protected $is_visible_author;

    /** @var bool */
    protected $is_visible_buy;

    public static function getTableName(): string
    {
        return 'settings';
    }

    public function isVisibleLogin(): string
    {
        return $this->is_visible_login;
    }

    public function isVisibleAuthor(): string
    {
        return $this->is_visible_author;
    }

    public function isVisibleBuy(): string
    {
        return $this->is_visible_buy;
    }
}
