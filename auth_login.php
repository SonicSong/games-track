<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

$login = $_REQUEST['login'] ?? '';
$userpwd = sha1($_REQUEST['userpwd'] ?? '');

$sql = "SELECT * FROM users WHERE username = '$login' AND password = '$userpwd'";
$result = $db->query($sql);

$row = $result->fetch_assoc();

if ($row){
    $cookie_name = $login;
    $cookie_value = $login;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    header("location: admin_panel.php");
} else {
    echo 'Nazwa użytkownika bądź hasło są nie poprawne';
    echo '<br><a href="login_page.php">Powrót do logowania</a>';
}

$db->close();