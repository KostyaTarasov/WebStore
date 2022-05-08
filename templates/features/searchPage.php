<?php $title = "Результаты поиска - ShopKirov - магазин бытовой техники и электроники в Кирове";
include __DIR__ . '/../header.php';
include __DIR__ . '/../features/search.php';
?>

<div style="margin: 15px;">
    <?php if (empty($error)) : ?>
        <?php foreach ($articles as $article) : ?>
            <table>
                <tr>
                    <td>
                        <?php
                        $image = base64_encode($article->getImage());
                        if (!empty($image) && $image != "IA==") : ?>
                            <img class="image small" src="data:image/png;base64, <?= $image ?? null ?>  " />
                        <?php else : ?>
                            <img class="image small" src="/images/catalog/no-image.png " ">
                        <?php endif; ?>
                    </td>
                    <td>
                        <h2>
                            <a href=" /catalog/articles/<?= $article->getId()  //TODO изменить ссылку /catalog/articles/
                              ?>/">
                            <!-- Ccылка на статью для каждого id найденного foreach -->
                            <?= $article->getName() ?>
                            </a> <!-- Вывод имени -->
                            </h2>
                            <p><?= $article->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                            <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
                            <hr>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
</div>

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
                <a href="/search/<?= $pageNum === 1 ? '1' : $pageNum ?>"><?= $pageNum ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </section>
</div>
<?php endif; ?>

<?php if (!empty($error)) : ?>
    <div style="background-color: rgba(255, 255, 128, .5); padding: 5px; margin: 15px"><?= $error ?></div>
<?php endif; ?>

<?php include __DIR__ . '/../rightSidebar.php'; ?>