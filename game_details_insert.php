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

$sql_user = "SELECT * FROM users WHERE username = '$username'";
$result = $db->query($sql_user);
$row = $result->fetch_assoc();

$userid = $row['id'];

$db_name = $username.'_db';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = $_REQUEST['game-id'] ?? '';
    $progress = $_REQUEST['progress'] ?? '';
    $score = $_REQUEST['score'] ?? '';
    $review = $_REQUEST['review'] ?? '';

    game_review($db, $userid, $game_id, $progress, $score, $review, $db_name);
}


function game_review($db, $uid, $gid, $progress, $score, $review, $userdb){
    $sql_add_review = "INSERT INTO `$userdb` (`id`, `user_id`, `game_id`, `progress`, `score`, `review`) 
    VALUES (NULL, $uid, $gid, '$progress', $score, '$review') ON DUPLICATE KEY UPDATE review = '$review', score = $score";

    try{
        $result = mysqli_query($db, $sql_add_review);
        if ($result){
            echo "Dodawanie recenzji wykonane pomyślnie...";
            ?>
            <script>
                setTimeout(function() {
                    window.location = '<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>';
                }, 5000);
            </script>
            <?php
            return $result;
        }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo $error."<br>";
            echo "Błąd duplikacji";
        } else {
            echo $error;
            echo "Dodawanie recenzji nie udane. Proszę spróbowac jeszcze raz.";
            ?>
            <script>
                setTimeout(function() {
                    window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
                }, 5000);
            </script>
            <?php
            return $error;
        }
    }
}

$db->close();