</td>

<td class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <br>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/../templates/pages/about.php">О себе</a></li>
        <li><a href="/../manual.php">Документация по PHP</a></li>
        <br>
        <li><a href="/../hello/Kostya">Страница приветствия</a></li>

        <?php
        $rule0 = false;
        $rule1 = false;
        $rule2 = false;
        if ($_SERVER['REQUEST_URI'] == "/") { // Если главная страница
            $rule0 = true;
        } else if ((strripos($_SERVER['REDIRECT_URL'], 'page') != false)) { // Если страница открытого каталога
            $rule1 = true;
        } else if ((preg_replace('/[0-9]/', '', $_SERVER['REDIRECT_URL']) == "/") == true) { // Если главная страница с номером. /1 /2 ...
            $rule2 = true;
        }
        if ((!empty($user) && $user->isAdmin()) && ($rule0 == true || $rule1 == true || $rule2 == true)) : // Ссылка будет доступна только админу для добавления статьи на глвной странице, странице открытых каталогов.
        ?>
            <li><a href="../add">Страница добавления статей</a></li>
        <?php endif; ?>
    </ul>
</td>
</tr>

<tr>
    <td class="footer" colspan="3">Все права защищены &copy; 2022</td>
</tr>
</table>

</body>

</html>