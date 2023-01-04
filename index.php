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
    <title>Games Tracker</title>
</head>
<body>
<div class="main">
    <?php
    $sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$username'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    echo "<div class='topnav'>";
    echo "<a href='index.php'>Games Track</a>";
    echo "<p>Witaj, $username</p>";
    if(!isset($_COOKIE['user'])){
        echo "<a href='login_page.php'>Logowanie</a>";
    } else {
        if ($row) {
            echo "<a href='admin_panel.php'>Panel Administratora</a>";
        }
        echo "<a href='user_panel.php'>$username</a>";
        echo "<a href='logout.php'>Wyloguj</a>";
    }
    ?>
    <div>
    <form action="index.php" method="POST">
        <input type="text" placeholder="Tytuł gry" name="game-query">
        <input type="submit" value="Wyszukaj">
    </form>
    </div>
    <?php
    echo "</div>";
    echo "<div class='game-disp'>";
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(!empty($_REQUEST['game-query'])){
            $spec_game = $_REQUEST['game-query'];
            $games_query = "SELECT gam.title, gam.release_date, gam.id, gam.genres_id, gam.publishers_id, gam.platforms_id, gam.date_added,
            gen.genres AS genre_name, pub.publisher AS publisher_name, plat.platforms AS platform_name
            FROM games gam 
            JOIN publishers pub ON gam.publishers_id = pub.id
            JOIN genres gen ON gam.genres_id = gen.id
            JOIN platforms plat ON gam.platforms_id = plat.id
            ORDER BY gam.id
            WHERE gam.title LIKE '%$spec_game%';";
        } else {
            $games_query = "SELECT gam.title, gam.release_date, gam.id, gam.genres_id, gam.publishers_id, gam.platforms_id, gam.date_added,
            gen.genres AS genre_name, pub.publisher AS publisher_name, plat.platforms AS platform_name
            FROM games gam 
            JOIN publishers pub ON gam.publishers_id = pub.id
            JOIN genres gen ON gam.genres_id = gen.id
            JOIN platforms plat ON gam.platforms_id = plat.id
            ORDER BY gam.id;";
        }
    } else {
        $games_query = "SELECT gam.title, gam.release_date, gam.id, gam.genres_id, gam.publishers_id, gam.platforms_id, gam.date_added,
        gen.genres AS genre_name, pub.publisher AS publisher_name, plat.platforms AS platform_name
        FROM games gam 
        JOIN publishers pub ON gam.publishers_id = pub.id
        JOIN genres gen ON gam.genres_id = gen.id
        JOIN platforms plat ON gam.platforms_id = plat.id
        ORDER BY gam.id;";
    }
    $games_list = $db->query($games_query);

    if($games_list->num_rows > 0) {
        while($games_data = $games_list->fetch_assoc()){
            echo '<div class="game-data"><a href="game_details.php?id='.$games_data['id'].'">';
            echo 'Tytuł: '.$games_data['title'].'<br>';
            echo 'Data Premiery: '.$games_data['release_date'].'<br>';
            echo 'Gatunek: '.$games_data['genre_name'].'<br>';
            echo 'Wydawca: '.$games_data['publisher_name'].'<br>';
            echo 'Platforma: '.$games_data['platform_name'].'<br>';
            echo "</a>";
            echo "Dodano ".$games_data['date_added']."</div>";
        }
    } else {
        echo "<p>0 wyników</p>";
    }
    echo "</div>";

    $db->close();
    ?>
</div>
</body>
</html>