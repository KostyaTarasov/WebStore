<?php
$title = "Куки, пример 2";
require_once  "../templates/header.php";
?>
<h1>Куки, пример 2</h1>

<?php
// Второй пример куки
if (isset($_COOKIE['name'])) { //  Если куки существует для имени 'name'
    $name = $_COOKIE['name'];
} else {
    $name = 'Гость';
}
?>

<h3>Второй пример куки:</h3>
<p>Привет, <?php echo $name; ?></p> <!-- Отображение на экране значения из куки -->
<a href="doc9cookiesAndSessions.php">Страница doc9cookiesAndSessions.php</a>
<?php
echo "<br>";
require_once  "../templates/rightSidebar.php";
?>