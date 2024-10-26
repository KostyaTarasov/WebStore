<?php $title = "";
$h1 = "Главная страница";
include __DIR__ . '/../header.php';
?>
<div class="main">
    <section aria-label="Популярные товары" class="content-container">
        <h2 style="padding-left: 1rem; padding-bottom: 10px">Хиты продаж</h2>
        <ul class="products-list">
            <?php foreach ($articles as $item) : ?>
                <li class="products-item a-edit" onclick="location.href='/catalog/popularnye_tovary/<?= $item->getId() ?>/'">
                    <h2 class="font-text-head products-title text-big">
                        <a href="/catalog/popularnye_tovary/<?= $item->getId() ?>/">
                            <?= $item->getName() ?>
                        </a>
                    </h2>
                    <p class="margin-null"><?= $item->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                    <p class="margin-null">Автор: <?= $item->getAuthor()->getNickname() ?></p>
                    <?php
                    $image = base64_encode($item->getImage());
                    if (!empty($image) && $image != "IA==") : ?>
                        <img class="image small" src="data:image/png;base64, <?= $image ?> ">
                    <?php else : ?>
                        <img class="image small" src="/images/catalog/no-image.png ">
                    <?php endif; ?>
                    <hr>
                    <p class="margin-null">Цена: <?= $item->getPrice() ?> ₽</p>
                </li>
            <?php endforeach; ?>
        </ul>

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
        </nav>
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

    <section aria-label="Контакты">
        <?php include __DIR__ . '/../pages/contact.php'; ?>
    </section>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>