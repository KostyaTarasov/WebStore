<?php $title = "$nameCatalog купить в";
$h1 = "$nameCatalog";
include __DIR__ . '/../header.php';
?>

<div>
    <table class="table2 a-edit">
        <?php foreach (array_chunk($articles, 4) as $value) : ?>
            <tr>
                <?php foreach ($value as $item) : ?>
                    <td class="td2" onclick="location.href='/catalog/<?= $nameTableCatalog ?>/<?= $item->getId() ?>/'">
                        <h2 class="td2-text-head">
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
                            <img class="image small" src="data:image/png;base64, <?= $image ?>">
                        <?php else : ?>
                            <img class="image small" src="/images/catalog/no-image.png ">
                        <?php endif; ?>
                        <hr>
                        <p>Цена: <?= $item->getPrice() ?> ₽</p>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<nav aria-label="Пацинация страниц">
    <ul class="pagination justify-content-center">
        <?php if ($previousPageLink != null) : ?>
            <li class="page-item">
                <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $previousPageLink ?>">&lt;</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <a class="page-link">&lt;</a>
            </li>
        <?php endif; ?>
        <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
            <?php if ($currentPageNum === $pageNum) : ?>
                <li class="page-item active" aria-current="page">
                    <a class="page-link"><?= $pageNum ?></a>
                </li>
            <?php else : ?>
                <li class="page-item"><a class="page-link " href="/catalog/<?= $nameTableCatalog ?>/page/<?= $pageNum ?>"><?= $pageNum ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($nextPageLink !== null) : ?>
            <li class="page-item">
                <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $nextPageLink ?>">&gt;</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <a class="page-link">&gt;</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php include __DIR__ . '/../rightSidebar.php'; ?>