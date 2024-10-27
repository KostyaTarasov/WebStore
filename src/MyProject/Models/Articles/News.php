<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;

class News extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected  $text;

    /** @var string */
    protected  $createdAt;

    protected  $content;

    /**
     * @return string
     */
    public function getName(): string
    {
        return htmlentities($this->name);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return htmlentities($this->text);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return mb_substr($this->createdAt, 0, 10);
    }

    public function getImage()
    {
        return $this->content;
    }

    public static function getTableName(): string
    {
        return 'news';
    }

    public function setName($name1): string
    {
        return $this->name = $name1;
    }

    public function setText($text1): string
    {
        return $this->text = $text1;
    }

    public function setImages($image)
    {
        if (!empty($_FILES['image']['name'])) {
            // Проверяем, что при загрузке не произошло ошибок
            if ($_FILES['image']['error'] == 0) {
                // Если файл загружен успешно, то проверяем - графический ли он
                if (substr($_FILES['image']['type'], 0, 5) == 'image') {
                    // Читаем содержимое файла
                    return $this->content = file_get_contents($_FILES['image']['tmp_name']);
                }
            }
        } elseif (!empty($image)) {
            return $this->content = base64_decode($image);; // Для INSERT необходимо значение. Затем в шаблоне view при выводе изображения будет проверка на пустое значение. Где " " равен "IA=="
        } else {
            return $this->content = " "; // Для INSERT необходимо значение. Затем в шаблоне view при выводе изображения будет проверка на пустое значение. Где " " равен "IA=="
        }
    }

    public function updateFromArray(array $fields): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);
        $this->setImages($fields['current_image']);
        $this->save();

        return $this;
    }

    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }
}
