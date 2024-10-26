<?php $title = $commonInformation[0]->getTitle();
$h1 = $commonInformation[0]->getH();
include __DIR__ . '/../header.php';
?>
<div class="main">
    <h1 style="font-size: 14pt; font-weight: normal; padding-left: 1rem;"><?= $h1 ?> </h1>

    <section aria-label="Каталог" class="content-container section-content works-section">
        <h2 style="padding-bottom: 10px">Каталог</h2>
        <div class="catalog-navigation">
            <button class="scroll-btn catalog-btn" onclick="scrollCatalogLeft()">
                <img class="vertical-bottom" src="/images/svg/arrow-left-circle.svg">
            </button>

            <div class="works-wrapper wrapper catalog-wrapper-lines catalog-wrapper">
                <div class="works-row">
                    <?php foreach ($catalog as $item) : ?>
                        <li class="products-item a-edit" onclick="location.href='/catalog/<?= $item->getNameTable() ?>/'">
                            <div class="tdJust">
                                <p class="font-text-head text-middle"><?= $item->getName() ?></p>
                                <img class="image small" src="<?= $item->getPathImage() ?>">
                            </div>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="scroll-btn catalog-btn" onclick="scrollCatalogRight()">
                <img class="vertical-bottom" src="/images/svg/arrow-right-circle.svg">
            </button>
        </div>
    </section>

    <section aria-label="Популярные товары" class="content-container section-content works-section">
        <h2 style="padding-bottom: 10px">Хиты продаж</h2>
        <div class="catalog-navigation">
            <button class="scroll-btn popular-btn" onclick="scrollPopularGoodsLeft()">
                <img class="vertical-bottom" src="/images/svg/arrow-left-circle.svg">
            </button>

            <div class="works-wrapper wrapper catalog-wrapper-lines popular-goods-wrapper">
                <div class="works-row">
                    <?php foreach ($articles as $item) : ?>
                        <li class="products-item a-edit" onclick="location.href='/catalog/popularnye_tovary/<?= $item->getId() ?>/'">
                            <div class="tdJust">
                                <h3 class="font-text-head products-title text-big">
                                    <a href="/catalog/popularnye_tovary/<?= $item->getId() ?>/">
                                        <?= $item->getName() ?>
                                    </a>
                                </h3>
                                <p class="margin-null"><?= $item->getParsedText() ?></p>
                                <?php
                                $image = base64_encode($item->getImage());
                                if (!empty($image) && $image != "IA==") : ?>
                                    <img class="image small" src="data:image/png;base64, <?= $image ?> ">
                                <?php else : ?>
                                    <img class="image small" src="/images/catalog/no-image.png ">
                                <?php endif; ?>
                                <hr>
                                <p class="margin-null">Цена: <?= $item->getPrice() ?> ₽</p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="scroll-btn popular-btn" onclick="scrollPopularGoodsRight()">
                <img class="vertical-bottom" src="/images/svg/arrow-right-circle.svg">
            </button>
        </div>

        <!-- 
        <nav aria-label="Пацинация страниц">
            <ul class="pagination justify-content-center">
                <?php if ($previousPageLink != null) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $previousPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-left-circle.svg"></a>
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
                        <li class="page-item"><a class="page-link my-pagination" href="<?= $pageNum ?>"><?= $pageNum ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($nextPageLink !== null) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $nextPageLink ?>"><img class="vertical-bottom" src="/images/svg/arrow-right-circle.svg"></a>
                    </li>
                <?php else : ?>
                    <li class="page-item disabled">
                        <a class="page-link"><img class="vertical-bottom" src="/images/svg/arrow-right-circle-inactive.svg"></a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav> -->
    </section>

    <section aria-label="Наши работы" class="content-container section-content works-section">
        <h2 style="padding-bottom: 10px">Наши работы</h2>
        <div class="works-wrapper">
            <div class="works-row">
                <?php foreach ($news as $item) : ?>
                    <div class="tdJust">
                        <p class="text-grey"><?= $item->getCreatedAt() ?></p>
                        <p class="font-text-head text-middle"><?= $item->getName() ?></з>
                            <?php
                            $image = base64_encode($item->getImage());
                            if (!empty($image) && $image != "IA==") : ?>
                                <img class="image middle" style="margin: auto" src="data:image/png;base64, <?= $image ?>">
                            <?php else : ?>
                                <img class="image middle" style="margin: auto" src="/images/catalog/no-image.png ">
                            <?php endif; ?>
                            <a><?= $item->getParsedText() ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <a class="link-all-news" href="/news">Посмотреть ещё</a>
        </div>
    </section>

    <section aria-label=" Контакты">
        <?php include __DIR__ . '/../pages/contact.php'; ?>
    </section>
</div>

<script>
    function scrollCatalogLeft() {
        const catalogContainer = document.querySelector('.catalog-wrapper');
        catalogContainer.scrollBy({
            left: -240, // Прокрутка влево на 240 пикселей
            behavior: 'smooth'
        });
    }

    function scrollCatalogRight() {
        const catalogContainer = document.querySelector('.catalog-wrapper');
        catalogContainer.scrollBy({
            left: 240, // Прокрутка вправо на 240 пикселей
            behavior: 'smooth'
        });
    }

    function scrollPopularGoodsLeft() {
        const catalogContainer = document.querySelector('.popular-goods-wrapper');
        catalogContainer.scrollBy({
            left: -240, // Прокрутка влево на 240 пикселей
            behavior: 'smooth'
        });
    }

    function scrollPopularGoodsRight() {
        const catalogContainer = document.querySelector('.popular-goods-wrapper');
        catalogContainer.scrollBy({
            left: 240, // Прокрутка вправо на 240 пикселей
            behavior: 'smooth'
        });
    }
</script>

<?php include __DIR__ . '/../rightSidebar.php'; ?>