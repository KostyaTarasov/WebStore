<form style=" margin: 15px" action="/search" method="post">
    <label> <input type="text" name="search" placeholder="Поиск по сайту" value="<?= $_POST['search'] ?? '' ?>"></label>
    <input type="submit" class="buttonSearch" value=" Искать">
</form>