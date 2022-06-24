<?php
$title = "Авторизация";
include __DIR__ . '/../header.php'; ?>
<div style="text-align: center;">
        <?php if (!empty($message)) {
            include __DIR__ . '/../messages/message.php';
        } ?>
        <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        <br><br>
        <input type="submit" class="btn btn-success" value="Войти">
    </form>
    <hr>
    <div class="underlining">
        <a href="/../users/register">Зарегистрироваться</a>
    </div>
    <hr>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>