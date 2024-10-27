<?php
$title = "Добавление каталога";
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <h1>Создание нового каталога</h1>
    <?php if (!empty($error)) : ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form enctype="multipart/form-data" action="add" method="post">
        <br>
        <label for="name">Название каталога</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" size="50"><br>
        <br>
        <label for="text">Описание</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
        <br><br>
        Изображение: <input type="file" name="image" />
        <input type="submit" value="Создать">
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>