<?php $title = "";
$h1 = "Главная страница";
include __DIR__ . '/../header.php';
?>

<section aria-label="Популярные товары">
    <div>
        <table class="table2 a-edit">
            <h2 style="padding: 10px;">Хиты продаж</h2>
            <?php foreach (array_chunk($articles, 4) as $value) : ?>
                <tr>
                    <?php foreach ($value as $item) : ?>
                        <td class="td2" onclick="location.href='/catalog/articles/<?= $item->getId() ?>/'">
                            <h3 class="td2-text-head text-big">
                                <a href="/catalog/articles/<?= $item->getId() ?>/">
                                    <!-- Ccылка на статью для каждого id найденного -->
                                    <?= $item->getName() ?>
                                </a> <!-- Вывод имени -->
                            </h3>
                            <p><?= $item->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                            <p>Автор: <?= $item->getAuthor()->getNickname() ?></p>
                            <?php
                            $image = base64_encode($item->getImage());
                            if (!empty($image) && $image != "IA==") : ?>
                                <img class="image small" src="data:image/png;base64, <?= $image ?> ">
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

<section aria-label="Последние новости">
    <div>
        <table class="table2 a-edit">
            <h2 style="padding: 10px;">Новости</h2>
            <?php foreach (array_chunk($news, 4) as $value) : ?>
                <tr>
                    <?php foreach ($value as $item) : ?>
                        <td class="tdJust">
                            <p class="text-grey"><?= $item->getCreatedAt() ?></p>
                            <a class="td2-text-head text-middle">
                                <?= $item->getName() ?>
                            </a>
                            <a><?= $item->getParsedText() ?></a> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div>
        <a class="link-all-news" href="/news">Все новости</a>
    </div>
</section>
<?php include __DIR__ . '/../rightSidebar.php'; ?>