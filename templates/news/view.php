<?php
$getName = $article->getName();
$title = "$getName" . $commonInformation[0]->getDoInfo();
include __DIR__ . '/../header.php'; ?>
<div class="main">
    <h1><?= $getName ?> </h1>
    <p><?= $article->getParsedText() ?></p>
    <?php if ($settings[0]->isVisibleAuthor()) : ?>
        <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <?php endif; ?>
    <?php if ($user !== null && $user->isAdmin()) :
    ?>
        <a class="btn btn-primary" href="edit">Редактировать статью</a>
        <a class="btn btn-danger" href="del">Удалить статью</a>
    <?php endif; ?>

    <?php if (!empty($image) && $image != "IA==") : ?>
        <img class="image big" src="data:image/png;base64, <?= $image ?? null ?>  " />
    <?php endif; ?>

    <?php if ($settings[0]->isVisibleBuy()) : ?>
        <p>Цена: <?= $article->getPrice() ?> ₽</p>
    <?php endif; ?>

    <form action="/order" method="post">
        <input type="hidden" name="id_product" value="<?= $article->getId(); ?>" />
        <input type="hidden" name="name_catalog" value="<?= $nameTableCatalog; ?>" />
        <input type="hidden" name="name" value="<?= $getName; ?>" />
        <input type="hidden" name="text" value="<?= $article->getParsedText(); ?>" />
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>