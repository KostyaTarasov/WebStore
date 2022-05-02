<form style=" margin: 15px" action="/search" method="post">
    <label>Введите ключевое слово <input type="text" name="search" value="<?= $_POST['search'] ?? '' ?>"></label>
    <br><br>
    <input type="submit" value="Искать">
</form>