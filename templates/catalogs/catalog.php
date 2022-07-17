<?php $title = "Каталог товаров";
$h1 = $title;
include __DIR__ . '/../header.php';
?>
<div class="main a-edit">
    <ul class="products-list">
        <?php foreach ($articles as $item) : ?>
            <li class="products-item a-edit" onclick="location.href='/catalog/<?= $item->getNameTable() ?>'">
                <img class="image small" src="<?= $item->getPathImage() ?>" ">
                    <h2 class=" font-text-head products-title text-big">
                <a href="/catalog/<?= $item->getNameTable() ?>">
                    <!-- Ccылка на статью -->
                    <?= $item->getName() ?>
                </a> <!-- Вывод имени -->
                </h2>
                <p class="margin-null"><?= $item->getText() ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include __DIR__ . '/../rightSidebar.php'; ?>