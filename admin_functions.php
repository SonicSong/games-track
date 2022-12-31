<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

$genres = ['Air combat simulation','Action-adventure', 'Action', 'Massively multiplayer online role-playing', 'Real-time strategy', 'First-person shooter', 'Massively multiplayer online',
    'Factory simulation', 'Space trading and combat', 'Action role-playing', 'Roguelike', 'Third-person shooter', 'Simulation', 'Tactical role-playing', 'Tower defense',
    'Survival horror', 'Top-down shooter', ' Puzzle', 'Music', 'Open World', 'Party', 'Metroidvania'];

$platforms = ['PC', 'Play Station', 'Play Station 2', 'Play Station 3', 'Play Station 4', 'Play Station 4', 'Play Station 5', 'Xbox', 'Xbox 360','Xbox One', 'Xbox Series X/S',
    'PC/Xbox One/Play Station 4', 'PC/Xbox Series/Play Station 5', 'PC/Xbox 360/Play Station 3'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_REQUEST['title'] ?? '';
    $release_date = $_REQUEST['release_date'] ?? '';
    $genre = $_REQUEST['genre'] ?? '';
    $publisher = $_REQUEST['publisher'] ?? '';
    $platform = $_REQUEST['platform'] ?? '';

    add_game($db, $title, $release_date, $genre, $publisher, $platform);
}

function add_game($db, $title, $release_date, $genre, $publisher, $platform){
    $sql_add_game = "INSERT INTO `games` (`id`, `title`, `publisher`, `release_date`, `genre`, `platform`, `date_added`) 
VALUES (NULL, '$title', '$publisher', '$release_date', '$genre', '$platform', current_timestamp())";

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

$db->close();