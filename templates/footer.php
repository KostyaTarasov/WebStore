</td>

<td class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/../templates/pages/about.php">О себе</a></li>
        <li><a href="/../manual.php">Документация по PHP</a></li>
        <br>
        <li><a href="/../hello/Kostya">Страница приветствия</a></li>
        <?php if (!empty($user) && $user->isAdmin()) : // Ссылка будет доступна только админу для добавления статьи
        ?>
            <li><a href="/../articles/add">Страница добавления статей</a></li>
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