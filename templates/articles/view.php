<?php
$getName = $article->getName();
$title = "Купить $getName в";
include __DIR__ . '/../header.php'; ?>
<h1><?= $getName ?> </h1>
<p><?= $article->getParsedText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && $user->isAdmin()) : // if (!empty($article) ) : // Любой сможет увидеть ссылки без условия $user->isAdmin(). А если вручную открыть ссылку, то всё равно не получится выполнять действия из-за запрета в контроллере статей Forbidden... 
?>
    <a class="btn btn-primary" href="edit">Редактировать статью</a>
    <a class="btn btn-danger" href="del">Удалить статью</a>
<?php endif; ?>

<?php if (!empty($image) && $image != "IA==") : ?>
    <img class="image big" src="data:image/png;base64, <?= $image ?? null ?>  " />
<?php endif; ?>

<p>Цена: <?= $article->getPrice() ?> ₽</p>
<form action="buy.php" method="GET">
    <!-- кнопка при помощи которой можно заказать  -->
    <input type="hidden" name="id" value="<?= $article->getId(); ?>" />
    <button type="submit" class="btn btn-success">Заказать</button>
</form>
<?php include __DIR__ . '/../rightSidebar.php'; ?>