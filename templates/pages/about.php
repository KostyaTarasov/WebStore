<div>
    <div class="content-container section-content">
        <h1 style="font-size: 18pt;"> О нас</h1>
        <h2 style="font-size: 14pt; font-weight: normal;"><?= $commonInformation[0]->getParsedText($commonInformation[0]->getAboutUs()) ?></h2>
    </div>
    <?php if ($user !== null && $user->isAdmin()) : ?>
        <a class="btn btn-primary" href="about/edit">Редактировать основную информацию и настройки сайта</a>
    <?php endif; ?>
    <br>
    <br>
    <br>
    <?php include __DIR__ . '/contact.php'; ?>
</div>