<?php
$title = "Регистрация";
include __DIR__ . '/../header.php'; ?>
<link rel="stylesheet" href="/../www/styles/login.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<div class="body-login">
    <div style="text-align: center;">
        <?php if (!empty($message)) {
            include __DIR__ . '/../messages/message.php';
        } ?>
        <div id="login_container">
            <div id="form_container">
                <h1 class="login-text-head">Регистрация</h1>
                <form action="/users/register" method="post">
                    <div class="form-group mt-2">
                        <i class="input-icon uil-user"></i>
                        <input type='text' class='text_input form-style' placeholder="Имя" name='nickname' value="<?= $_POST['nickname'] ?? '' ?>" />
                    </div>
                    <div class="form-group mt-2">
                        <i class="input-icon uil-at"></i>
                        <input type='text' class='text_input form-style' placeholder="Email" name='email' value="<?= $_POST['email'] ?? '' ?>" />
                    </div>
                    <div class="form-group mt-2">
                        <i class="input-icon uil-lock-alt"></i>
                        <input type='password' class='text_input form-style' placeholder="Пароль" name="password" value="<?= $_POST['password'] ?? '' ?>" />
                    </div>
                    <input type='submit' class="btn btn-success" value="" id='login' />
                </form>
                <div style="top:40px; position:relative;">
                    <div>
                        У вас уже есть учетная запись? <a class="text-a-underline" href="/../users/login">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>