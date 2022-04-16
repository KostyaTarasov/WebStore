<?php
session_start();
$title = "10 Форма обратной связи";
require_once  "../templates/header.php";
// В данной программе при обновлении страницы и пустых полях автоматически заполняются поля из сессии, ранее вводимые данные
// Благодаря сессии при отправке данных и редиректе обратно на страницу, отображаются ошибки у полей с неправльно заполненными полями (данные с помощью сессии передаются)

// Отображаются ошибки на phpServer, на Mamp без ошибок(без стилей и имя файла index.php в файле chech_contact для редиректа не забыть указать в function redirect()  и в index.php указать в самом начале до title в php коде: phpsession_start();
?>

<div class="text-success"><?= $_SESSION['success_mail'] ?></div>

<form action="check_contact10.php" method="post">
    <!-- передаём данные в файл с помощью метода post-->
    <input type="text" name="username" value="<?= $_SESSION['username'] ?>" placeholder="Введите имя" class="form-control">
    <div class="text-danger"><?= $_SESSION['error_username'] ?></div><br>

    <input type="email" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Введите email" class="form-control">
    <div class="text-danger"><?= $_SESSION['error_email'] ?></div><br>

    <input type="text" name="subject" value="<?= $_SESSION['subject'] ?>" placeholder="Тема сообщения" class="form-control">
    <div class="text-danger"><?= $_SESSION['error_subject'] ?></div><br>

    <textarea name="message" placeholder="Ваше сообщение" class="form-control"><?= $_SESSION['message'] ?></textarea>
    <div class="text-danger"><?= $_SESSION['error_message'] ?></div><br>

    <button type="submit" class="btn btn-success">Отправить</button><br>
</form>


<?php
echo "<br>";
require_once  "../templates/footer.php";
?>