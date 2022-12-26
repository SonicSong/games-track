<?php
include 'admin_functions.php';

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
    <title>Panel administratora</title>
</head>
<body>
<div>
    <?php
    $cookie_name = $_COOKIE['user'];

    $sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$cookie_name'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    echo "<div class='topnav'>";
    ?>
    <a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>">Powrót</a>
    <?php
    if ($row) {
        echo "<div><p>Witaj, $cookie_name</p></div>";
        echo "<a href='logout.php'>Wyloguj</a>";
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
    add_game();

    $db->close();
    ?>
</div>
</body>
</html>