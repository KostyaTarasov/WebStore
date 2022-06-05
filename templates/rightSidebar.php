</td>

<?php // Админское меню только для пользователя с ролью админ
if ((!empty($user) && $user->isAdmin())) : ?>
    <td class="sidebar a-edit">
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
    </td>
<?php endif; ?>
</tr>
</table>
</div>
</body>
<div class="footer">Все права защищены &copy; 2022</div>

</html>