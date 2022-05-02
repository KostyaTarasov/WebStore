<?php
$title = "27 CRUD-операции";
require_once  "../templates/header.php";
?>
<a>CRUD – это аббревиатура четырех слов, означающих следующие операции:
    Create (создание);
    Read (чтение);
    Update (обновление);
    Delete (удаление).</a>
<br></br>
<a>В базе данных MySQL этим операциям соответствуют запросы:
    INSERT;
    SELECT;
    UPDATE;
    DELETE.</a>
<?php
// все эти операции реализованы в приложении в классе ActiveRecordEntity.
?>

<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>