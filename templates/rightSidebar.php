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
                        <li><a href="catalog/<?= $nameTableCatalog ?>/add">Добавить товар</a></li>
                    </div>
                <?php }
                if (!empty($templateName) & $templateName == 'news/news.php') { ?>
                    <div class="underlining">
                        <li><a href="/news/add">Добавить новость</a></li>
                    </div>
                <?php } ?>
            </ul>
        <?php endif; ?>
    </td>
</aside>

<footer class="footer">Все права защищены &copy; 2022</footer>
</div>
</div>
</body>

</html>