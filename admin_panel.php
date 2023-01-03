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
        draw_add_game($genres, $platforms);
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

    function draw_add_game($genres, $platforms){
        ?>
        <div class="function-title"><p>Dodaj nową grę</p></div>
        <form action="admin_functions.php" method="POST">
            Tytuł: <input type="text" name="title" required><br>
            Data premiery: <input type="date" name="release_date" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br>
            Gatunek: <select name="genre" required>
                <!-- $genres actually does work but IDE doesn't recognize that it's in another file -->
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?php echo $genre; ?>"><?php echo $genre; ?></option>
                <?php } ?>
            </select><br>
            Wydawca: <input type="text" name="publisher"><br>
            Platforma: <select name="platform">
                <?php foreach ($platforms as $platform) { ?>
                    <option value="<?php echo $platform; ?>"><?php echo $platform; ?></option>
                <?php } ?>
            </select><br>
            <input type="submit" value="Dodaj grę">
        </form>
        </div>
        <?php
    }

    $db->close();
    ?>
</div>
</body>
</html>