<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db){
    die('Nie można było się połączyć z bazą danych: '.mysqli_error());
}

$username = $_REQUEST['name'] ?? '';
$pwd = sha1($_REQUEST['registerpwd'] ?? '');
$mail = $_REQUEST['email_reg'] ?? '';
$create_datetime = date("Y-m-d H:i:s");
$username_db = $username.'_db';

$sql_userdb = "CREATE TABLE $username_db (
   id INTEGER AUTO_INCREMENT PRIMARY KEY,
   user_id INTEGER,
   game_id INTEGER,
   progress ENUM('Plan to play', 'Playing', 'Completed', 'Replaying', 'Paused', 'Dropped'),
   score INT NOT NULL CHECK (score >= 0 AND score <= 10),
   review VARCHAR(500),
   FOREIGN KEY (user_id) REFERENCES users(id),
   FOREIGN KEY (game_id) REFERENCES games(id),
   UNIQUE (game_id)
)";

try {
    $sql = "INSERT INTO users (username, password, email, creation_date, is_admin) VALUES ('$username', '$pwd', '$mail', '$create_datetime', 0)";
    $result = mysqli_query($db, $sql);

    $user_result = mysqli_query($db, $sql_userdb);

    if ($result AND $user_result) {
        echo "Rejestracja wykonana pomyślnie...";
        ?>
        <script>
            setTimeout(function() {
                window.location.href = "login_page.php";
            }, 5000);
        </script>
        <?php
        }
} catch (mysqli_sql_exception $error) {
    if ($error->getCode() == 1062) {
        echo "Rejestracja nie udana. Wprowadzone dane są już w bazie danych. <a href='registration_page.php'>Proszę spróbować jeszcze raz.</a>";
    } elseif ($error->getCode()) {
        echo $error;
    } else {
        echo "Rejestracja nie udana. <a href='registration_page.php'>Proszę spróbować jeszcze raz.</a>";
    }
}
$db->close();