<?php $title = "Мой личный блог";
include __DIR__ . '/../header.php'; ?>

<form action="/search" method="post">
    <label>Введите ключевое слово <input type="text" name="search" value="<?= $_POST['search'] ?? '' ?>"></label>
    <br><br>
    <input type="submit" value="Искать">
</form>

<?php foreach ($articles as $article) : ?>
    <!-- Проход по полученным даннымм -->
    <h2>
        <a href="/articles/<?= $article->getId() ?>">
            <!-- Ccылка на статью для каждого id найденного foreach -->
            <?= $article->getName() ?>
        </a> <!-- Вывод имени -->
    </h2>
    <p><?= $article->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>

    <?php
    $image = base64_encode($article->getImage());
    if (!empty($image) && $image != "IA==") : ?>
        <img class="image" src="data:image/png;base64, <?= $image ?? null ?>  " />
    <?php endif; ?>

    <hr>
<?php endforeach; ?>

<!-- Пагинация, выводить на каждой странице блога по 5 записей
SELECT * FROM articles ORDER BY id DESC LIMIT 5 OFFSET 0;
-->
<div style="text-align: center">
    <section>
        <?php if ($previousPageLink !== null) : ?>
            <a href="<?= $previousPageLink ?>">&lt; Назад</a>
        <?php else : ?>
            <span style="color: grey">&lt; Назад</span>
        <?php endif; ?>
        &nbsp;&nbsp;&nbsp;
        <?php if ($nextPageLink !== null) : ?>
            <a href="<?= $nextPageLink ?>">Вперёд &gt;</a>
        <?php else : ?>
            <span style="color: grey">Вперёд &gt;</span>
        <?php endif; ?>
    </section>

    <section>
        <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
            <?php if ($currentPageNum === $pageNum) : ?>
                <b><?= $pageNum ?></b>
            <?php else : ?>
                <a href="/<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </section>
</div>

<?php include __DIR__ . '/../footer.php'; ?>