<?php $title = "Каталог товаров";
$h1 = $title;
include __DIR__ . '/../header.php';
?>

<div>
    <table class="table2 a-edit">
        <?php foreach (array_chunk($articles, 4) as $value) : ?>
            <tr>
                <?php foreach ($value as $item) : ?>
                    <td class="td2" onclick="location.href='/catalog/<?= $item->getNameTable() ?>'">
                        <img class="image small" src="<?= $item->getPathImage() ?>" ">
                        <h3>
                            <a href=" /catalog/<?= $item->getNameTable() ?>">
                        <!-- Ccылка на статью -->
                        <?= $item->getName() ?>
                        </a> <!-- Вывод имени -->
                        </h3>
                        <p><?= $item->getText() ?></p>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include __DIR__ . '/../rightSidebar.php'; ?>