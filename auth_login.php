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
    session_start();
    $_SESSION["loggedin"] = true;
    header("location: admin_panel.php");
} else {
    echo 'Nazwa użytkownika bądź hasło są nie poprawne';
    echo '<br><a href="login_page.php">Powrót do logowania</a>';
}

$db->close();