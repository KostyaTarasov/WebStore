<?php $title = "$nameCatalog купить в KirovShop";
$h1 = "$nameCatalog";
include __DIR__ . '/../header.php';
?>
<div class="main">
    <ul class="products-list">
        <?php foreach ($articles as $item) : ?>
            <li class="products-item a-edit" onclick="location.href='/catalog/<?= $nameTableCatalog ?>/<?= $item->getId() ?>/'">
                <h2 class="font-text-head products-title text-big">
                    <a href="/catalog/<?= $nameTableCatalog ?>/<?= $item->getId() ?>/">
                        <?= $item->getName() ?>
                    </a>
                </h2>
                <p class="margin-null"><?= $item->getParsedText() ?></p>
                <hr class="margin-null" />
                <p class="margin-null">Цена: <?= $item->getPrice() ?> ₽</p>
                <?php
                $image = base64_encode($item->getImage());
                if (!empty($image) && $image != "IA==") : ?>
                    <img class="image small" src="data:image/png;base64, <?= $image ?>">
                <?php else : ?>
                    <img class="image small" src="/images/catalog/no-image.png ">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <nav aria-label="Пацинация страниц">
        <ul class="pagination justify-content-center">
            <?php if ($previousPageLink != null) : ?>
                <li class="page-item">
                    <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $previousPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-left-circle.svg"></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link"><img class="vertical-bottom" src="/images/svg/arrow-left-circle-inactive.svg"></a>
                </li>
            <?php endif; ?>
            <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
                <?php if ($currentPageNum === $pageNum) : ?>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link my-pagination-active"><?= $pageNum ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link my-pagination" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $pageNum ?>"><?= $pageNum ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($nextPageLink !== null) : ?>
                <li class="page-item">
                    <a class="page-link" href="/catalog/<?= $nameTableCatalog ?>/page/<?= $nextPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-right-circle.svg"></a>
                </li>
            <?php else : ?>
                <li class="page-item disabled">
                    <a class="page-link"><img class="vertical-bottom" src="/images/svg/arrow-right-circle-inactive.svg"></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>