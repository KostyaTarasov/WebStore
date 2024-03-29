<?php
$title = "Авторизация";
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
                <h1 class="login-text-head">Авторизация</h1>
                <form action="/users/login" method="post">
                    <div class="form-group mt-2">
                        <i class="input-icon uil-at"></i>
                        <input type='text' class='text_input form-style' placeholder="Email" name='email' value="<?= $_POST['email'] ?? '' ?>" />
                    </div>
                    <div class="form-group mt-2">
                        <i class="input-icon uil-lock-alt" style="bottom:22px;"></i>
                        <input type='password' class='text_input form-style' placeholder="Пароль" name="password" value="<?= $_POST['password'] ?? '' ?>" />
                        <label style="display: block; text-align:right; font-size: 14px; padding-right: 40px;" for="password">
                            <a class="text-a-underline" type="button" data-bs-toggle="modal" data-bs-target="#passwordRec">Забыли пароль?</a>
                        </label>
                    </div>
                    <input style="top:19px; position:relative;" type='submit' value='' id='login' />
                </form>
            </div>
            <div style="top:175px; position:relative;">
                <div>
                    <a class="text-a-underline" href="/../users/register">У вас нет аккаунта? Зарегистрируйтесь сейчас.</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="passwordRec" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Укажите свой email, и мы отправим на него ссылку для восстановления пароля.
                    </div>
                    <form action="/users/password-rec" method="post">
                        <div class="form-group">
                            <i class="input-icon uil-at"></i>
                            <input type='text' class='text_input form-style' placeholder="Email" name='email' value="<?= $_POST['email'] ?? '' ?>" />
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type='submit' class="btn btn-warning" data-bs-dismiss="modal">СБРОСИТЬ ПАРОЛЬ <img src="/images/svg/arrow-right.svg"> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include __DIR__ . '/../rightSidebar.php'; ?>