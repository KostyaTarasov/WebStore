<?php
$title = "Редактирование статьи";
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <h1>Редактирование статьи</h1>
    <?php if (!empty($error)) : ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form enctype="multipart/form-data" action="edit" method="post">
        <br>
        <label for="name">Название статьи</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? $article->getName() ?>" size="50"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $article->getText() ?></textarea><br>
        <br>
        <?php if (!empty($image) && $image != "IA==") : ?>
            <img class="image middle" src="data:image/png;base64, <?= $image ?? null ?>  " />
        <?php endif; ?>
        <br>
        Изображение: <input type="file" accept=".png, .jpg, .jpeg" name="image" />
        <input type="submit" class="btn btn-success" value="Обновить">
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>