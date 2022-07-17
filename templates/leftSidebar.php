<?php if (!empty($cpuCatalogs)) : ?>
    <aside class="left-sidebar">
        <div class="link">
            <a class="btn btn-warning" href=" /catalog">Каталог товаров <img class="iconSearch1" src="/images/svg/search.svg"></a>
        </div>
        <ul style="margin: 5px;">
            <?php
            foreach ($cpuCatalogs as $value) { ?>
                <li class="gain-right a-edit"><a class="refSidebarCatalog" href="/catalog/<?= $value->getNameTable() ?>"><?= $value->getName() ?> </a></li>
            <?php } ?>
        </ul>
    </aside>
<?php endif; ?>