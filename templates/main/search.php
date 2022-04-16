<?php $title = "Мой личный блог";
include __DIR__ . '/../header.php'; ?>

    <form action="/search" method="post">
        <label>Введите ключевое слово <input type="text" name="search" value="<?= $_POST['search'] ?? '' ?>"></label>
        <br><br>
        <input type="submit" value="Искать">
    </form>

<?php foreach ($articles as $article) : ?>
    <!-- Проход по полученным даннымм -->
    <h2>
        <a href="/articles/<?= $article->getId() ?>">
            <!-- Ccылка на статью для каждого id найденного foreach -->
            <?= $article->getName() ?>
        </a> <!-- Вывод имени -->
    </h2>
    <p><?= $article->getParsedText() ?></p> <!-- Вывод основного текста через парсер Markdown-разметки getParsedText(), без парсера getText()-->
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <hr>
<?php endforeach; ?>


<!-- Пагинация, выводить на каждой странице блога по 5 записей
SELECT * FROM articles ORDER BY id DESC LIMIT 5 OFFSET 0;
где
DESC Отсортировать в обратном направлении по id, 
OFFSET Пропустить первые 0 строк, 
LIMIT вывести следующие 5 строк:

Для второй страницы запрос будет следующим:
SELECT * FROM articles ORDER BY id DESC LIMIT 5 OFFSET 5;

Получаем формулу для получения запроса, которые выводит записи на n-ой странице блога, где k-число записей на одной странице:
SELECT * FROM articles ORDER BY id DESC LIMIT k OFFSET (n-1)*k;

Вывод ссылок на страницы со статьями внизу страницы.
При формировании ссылки на страницу мы проверяем, является ли страница первой, 
и если это так, то формируем ссылку на главную страницу, иначе формируем ссылку вида: /n, 
где n – номер страницы.

условие if ($currentPageNum === $pageNum) если номер = текущая страница то выводить её обычным жирным текстом, в других проходах цикла for будут остальные номера являться ссылкой
-->
<div style="text-align: center">
    <section>
        <?php if ($previousPageLink !== null) : ?>
            <a href="<?= $previousPageLink ?>">&lt; Назад</a>
        <?php else : ?>
            <span style="color: grey">&lt; Назад</span>
        <?php endif; ?>
        &nbsp;&nbsp;&nbsp;
        <?php if ($nextPageLink !== null) : ?>
            <a href="<?= $nextPageLink ?>">Вперёд &gt;</a>
        <?php else : ?>
            <span style="color: grey">Вперёд &gt;</span>
        <?php endif; ?>
    </section>

    <section>
        <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++) : ?>
            <?php if ($currentPageNum === $pageNum) : ?>
                <b><?= $pageNum ?></b>
            <?php else : ?>
                <a href="/search/<?= $pageNum === 1 ? '1' : $pageNum ?>"><?= $pageNum ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </section>
</div>

<?php include __DIR__ . '/../footer.php'; ?>