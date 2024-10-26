<?php $title = "Наши работы";
include __DIR__ . '/../header.php';
?>
<div class="main">
    <div style="padding-left: 10px;">
        <h2 style="padding-bottom: 10px">Наши работы</h2>
        <?php foreach ($articles as $article) : ?>
            <h2 class=" font-text-head text-big td2-text-bold a-edit">
                <?= $article->getName() ?>
            </h2>
            <?php
            $image = base64_encode($article->getImage());
            if (!empty($image) && $image != "IA==") : ?>
                <img class="image middle" style="margin: auto" src="data:image/png;base64, <?= $image ?>">
            <?php else : ?>
                <img class="image middle" style="margin: auto" src="/images/catalog/no-image.png ">
            <?php endif; ?>
            <p><?= $article->getParsedText() ?></p>
            <a class="text-grey"><?= $article->getCreatedAt() ?></a>
            <hr>
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
                    <li class="page-item"><a class="page-link my-pagination" href="/news/<?= $pageNum ?>"><?= $pageNum ?></a></li>
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
</div>


<?php include __DIR__ . '/../rightSidebar.php'; ?>