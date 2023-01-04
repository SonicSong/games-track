<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_REQUEST['title'] ?? '';
    $release_date = $_REQUEST['release_date'] ?? '';
    $genre = $_REQUEST['genre'] ?? '';
    $publisher = $_REQUEST['publisher'] ?? '';
    $platform = $_REQUEST['platform'] ?? '';

    add_game($db, $title, $release_date, $genre, $publisher, $platform);
}

function add_game($db, $title, $release_date, $genre, $publisher, $platform){
    $sql_add_game = "INSERT INTO games (id, title, release_date, genres_id, publishers_id, platforms_id, date_added)
VALUES (NULL, '$title', '$release_date', $genre, $publisher, $platform, current_timestamp())";

    try{
    $result = mysqli_query($db, $sql_add_game);

    if ($result) {
        echo "Dodawanie gry wykonane pomyślnie...";
        ?>
        <script>
            setTimeout(function() {
                window.location = <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']);?>
            }, 5000);
        </script>
        <?php
        return $result;
    }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Dodawanie gry nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Dodawanie gry nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}

function add_publisher(){

}

function add_genre(){

}

function add_platform(){

}

$db->close();