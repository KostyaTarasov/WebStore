<?php $title = "$nameCatalog купить в";
$h1 = "$nameCatalog";
include __DIR__ . '/../header.php';
include __DIR__ . '/../features/search.php';
//TODO Добавить столбик цена, сделать возможность редактирования цены также как редактируется столбик текст
?>

<div>
    <table class="table2">
        <?php foreach (array_chunk($articles, 4) as $value) : ?>
            <tr>
                <?php foreach ($value as $item) : ?>
                    <td class="td2">
                        <h2>
                            <a href="/catalog/<?= $nameTableCatalog ?>/<?= $item->getId() ?>/">
                                <!-- Ccылка на статью для каждого id найденного -->
                                <?= $item->getName() ?>
                            </a> <!-- Вывод имени -->
                        </h2>
                        <p><?= $item->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                        <p>Автор: <?= $item->getAuthor()->getNickname() ?></p>
                        <?php
                        $image = base64_encode($item->getImage());
                        if (!empty($image) && $image != "IA==") : ?>
                            <img class="image small" src="data:image/png;base64, <?= $image ?? null ?>  " />
                        <?php endif; ?>
                        <hr>
                        <form action="/catalog/<?= $nameTableCatalog ?>/<?= $item->getId() ?>/">
                            <input type="hidden" />
                            <button class="buttonMore" type="submit">Подробнее</button>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<!-- Пагинация, выводить на каждой странице по 8 записей
SELECT * FROM articles ORDER BY id DESC LIMIT 8 OFFSET 0;
-->
<div style="text-align: center">
    <section>
        <?php if ($previousPageLink !== null) : ?>
            <a href="/catalog/<?= $nameTableCatalog ?>/page/<?= $previousPageLink ?>">&lt; Назад</a>
        <?php else : ?>
            <span style="color: grey">&lt; Назад</span>
        <?php endif; ?>
        &nbsp;&nbsp;&nbsp;
        <?php if ($nextPageLink !== null) : ?>
            <a href="/catalog/<?= $nameTableCatalog ?>/page/<?= $nextPageLink ?>">Вперёд &gt;</a>
        <?php else : ?>
            <span style="color: grey">Вперёд &gt;</span>
        <?php endif; ?>
    </section>

    <section>
        <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
            <?php if ($currentPageNum === $pageNum) : ?>
                <b><?= $pageNum ?></b>
            <?php else : ?>
                <a href="/catalog/<?= $nameTableCatalog ?>/page/<?= $pageNum ?>"><?= $pageNum ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </section>
</div>

<?php include __DIR__ . '/../rightSidebar.php'; ?>