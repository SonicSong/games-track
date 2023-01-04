<?php
require 'admin_functions.php';

$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
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
    <title>Panel administratora</title>
</head>
<body>
<div class="main">
    <?php
    if(!isset($_COOKIE['user'])) {
        $cookie_name = "guest";
    } else {
        $cookie_name = $_COOKIE['user'];
    }

    $sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$cookie_name'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    //HAHA SQL QUERY GOES BRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
    $geres_sql = "SELECT * FROM genres";
    $platforms_sql = "SELECT * FROM platforms";
    $publishers_sql = "SELECT * FROM publishers";

    $gen_result = $db->query($geres_sql);
    $plat_result = $db->query($platforms_sql);
    $pub_result = $db->query($publishers_sql);

    echo "<div class='topnav'>";
    echo "<a href='index.php'>Games Track</a>";
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
    } else {
        $referer = 'index.php';
    }
    echo '<a href="'.htmlspecialchars($referer).'">Powrót</a>';
    if ($row) {
        echo "<div><p>Witaj, $cookie_name</p></div>";
        echo "<a href='logout.php'>Wyloguj</a>";
        echo "</div>";
        draw_add_game($gen_result, $plat_result, $pub_result);
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

    function draw_add_game($genres, $platforms, $publishers){
        ?>
        <div class="function-title"><p>Dodaj nową grę</p></div>
        <form action="admin_functions.php" method="POST">
            Tytuł: <input type="text" name="title" required><br>
            Data premiery: <input type="date" name="release_date" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br>
            Gatunek: <select name="genre" required>
                <?php while($genre = $genres->fetch_assoc()) { ?>
                    <option value="<?php echo $genre['id']; ?>"><?php echo $genre['genres']; ?></option>
                <?php } ?>
            </select><br>
            Wydawca: <select name="publisher">
                <?php while($publisher = $publishers->fetch_assoc()) { ?>
                    <option value="<?php echo $publisher['id']; ?>"><?php echo $publisher['publisher']; ?></option>
                <?php } ?>
            </select><br>
            Platforma: <select name="platform">
                <?php while($platform = $platforms->fetch_assoc()) { ?>
                    <option value="<?php echo $platform['id']; ?>"><?php echo $platform['platforms']; ?></option>
                <?php } ?>
            </select><br>
            <input type="submit" value="Dodaj grę">
        </form>
        </div>
        <?php
    }

    function draw_add_publisher(){

    }

    $db->close();
    ?>
</div>
</body>
</html>