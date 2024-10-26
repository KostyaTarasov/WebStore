<ul class="content-container section-content products-list-grid">
    <li class="products-item-properties">
        <h2 style="padding-bottom: 10px">Контакты</h2>
        <p><?= $commonInformation[0]->getAddress() ?></p>
        <p><?= $commonInformation[0]->getPhone() ?></p>
        <?php if (!empty($commonInformation[0]->getMail())) : ?>
            <p><?= $commonInformation[0]->getMail() ?></p>
        <?php endif; ?>
        <p><?= $commonInformation[0]->getTimeWork() ?></p>
    </li>
    <li class="products-item-properties">
        <?= $commonInformation[0]->getYandexMap() ?>
    </li>
</ul>