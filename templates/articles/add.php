<?php
$title = "Добавление статьи";
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <h1>Создание новой статьи</h1>
    <?php if (!empty($error)) : ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form enctype="multipart/form-data" action="add" method="post">
        <br>
        <label for="name">Название статьи</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" size="50"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
        <br>
        <label for="price">Цена товара в рублях:</label><br>
        <input name="price" id="price" type="number" min="0" placeholder="0"> ₽
        <br><br>
        <label for="is_popular">Популярность</label><br>
        <input type="hidden" name="is_popular" value="0">
        <input type="checkbox" name="is_popular" id="is_popular" value="1">
        <br><br>
        Изображение: <input type="file" name="image" />
        <input type="submit" value="Создать">
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>