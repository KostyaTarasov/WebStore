<?php
// print_r($_POST); 
// у метода передачи данных POST данные передаются скрытно
$name = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

if (trim($name) == "")
    echo "Вы не ввели имя пользователя";
else if (strlen(trim($name)) <= 1)
    echo "Такого имени не существует";
else if (trim($email) == "" || trim($pass) == "" || trim($_POST['message']) == "")
    echo "Введите все данные";
else {

    print_r($_FILES); // Для отображения инф о загруженной картинке


    $pass = md5($pass); // Пароль в кэше
    echo "<h1>Все данные</h1><p>$name</p><p>$email</p><p>$pass</p><p>$_POST[message]</p>";

    $_POST['password'] = md5($pass); // Пароль в кэше
    echo "<h1>Все данные</h1>";
    foreach ($_POST as $key => $value)
        echo "<p>$value</p>";

    // header('Location: /about.php'); // Открываем страницу
    exit; // Чтобы дальнейший код не выполнялся
}
?>

<br>
<a href="doc5PostGet.php">Страница doc5PostGet.php</a>