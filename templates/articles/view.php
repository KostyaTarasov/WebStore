<?php
$title = $article->getName();
include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() // Где вместо ['name'] согласно паттерну следует использовать метод из Models 
    ?> </h1>
<p><?= $article->getParsedText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && $user->isAdmin()) : // if (!empty($article) ) : // Любой сможет увидеть ссылки без условия $user->isAdmin(). А если вручную открыть ссылку, то всё равно не получится выполнять действия из-за запрета в контроллере статей Forbidden... 
?>
    <p><a href="edit">Редактировать статью</a></p>
    <p><a href="del">Удалить данную статью</a></p>
<?php endif; ?>

<?php if (!empty($image) && $image != "IA==") : ?>
    <img class="imageBig" src="data:image/png;base64, <?= $image ?? null ?>  " />
<?php endif; ?>

<form action="buy.php" method="GET">
    <!-- кнопка при помощи которой можно заказать  -->
    <input type="hidden" name="id" value="<?= $article->getId(); ?>" />
    <button type="submit">Заказать</button>
</form>
<?php include __DIR__ . '/../rightSidebar.php'; ?>