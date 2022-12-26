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
    <link rel="stylesheet" href="styles.css">
    <title>Games Tracker</title>
</head>
<body>
<div class="main">
    <?php
    echo "<div class='topnav'>";
    echo "<p>Witaj, $username</p>";
    if(!isset($_COOKIE['user'])){
        echo "<a href='login_page.php'>Logowanie</a>";
    } else {
        if ($row) {
            echo "<a href='admin_panel.php'>Panel Administratora</a>";
        }
        echo "<a href='logout.php'>Wyloguj</a>";
    }
    echo "</div>";
    echo "<div class='game-disp'>";
    $games_query = "SELECT * FROM games";
    $games_list = $db->query($games_query);

    if($games_list->num_rows > 0) {
        while($games_data = $games_list->fetch_assoc()){
            echo '<div class="game-data"><a href="game_details.php?id='.$games_data['id'].'" target="_blank">';
            echo $games_data['name'].'<br>';
            echo $games_data['release_date'].'<br>';
            echo $games_data['genre'].'<br>';
            echo $games_data['publisher'].'<br>';
            echo $games_data['platform'].'<br>';
            echo "</a>";
            echo "Dodano ".$games_data['date_added']."</div>";
        }
    } else {
        echo "<p>0 wyników</p>";
    }
    echo "</div>";
?>
</div>
</body>
</html>