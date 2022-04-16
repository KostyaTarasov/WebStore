<?php
$title = "28 M в MVC";
require_once  "../templates/header.php";
?>

<a>Model в MVC – это слой приложения, отвечающий за работу с данными, и содержащий в себе бизнес-логику</a>
<br></br>
<a>Бизнес-логика - это логика приложения, которая описывает то, что требуется от кода со стороны бизнеса. Например, бизнесу требуется, чтобы админ мог создавать записи в блоге. Значит при создании новой записи в блоге нужно проверять, что пользователь, создающий запись, является админом. И конкретно эта логика должна описываться в слое модели.</a>
<br></br>
<a>Таким образом, работа с базой данных, CRUD-операции и бизнес-логика – всё это должно описываться в модели.</a>
<?php
// 
?>

<?php
echo "<br>";
require_once  "../templates/footer.php";
?>