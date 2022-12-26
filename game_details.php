<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}
$game_id = intval($_GET['id']);

if(!isset($_COOKIE['user'])) {
    $username = "użytkowniku";
} else {
    $username = $_COOKIE['user'];
}

$sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$username'";
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
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<div class="main">
<?php
echo "<div class='topnav'>";
?>
<a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>">Powrót</a>
<?php
echo "<p>Witaj, $username</p>";
if(!isset($_COOKIE['user'])){
    echo "<a href='login_page.php'>Logowanie</a>";
} else {
    if ($row) {
        echo "<a href='admin_panel.php'>Panel Administratora</a>";
    }
    echo "<a href='logout.php'>Wyloguj</a>";
}
echo '</div>';

$sql_query = "SELECT * FROM games WHERE id = $game_id";
$game_db = $db->query($sql_query);
$game_detail = $game_db->fetch_assoc();
echo "<div class='game-detail'>";
echo 'Tytuł: '.$game_detail['title']. '<br>';
echo 'Data Premiery: '.$game_detail['release_date'].'<br>';
echo 'Gatunek: '.$game_detail['genre'].'<br>';
echo 'Wydawca: '.$game_detail['publisher'].'<br>';
echo 'Platforma: '.$game_detail['platform'].'<br>';
echo 'Data dodania: '.$game_detail['date_added'];
echo '</div>';
echo '<div>';
if(isset($_COOKIE['user'])){

}
echo '</div>';

$db->close();
?>
</div>
</body>
</html>
