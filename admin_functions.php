<?php
$db = mysqli_connect("localhost", "root", "", "games_track");
if (!$db) {
    die('Nie można było się połączyć z bazą danych: ' . mysqli_error());
}

function add_game(){
$sql_add_game = "INSERT INTO 'games' (`id`, `title`, `publisher`, `release_date`, `genre`, `platform`, `date_added`) VALUES (NULL, )";
}

$db->close();