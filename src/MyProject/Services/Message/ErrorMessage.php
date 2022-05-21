<?php

namespace MyProject\Services\Message;

/**
 * Class ErrorMessage
 * @package MyProject\Services\Message
 */
final class ErrorMessage extends Message
{
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->setType(Message::ERROR);
    }
}
