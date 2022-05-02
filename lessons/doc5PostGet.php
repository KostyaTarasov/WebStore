<?php
$title = "5 Методы post и get";
include_once "../blocks/header.php"; // при include остальная часть страницы будет загружаться при ошибке пути
// _once  Произойдёт единожды вызов header.php при нескольких вызовах
?>

<div class="container mt-2">
    <h3>Через post</h3>
    <form action="check_post5.php" method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Введите имя" class="form-control"><br>
        <input type="email" name="email" placeholder="Введите email" class="form-control"><br>
        <input type="password" name="password" placeholder="Введите пароль" class="form-control"><br>
        <textarea name="message" placeholder="Введите сообщение" class="form-control"></textarea><br>
        <input type="submit" value="Отправить" class="btn btn-success"> <br>

        <input type="file" name="file"> <!-- Загрузка картинки, только через метод post! -->
    </form>
</div>

<div class="container mt-2">
    <h3>Через get</h3>
    <form action="check_get5.php" method="get">
        <!-- Данные передаются через url -->
        <input type="text" name="username" placeholder="Введите имя" class="form-control"><br>
        <input type="email" name="email" placeholder="Введите email" class="form-control"><br>
        <input type="password" name="password" placeholder="Введите пароль" class="form-control"><br>
        <textarea name="message" placeholder="Введите сообщение" class="form-control"></textarea><br>
        <input type="submit" value="Отправить" class="btn btn-success"> <br>


        <input type="reset" value="Очистить заполненные поля" class="submit"> <br>
        <input type="checkbox" name="tranport[]" value="Car">Велосипед<br>
        <input type="radio" name="gender" value="Мужчина" checked>Мужчина<br>
        <input type="radio" name="gender" value="Женщина" checked>Женщина<br>

        <select name="list">
            <option value="Лондон">выбрать Лондон</option>
            <option value="Милан">выбрать Милан</option>
            <option value="Анкара">выбрать Анкару</option>
        </select>
    </form>
</div>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php"; // при require остальная часть страницы не будет загружаться при ошибке пути
?>