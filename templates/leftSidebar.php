<?php if (!empty($cpuCatalogs)) : ?>
    <aside class="left-sidebar">
        <h5 style="padding-left:35px; font-size: 21px;">Каталог товаров</h5>
        <ul style="margin: 5px;">
            <?php
            foreach ($cpuCatalogs as $value) { ?>
                <li class="gain-right a-edit"><a class="refSidebarCatalog" href="/catalog/<?= $value->getNameTable() ?>"><?= $value->getName() ?> </a></li>
            <?php } ?>
        </ul>
    </aside>
<?php endif; ?>