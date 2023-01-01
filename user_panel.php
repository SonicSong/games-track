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

$db_name = $username.'_db';
$sql_games = "SELECT * FROM $db_name";
$user_games = $db->query($sql_games);

echo "<div class='topnav'>";
echo "<a href='index.php'>Games Track</a>";
?>
<a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>">Powrót</a>
<?php
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
            echo "<div><a href='game_details.php?id='".$user_game_list['game_id']."'></a>";
        }
    }
}

// TODO: Add panel so user can check his games
?>
</body>
</html>
