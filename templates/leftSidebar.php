<div class="link">
    <a class="link" href="/catalog">Каталог товаров <img class="iconSearch" src="/images/icons/find.png"></a>
</div>
<ul style="margin: 5px;">
    <?php
    $list = [
        "Статьи" => 'articles',
        "Холодильники" => "holodilniki",
        "Чайники" => "chajniki",
        "Телевизоры" => "televizory",
        "Наушники" => "naushniki",
    ];
    foreach ($list as $item => $value) // Где $list массив, новые переменные: $item ключ, value значение ключа
    {
    ?>
        <li><a class=" refSidebarCatalog" href="/catalog/<?= $value ?>"><?= $item ?> </a></li>
    <?php
    }
    ?>
</ul>