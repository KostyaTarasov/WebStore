<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../www/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/images/personal/favicon.ico" type="image/x-icon">
</head>

<body>
    <div>
        <div class="site">
            <div class="header sticky-top">
                <header>
                    <div class="row header-top">
                        <div class="col-4">
                            <div class="text-header text-header-left">
                                <a href="http://learnphp/contact">Адрес: г.Киров, ул.Ленина 1</a>
                                <a>С 08-00 до 18-00</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-header text-header-middle">
                                <a href="/">Главная</a>
                                <a href="/../templates/pages/about.php">О себе</a>
                                <a href="/../manual.php">Документация по PHP</a>
                                <a href="/news">Новости</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-header text-header-right">
                                <a><img class="iconSmall" src="/images/svg/phone1.svg"> 8-800-800-8888</a>
                            </div>
                        </div>
                    </div>

                    <div class="header-bottom-common">
                        <div class="row header-bottom">
                            <div class="col-2">
                                <a href="/"><img class="logo" src="/images/personal/logo.png "></a>
                            </div>
                            <div class="col-2">
                                <h2 class="header-h">
                                    <?php if (!empty($h1)) {
                                        echo $h1;
                                    } ?>
                                </h2>
                            </div>

                            <div class="col-6">
                                <?php include __DIR__ . '/features/search.php'; ?>
                            </div>

                            <div class="col-2 underlining">
                                <?php if (!empty($user)) : ?>
                                    Привет, <?= $user->getNickname() ?> | <a href="/../users/logOut">Выйти</a>
                                <?php else : ?>
                                    <a href="/../users/login"><img class="iconSmall" src="/images/svg/person-circle.svg"> Войти</a> | <a href="/../users/register">Регистрация</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <?php if (empty($_REQUEST['route']) || $_REQUEST['route'] != 'catalog') include __DIR__ . '/leftSidebar.php' ?>