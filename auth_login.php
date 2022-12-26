<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

$login = $_REQUEST['login'] ?? '';
$userpwd = sha1($_REQUEST['userpwd'] ?? '');

$sql1 = "SELECT * FROM users WHERE username = '$login' AND password = '$userpwd'";
$result1 = $db->query($sql1);

$row1 = $result1->fetch_assoc();

if ($row1){
    $cookie_value = "$login";
    setcookie("user", $cookie_value, time() + (86400 * 30), "/");
    header("location: index.php");
} else {
    echo 'Nazwa użytkownika bądź hasło są nie poprawne';
    echo '<br><a href="login_page.php">Powrót do logowania</a>';
}

$db->close();