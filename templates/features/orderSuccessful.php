<?php
$title = "Заказ успешно выполнен";
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <?php
    if (!empty($message)) {
        include __DIR__ . '/../messages/message.php';
    }
    ?>

    <div style="text-align: center;">
        На указанный email отправлено сообщение с деталями заказа.<br>
        Обычно заявки рассматриваются в течение суток.
    </div>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>