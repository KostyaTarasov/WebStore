<div class="link">
    <a class="btn btn-warning" href=" /catalog">Каталог товаров <img class="iconSearch1" src="/images/svg/search.svg"></a>
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
        <li class="gain-right"><a class=" refSidebarCatalog" href="/catalog/<?= $value ?>"><?= $item ?> </a></li>
    <?php
    }
    ?>
</ul>