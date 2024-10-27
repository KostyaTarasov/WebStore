<aside class="right-sidebar">
    <td class="sidebar a-edit">
        <?php
        if ((!empty($user) && $user->isAdmin())) : ?>
            <div class="sidebarHeader">Меню</div>
            <br>
            <ul>
                <?php
                if (!empty($templateName) & $templateName == 'catalogs/products.php') { ?>
                    <div class="underlining">
                        <a class="btn btn-primary" href="catalog/<?= $nameTableCatalog ?>/add">Добавить товар</a>
                    </div>
                <?php } elseif (!empty($templateName) & $templateName == 'news/news.php') { ?>
                    <div class="underlining">
                        <a class="btn btn-primary" href="/news/add">Добавить работу</a>
                    </div>
                <?php } elseif (!empty($templateName) & $templateName == 'catalogs/catalog.php') { ?>
                    <div class="underlining">
                        <a class="btn btn-primary" href="/catalogs/add">Добавить каталог</a>
                    </div>
                <?php } ?>
            </ul>
        <?php endif; ?>
    </td>
</aside>

<footer class="footer">Все права защищены &copy; <?= date('Y') ?></footer>
</div>
</div>
</body>

</html>