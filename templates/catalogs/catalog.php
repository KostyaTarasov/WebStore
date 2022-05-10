<?php $title = "Каталог товаров";
$h1 = $title;
include __DIR__ . '/../header.php';
include __DIR__ . '/../features/search.php';
?>
<div>
    <table class="table2">
        <?php foreach (array_chunk($articles, 4) as $value) : ?>
            <tr>
                <?php foreach ($value as $item) : ?>
                    <td class="td2">
                        <img class="image small" src="<?= $item->getPathImage() ?>" ">

                        <h2>
                            <a href=" /catalog/<?= $item->getNameTable() ?>">
                        <!-- Ccылка на статью -->
                        <?= $item->getName() ?>
                        </a> <!-- Вывод имени -->
                        </h2>

                        <p><?= $item->getText() ?></p>
                        <hr>

                        <form action="/catalog/<?= $item->getNameTable() ?>">
                            <input type="hidden" />
                            <button class="buttonMore" type="submit">Открыть</button>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include __DIR__ . '/../rightSidebar.php'; ?>