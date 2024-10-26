<?php

namespace MyProject\Models\Informations;

use MyProject\Models\ActiveRecordEntity;

class Informations extends ActiveRecordEntity
{
    public string $name;
    public string $title;
    public string $h1;
    public string $do;
    public string $do_info;
    public string $decription;
    public string $about_us;
    public string $phone;
    public string $address;
    public string $time_work;
    public string $mail;
    public string $yandex_map;

    public static function getTableName(): string
    {
        return 'common_information';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getH(): string
    {
        return $this->h1;
    }

    public function getDo(): string
    {
        return $this->do;
    }

    public function getDoInfo(): string
    {
        return $this->do_info;
    }

    public function getDescription(): string
    {
        return $this->decription;
    }

    public function getAboutUs(): string
    {
        return $this->about_us;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getTimeWork(): string
    {
        return $this->time_work;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getYandexMap(): string
    {
        return $this->yandex_map;
    }
}
