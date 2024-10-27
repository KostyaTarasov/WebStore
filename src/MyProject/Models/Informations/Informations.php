<?php

namespace MyProject\Models\Informations;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;

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
        return htmlentities($this->name);
    }

    public function getTitle(): string
    {
        return htmlentities($this->title);
    }

    public function getH(): string
    {
        return htmlentities($this->h1);
    }

    public function getDo(): string
    {
        return htmlentities($this->do);
    }

    public function getDoInfo(): string
    {
        return htmlentities($this->do_info);
    }

    public function getDescription(): string
    {
        return htmlentities($this->decription);
    }

    public function getAboutUs(): string
    {
        return htmlentities($this->about_us);
    }

    public function getPhone(): string
    {
        return htmlentities($this->phone);
    }

    public function getAddress(): string
    {
        return htmlentities($this->address);
    }

    public function getTimeWork(): string
    {
        return htmlentities($this->time_work);
    }

    public function getMail(): string
    {
        return htmlentities($this->mail);
    }

    public function getYandexMap(): string
    {
        return $this->yandex_map;
    }

    public function setName($name): string
    {
        return $this->name = $name;
    }

    public function setTitle($title): string
    {
        return $this->title = $title;
    }

    public function setH($h): string
    {
        return $this->h1 = $h;
    }

    public function setDo($do): string
    {
        return $this->do = $do;
    }

    public function setDoInfo($doInfo): string
    {
        return $this->do_info = $doInfo;
    }

    public function setDescription($decription): string
    {
        return $this->decription = $decription;
    }

    public function setAboutUs($aboutUs): string
    {
        return $this->about_us = $aboutUs;
    }

    public function setPhone($phone): string
    {
        return $this->phone = $phone;
    }

    public function setAddress($address): string
    {
        return $this->address = $address;
    }

    public function setTimeWork($timeWork): string
    {
        return $this->time_work = $timeWork;
    }

    public function setMail($mail): string
    {
        return $this->mail = $mail;
    }

    public function updateFromArray(array $fields): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название сайта');
        }

        if (empty($fields['title'])) {
            throw new InvalidArgumentException('Не передан заголовок статьи');
        }

        if (empty($fields['h'])) {
            throw new InvalidArgumentException('Не передано альтернативное название сайта');
        }

        $this->setName($fields['name']);
        $this->setTitle($fields['title']);
        $this->setH($fields['h']);
        $this->setDo($fields['do']);
        $this->setDoInfo($fields['do_info']);
        $this->setDescription($fields['description']);
        $this->setAboutUs($fields['about_us']);
        $this->setPhone($fields['phone']);
        $this->setAddress($fields['address']);
        $this->setTimeWork($fields['time_work']);
        $this->setMail($fields['mail']);
        $this->save();

        return $this;
    }

    public function getParsedText($field): string
    {
        $parser = new \Parsedown();
        return $parser->text($field);
    }
}
