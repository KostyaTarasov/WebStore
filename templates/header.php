<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../www/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

</head>

<body>
    <!--<div class="container mt-5"> -->
    <header>

        <div class="row">
            <div class="col-4">
                <div class="text-header text-header-left">
                    <a>Адрес: г.Киров, ул.Ленина 1</a>
                    <a>С 08-00 до 18-00</a>
                </div>
            </div>
            <div class="col-4">
                <div class="text-header text-header-middle">
                    <a href="/">Главная</a>
                    <a href="/../templates/pages/about.php">О себе</a>
                    <a href="/../manual.php">Документация по PHP</a>
                </div>
            </div>
            <div class="col-4">
                <div class="text-header text-header-right">
                    <a>Тел: 8-800-800-8888</a>
                </div>
            </div>
        </div>
    </header>
    <table class="layout">

        <tr>
            <td colspan="1" class="sidebar">
            </td>

            <td colspan="1" class="header-lower">
                <h2 class="header-h">
                    <?php if (!empty($h1)) {
                        echo $h1;
                    } ?>
                </h2>
            </td>

            <td colspan="1" class="accountLogin">
                <div class="underlining">
                    <?php if (!empty($user)) : ?>
                        Привет, <?= $user->getNickname() ?> | <a href="/../users/logOut">Выйти</a>
                    <?php else : ?>
                        <a href="/../users/login">Войти</a> | <a href="/../users/register">Зарегестрироваться</a>
                    <?php endif; ?>
                </div>
            </td>
        </tr>

        <tr>
            <td class="sidebar">
                <?php if (empty($_REQUEST) || $_REQUEST['route'] != 'catalog') include __DIR__ . '/leftSidebar.php' ?>
            </td>

            <td>