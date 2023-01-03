<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}
$game_id = intval($_GET['id']);

if(!isset($_COOKIE['user'])) {
    $username = "guest";
} else {
    $username = $_COOKIE['user'];
}

$sql = "SELECT * FROM users WHERE is_admin = 1 AND username = '$username'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

$sql_query = "SELECT * FROM games JOIN publishers WHERE games.id = $game_id";
$game_db = $db->query($sql_query);
$game_detail = $game_db->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $game_detail['title'];?></title>
</head>
<body>
<div class="main">
<?php
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
} else {
    if ($row) {
        echo "<a href='admin_panel.php'>Panel Administratora</a>";
    }
    echo "<a href='user_panel.php'>$username</a>";
    echo "<a href='logout.php'>Wyloguj</a>";
}
echo '</div>';

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
    insert_game($game_id);
}
echo '</div>';

function insert_game($id_game){
    ?>
    <br>
    <form method="POST" action="game_details_insert.php">
        <label for="progress">Progress:</label>
        <select name="progress" id="progress" required>
            <option value="Plan to play">Plan to play</option>
            <option value="Playing">Playing</option>
            <option value="Completed">Completed</option>
            <option value="Replaying">Replaying</option>
            <option value="Paused">Paused</option>
            <option value="Dropped">Dropped</option>
        </select>
        <br>
        <label for="score">Score:</label>
        <input type="number" name="score" id="score" min="0" max="10">
        <br>
        <input type="hidden" name="game-id" value="<?php echo $id_game;?>">
        <label for="review">Review:</label>
        <textarea name="review" id="review" maxlength="500"></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
    <?php
}

$db->close();

//TODO: Add panel so user can add game to his list/db and add possibility of writing short review
?>
</div>
</body>
</html>
