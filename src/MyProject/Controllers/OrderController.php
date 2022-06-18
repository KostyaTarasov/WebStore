<?php

namespace MyProject\Controllers;

use MyProject\Models\Orders\Order;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\Message\DangerMessage;
use MyProject\Services\Message\SuccessMessage;

//* Контроллер для заказа товара
class OrderController extends AbstractController
{
    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function order()
    {
        $this->view->renderHtml('features/order.php');
    }

    public function formOrder()
    {
        if (!empty($_POST)) { // если пришел POST-запрос
            # Обрабатываем исключения!
            try {
                Order::checkOrder(); // вызов метода проверки переданных данных.
                Order::saveOrder(); // вызов метода сохранения в бд данных оформленного заказа.
                Order::mailOrder(); // вызов метода отправки сообщения клиенту.
                $this->view->renderHtml('features/orderSuccessful.php', ['message' => new SuccessMessage("Заказ успешно оформлен!")]);
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('features/order.php', ['message' => new DangerMessage($e->getMessage())]); // Передаём в шаблон переменную error содержащая имя вызванной ошибки (к примеру nickname если пользователь его не ввёл )
                return;
            }
        }
    }
}
