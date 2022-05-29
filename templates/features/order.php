<?php
$title = "Оформление заказа в KirovShop";
include __DIR__ . '/../header.php'; ?>

<?php
if (!empty($message)) {
    include __DIR__ . '/../messages/message.php';
}
?>

<form action="/formOrder" method="post">
    <div style="padding: 10px;">
        <br>
        <h3>Товар к заказу: <?= $_POST['name'] ?></h3><br>
        <p>Стоимость: <?= $_POST['price'] ?> Рублей</p>
        <br>
        <label>Ниже предлагаем оставить комментарий, вопросы к продавцу либо свои пожелания к заказу.</label><br>
        <textarea name="text" id="text" rows="4" cols="92"></textarea><br>
        <br>
        <label for="nickname">Имя:</label><br>
        <input id="nickname" type="text" name="nickname" value="<?= (isset($user)) ? $user->getNickname() : "" ?>">
        <br><br>
        <label for="email">Email:</label><br>
        <input id="email" type="text" name="email" value="<?= (isset($user)) ? $user->getEmail() : "" ?>">
        <br><br>
        <label for="phone">Телефон:</label><br>
        <input id="phone" type="tel" name="phone" placeholder="+7 999 999 99 99" maxlength="12" value="<?= $_POST['phone'] ?? '' ?>">
        </label>
        <br><br>
        <input type="hidden" name="price" value="<?= $_POST['price'] ?>" />
        <input type="hidden" name="name" value="<?= $_POST['name'] ?>" />
        <input type="submit" class="btn btn-success" value="Оформить заказ">
    </div>
</form>

<?php include __DIR__ . '/../rightSidebar.php'; ?>