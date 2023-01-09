<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}
$game_id = intval($_GET['id']);
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
    if (!isset($_COOKIE['user'])) {
        $cookie_name = "guest";
    } else {
        $cookie_name = $_COOKIE['user'];
    }

    $geres_sql = "SELECT * FROM genres";
    $platforms_sql = "SELECT * FROM platforms";
    $publishers_sql = "SELECT * FROM publishers";

    $gen_result = $db->query($geres_sql);
    $plat_result = $db->query($platforms_sql);
    $pub_result = $db->query($publishers_sql);

    $sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$cookie_name'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $sql_query = "SELECT gam.title, gam.release_date, gam.id, gam.genres_id, gam.publishers_id, gam.platforms_id, gam.date_added,
            gen.genres AS genre_name, pub.publisher AS publisher_name, plat.platforms AS platform_name
            FROM games gam 
            JOIN publishers pub ON gam.publishers_id = pub.id
            JOIN genres gen ON gam.genres_id = gen.id
            JOIN platforms plat ON gam.platforms_id = plat.id 
            WHERE gam.id = $game_id";
    $game_db = $db->query($sql_query);
    $game_detail = $game_db->fetch_assoc();

    echo "<div class='topnav'>";
    echo "<a href='index.php'>Games Track</a>";
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
    } else {
        $referer = 'index.php';
    }
    echo '<a href="'.htmlspecialchars($referer).'">Powrót</a>';
    if ($row) {
        echo "<div class='old-game'></div><div><p>Witaj, $cookie_name</p></div>";
        echo "<a href='admin_panel.php'>Panel Administratora</a>";
                echo "<a href='logout.php'>Wyloguj</a>";
        echo "</div><div class='functions'>";
        echo "<div class='game-detail'>";
        echo "<p>Stare Dane</p>";
        echo 'Tytuł: '.$game_detail['title']. '<br>';
        echo 'Data Premiery: '.$game_detail['release_date'].'<br>';
        echo 'Gatunek: '.$game_detail['genre_name'].'<br>';
        echo 'Wydawca: '.$game_detail['publisher_name'].'<br>';
        echo 'Platforma: '.$game_detail['platform_name'].'<br>';
        echo 'Data dodania: '.$game_detail['date_added'];
        echo '</div><div class="new-game">';
        draw_update_game($game_detail, $gen_result, $plat_result, $pub_result);
        echo "</div>";
    } else {
        echo "<p>Nie jesteś uprawniony by przeglądać tą zawartość.</p>";
        ?>
        <script>
            setTimeout(function() {
                window.location.href = "index.php";
            }, 5000);
        </script>
        <?php
    }
    echo "</div>";

    function draw_update_game($old_game, $genres, $platforms, $publishers){
    ?>
    <div class="function">
        <div class="function-title"><p>Nowe Dane</p></div>
        <form action="game_edit_fun.php" method="POST" name="game_add">
            Tytuł: <input type="text" name="title" value="<?php echo $old_game['title']; ?>" required><br>
            Data premiery: <input type="date" name="release_date" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $old_game['release_date'] ?>"><br>
            Gatunek: <select name="genre" required>
                <?php while($genre = $genres->fetch_assoc()) { ?>
                    <option value="<?php echo $genre['id'].'"'; if($genre['genres'] == $old_game['genre_name']) echo " selected "; ?> ><?php echo $genre['genres']; ?></option>
                <?php } ?>
            </select><br>
            Wydawca: <select name="publisher">
                <?php while($publisher = $publishers->fetch_assoc()) { ?>
                    <option value="<?php echo $publisher['id'].'"'; if($publisher['publisher'] == $old_game['publisher_name']) echo " selected "; ?>"><?php echo $publisher['publisher']; ?></option>
                <?php } ?>
            </select><br>
            Platforma: <select name="platform">
                <?php while($platform = $platforms->fetch_assoc()) { ?>
                    <option value="<?php echo $platform['id'].'"'; if($platform['platforms'] == $old_game['platform_name']) echo " selected "; ?>"><?php echo $platform['platforms']; ?></option>
                <?php } ?>
            </select><br>
            <input type="hidden" name="game-id" value="<?php echo $old_game['id'];?>">
            <input type="submit" value="Aktualizuj dane">
        </form>
    </div>
    <?php
    }
    $db->close();
?>
</div>
</body>
</html>
