<?php
$title = "Регистрация";
include __DIR__ . '/../header.php'; ?>
<div style="text-align: center;">
    <h1>Регистрация</h1>

    <!-- В случае исключения в контроллере UsersController.php метода signUp()
        Выводим переменную error, если она не пустая -->
    <?php if (!empty($error)) : ?>
        <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
    <?php endif; ?>

    <form action="/users/register" method="post">
        <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname'] ?? '' ?>"> </label>
            <!-- Где атрибут value используем для вывода данных, которые были переданы в запросе, (чтобы их не терять при отправки данных (К примеру пользователь не ввёл email, при обновленнии страницы значение nickname сохранится (Пользоваетль не будет вводить все данные заново))) -->
            <br><br>
            <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
            <br><br>
            <label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
            <br><br>
            <input type="submit" class="btn btn-success" value="Зарегистрироваться">
    </form>
    <hr>
    <div class="underlining">Уже зарегистрировались?
        <a href="/../users/login">Войти</a>
    </div>
    <hr>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>