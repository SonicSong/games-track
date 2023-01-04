<?php

$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if(!isset($_COOKIE['user'])) {
    $username = "guest";
} else {
    $username = $_COOKIE['user'];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Panel użytkownika</title>
</head>
<body>
<?php
$sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$username'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

$sql_user = "SELECT * FROM users WHERE username = '$username'";
$res_user = $db->query($sql_user);
$user_dat = $res_user->fetch_assoc();

$sql_games = "SELECT ug.game_id, g.title, ug.progress, ug.score, ug.review 
FROM user_games ug JOIN games g ON ug.game_id = g.id WHERE ug.user_id = '{$user_dat['id']}'";
$user_games = $db->query($sql_games);

echo "<div class='topnav'>";
echo "<a href='index.php'>Games Track</a>";
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
} else {
    $referer = 'index.php';
}
echo '<a href="'.htmlspecialchars($referer).'">Powrót</a>';
echo "<p>Witaj, $username</p>";
if(!isset($_COOKIE['user'])){
    echo "<a href='login_page.php'>Logowanie</a>";
    echo "</div>";

} else {
    if ($row) {
        echo "<a href='admin_panel.php'>Panel Administratora</a>";
    }
    echo "<a href='user_panel.php'>$username</a>";
    echo "<a href='logout.php'>Wyloguj</a>";
    echo "</div>";
    user_games($user_games);
}

function user_games($ug){
    if($ug->num_rows > 0) {
        while ($user_game_list = $ug->fetch_assoc()) {
            echo "<div class='game-data'><a href='game_details.php?id=".$user_game_list['game_id']."'>".$user_game_list['title']."</a>";
            echo "<p>Status: ".$user_game_list['progress']."</p>";
            echo "<p>Wynik: ".$user_game_list['score']."</p>";
            echo "<p>Recenzja: ".$user_game_list['review']."</p></div>";
        }
    } else {
        echo "<p>Nie masz jeszcze dodanych żadnych gier.</p>";
    }
}

// TODO: Add panel so user can check his games
?>
</body>
</html>
