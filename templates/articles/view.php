<?php
$getName = $article->getName();
$title = "Купить $getName в KirovShop";
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

<form action="/order" method="post">
    <input type="hidden" name="catalog" value="<?= $nameTableCatalog; ?>" />
    <input type="hidden" name="id" value="<?= $article->getId(); ?>" />
    <input type="hidden" name="price" value="<?= $article->getPrice(); ?>" />
    <input type="hidden" name="name" value="<?= $getName; ?>" />
    <input type="hidden" name="text" value="<?= $article->getParsedText(); ?>" />
    <button type="submit" class="btn btn-success">Заказать</button>
</form>
<?php include __DIR__ . '/../rightSidebar.php'; ?>