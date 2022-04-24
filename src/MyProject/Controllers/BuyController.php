<?php

namespace MyProject\Controllers;

//* Контроллер для заказа товара
class BuyController extends AbstractController
{
    public function buyGoods()
    {
        if (!empty($_GET)) {
            var_dump($_GET);
        }
    }
}
