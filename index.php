<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if(!isset($_COOKIE['user'])) {
    $username = "użytkowniku";
} else {
    $username = $_COOKIE['user'];
}

$sql = "SELECT * FROM users WHERE is_admin = 1";
$result = $db->query($sql);
$row = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games Tracker</title>
</head>
<body>
<div>
    <?php
    echo "<div>";
    if(!isset($_COOKIE['user'])){
        echo "<div><p>Witaj, $username</p></div>";
        echo "<div><a href='login_page.php'>Logowanie</a></div>";
    } else {
        echo "<div><p>Witaj, $username</p></div>";
        if ($row) {
            echo "<div><a href='admin_panel.php'>Panel Administratora</a></div>";
        }
        echo "<div><a href='logout.php'>Wyloguj</a></div>";
    }
    echo "</div>";
?>
</div>
</body>
</html>