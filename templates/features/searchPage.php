<?php $title = "Поиск: {$_SESSION['postSearch']['search']} в";
include __DIR__ . '/../header.php';
?>

<?php if (!empty($error)) : ?>
    <div style="background-color: rgba(255, 255, 128, .5); padding: 5px; margin: 15px"><?= $error ?></div>
<?php else : ?>
    <div style="margin: 15px;">
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
                        <h2 class="font-text-head text-big td2-text-bold a-edit">
                            <a href=" /catalog/<?= $article->getValueNewColTable() ?>/<?= $article->getId() ?>/">
                                <!-- Ccылка на статью для каждого id найденного foreach -->
                                <?= $article->getName() ?>
                            </a> <!-- Вывод имени -->
                            </h2>
                            <p><?= $article->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
                            <p>Цена: <?= $article->getPrice() ?> ₽</p>
                            <hr>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
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
                    <li class="page-item"><a class="page-link my-pagination" href="/search/<?= $pageNum ?>"><?= $pageNum ?></a></li>
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
<?php endif; ?>

<?php include __DIR__ . '/../rightSidebar.php'; ?>