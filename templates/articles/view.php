<?php
$title = $article->getName();
include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() // Где вместо ['name'] согласно паттерну следует использовать метод из Models 
    ?> </h1>
<p><?= $article->getParsedText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if ($user !== null && $user->isAdmin()) : // if (!empty($article) ) : // Любой сможет увидеть ссылки без условия $user->isAdmin(). А если вручную открыть ссылку, то всё равно не получится выполнять действия из-за запрета в контроллере статей Forbidden... 
?>
    <p><a href="/../articles/edit/<?= $article->getId() ?>">Редактировать статью</a></p>
    <p><a href="/../articles/del/<?= $article->getId() ?>">Удалить данную статью</a></p>
<?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>