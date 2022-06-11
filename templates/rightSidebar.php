</td>
<td class="sidebar a-edit">
    <?php // Админское меню только для пользователя с ролью админ
    if ((!empty($user) && $user->isAdmin())) : ?>
        <div class="sidebarHeader">Меню</div>
        <br>
        <ul>
            <?php // Отображение ссылки для добавления новых статей, товаров
            if (!empty($templateName) & $templateName == 'catalogs/products.php') { ?>
                <div class="underlining">
                    <li><a href="catalog/<?= $nameTableCatalog ?>/add">Добавить товар</a></li>
                </div>
            <?php } ?>
        </ul>
    <?php endif; ?>
</td>
</tr>
</table>
</div>
</body>
<div class="footer">Все права защищены &copy; 2022</div>

</html>