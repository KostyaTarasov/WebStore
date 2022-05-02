<?php $title = "Каталоги";
include __DIR__ . '/../header.php'; ?>

<form action="/search" method="post">
    <label>Введите ключевое слово <input type="text" name="search" value="<?= $_POST['search'] ?? '' ?>"></label>
    <br><br>
    <input type="submit" value="Искать">
</form>

<div>
    <table class="table2">
        <?php foreach (array_chunk($articles, 4) as $value) : ?>
            <tr>
                <?php foreach ($value as $item) : ?>
                    <td class="td2">
                        <img class="imageSmall" src="<?= $item->getPathImage() ?>" ">

                        <h2>
                            <a href=" /catalog/<?= $item->getNameTable() ?>/page/1">
                        <!-- Ccылка на статью -->
                        <?= $item->getName() ?>
                        </a> <!-- Вывод имени -->
                        </h2>

                        <p><?= $item->getText() ?></p>
                        <hr>

                        <form action="/catalog/<?= $item->getNameTable() ?>/page/1">
                            <input type="hidden" />
                            <button type="submit">Открыть</button>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include __DIR__ . '/../footer.php'; ?>