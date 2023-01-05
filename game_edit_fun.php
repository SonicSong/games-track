<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $game_title = $_REQUEST['title'];
    $rel_date = $_REQUEST['release_date'];
    $genre = intval($_REQUEST['genre']);
    $publisher = intval($_REQUEST['publisher']);
    $platform = intval($_REQUEST['platform']);
    $game_id = intval($_REQUEST['game-id']);

    update_game_dat($db, $game_title, $rel_date, $genre, $publisher, $platform, $game_id);
}

function update_game_dat($db, $title, $date, $gen, $pub, $plat, $id){
    $game_update = "UPDATE games 
    SET title = '$title', release_date = '$date', genres_id = $gen, publishers_id = $pub, platforms_id = $plat
    WHERE id = $id";

    try{
        $result = mysqli_query($db, $game_update);

        if($result){
            echo "Aktualizowanie gry wykonane pomyślnie...";
            ?>
            <script>
                setTimeout(function() {
                    window.location = <?php echo json_encode($_SERVER['HTTP_REFERER']); ?>;
                }, 5000);
            </script>
            <?php
            return $result;
        }
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() == 1062) {
            echo "Aktualizowanie gry nie udane. Wprowadzone dane są już w bazie danych.";
        } else {
            echo "Aktualizowanie gry nie udane. <a href='admin_panel.php'>Proszę spróbować jeszcze raz.</a>";
            return $error;
        }
    }
}