<?php
$title = "Редактирование О нас";
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <h1>Редактирование общей информации и настроек</h1>
    <?php if (!empty($error)) : ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form enctype="multipart/form-data" action="edit" method="post">
        <label for="about_us">Описание о нас</label><br>
        <textarea name="about_us" id="about_us" rows="10" cols="80"><?= $_POST['about_us'] ?? $commonInformation[0]->getAboutUs() ?></textarea><br>
        <br>
        <br>
        <label for="name">Название сайта</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? $commonInformation[0]->getName() ?>" size="50"><br>
        <br>
        <label for="title">Заголовок сайта</label><br>
        <input type="text" name="title" id="title" value="<?= $_POST['title'] ?? $commonInformation[0]->getTitle() ?>" size="50"><br>
        <br>
        <label for="h">Альтернативное название сайта</label><br>
        <input type="text" name="h" id="h" value="<?= $_POST['h'] ?? $commonInformation[0]->getH() ?>" size="50"><br>
        <br>
        <label for="do">Призыв действовать</label><br>
        <input type="text" name="do" id="do" value="<?= $_POST['do'] ?? $commonInformation[0]->getDo() ?>" size="50"><br>
        <br>
        <label for="do_info">Текст добавляется к призыву действия</label><br>
        <input type="text" name="do_info" id="do_info" value="<?= $_POST['do_info'] ?? $commonInformation[0]->getDoInfo() ?>" size="50"><br>
        <br>
        <label for="description">Описание для главной страницы сайта, добавляется к альтернативному названию сайта</label><br>
        <textarea name="description" id="description" rows="10" cols="80"><?= $_POST['description'] ?? $commonInformation[0]->getDescription() ?></textarea><br>
        <br>
        <label for="phone">Телефон</label><br>
        <input type="text" name="phone" id="phone" value="<?= $_POST['phone'] ?? $commonInformation[0]->getPhone() ?>" size="50"><br>
        <br>
        <label for="address">Адрес</label><br>
        <input type="text" name="address" id="address" value="<?= $_POST['address'] ?? $commonInformation[0]->getAddress() ?>" size="50"><br>
        <br>
        <label for="time_work">Время работы</label><br>
        <input type="text" name="time_work" id="time_work" value="<?= $_POST['time_work'] ?? $commonInformation[0]->getTimeWork() ?>" size="50"><br>
        <br>
        <label for="mail">Почта ( необязательно )</label><br>
        <input type="text" name="mail" id="mail" value="<?= $_POST['mail'] ?? $commonInformation[0]->getMail() ?>" size="50"><br>
        <br>
        <input type="submit" class="btn btn-success" value="Обновить">
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>